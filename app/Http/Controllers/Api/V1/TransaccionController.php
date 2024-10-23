<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaccionRequest;
use App\Http\Resources\TransaccionCollection;
use App\Models\Billetera;
use App\Models\Movimiento;
use App\Models\Transaccion;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TransaccionCollection(
            Transaccion::where('deleted', false)
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaccionRequest $request)
    {
        $request['fecha'] = date("Y-m-d H:i:s");
        $monto_salida = 0 - $request->monto;
        $monto_entrada = $request->monto;

        // verificar cantidad de saldos en id_billetera_salida
        $billetera_salida = Billetera::find($request->id_billetera_salida);
        if ($billetera_salida->saldo + $monto_salida < 0) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Error en la validación.',
                    'errors' => ['monto' => 'No existe el saldo suficiente']
                ], 422)
            );
        }

        $transaccion = Transaccion::create([
            'detalle' => $request->detalle,
            'monto' => $request->monto,
            'fecha' => $request['fecha'],
            // generar comprobante.
        ]);
        // $movimientox = Movimiento::create([
        //     'detalle' => $request->detalle,
        //     'id_billetera_entrada' => $request->id_billetera_entrada,
        //     'id_billetera_salida' => $request->id_billetera_salida,
        //     'monto' => $monto_salida,
        //     'id_transaccion' => $transaccion->id
        // ]);
        $movimiento1 = Movimiento::create([
            'detalle' => $request->detalle,
            // 'id_billetera_entrada' => $request->id_billetera_entrada,
            // 'id_billetera_salida' => $request->id_billetera_salida,
            'id_billetera' => $request->id_billetera_salida,
            'monto' => $monto_salida,
            'id_transaccion' => $transaccion->id
        ]);
        $movimiento2 = Movimiento::create([
            'detalle' => $request->detalle,
            // 'id_billetera_entrada' => $request->id_billetera_entrada,
            // 'id_billetera_salida' => $request->id_billetera_salida,
            'id_billetera' => $request->id_billetera_entrada,
            'monto' => $monto_entrada,
            'id_transaccion' => $transaccion->id
        ]);

        // actualizar estado de transaccion
        $transaccion->update(['estado' => 'completado']);

        // actualizar saldos
        $billetera1 = Billetera::find($request->id_billetera_entrada);
        $billetera1->update(['saldo' => $billetera1->saldo + $monto_entrada]);

        $billetera2 = Billetera::find($request->id_billetera_salida);
        $billetera2->update(['saldo' => $billetera2->saldo + $monto_salida]);

        return response()->json([
            'success' => true,
            'message' => 'Registrado correctamente.',
            'data' => $transaccion
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getTransacciones($id)
    {
        $sql = DB::table('transacciones')
            ->join('movimientos as envio', function ($join) {
                $join->on('transacciones.id', '=', 'envio.id_transaccion')
                    ->where('envio.monto', '<', 0);  // Movimiento de salida
            })
            ->join('movimientos as recibo', function ($join) {
                $join->on('transacciones.id', '=', 'recibo.id_transaccion')
                    ->where('recibo.monto', '>', 0);  // Movimiento de entrada
            })
            ->join('billeteras as origen', 'envio.id_billetera', '=', 'origen.id')  // Billetera que envía
            ->join('billeteras as destino', 'recibo.id_billetera', '=', 'destino.id')  // Billetera que recibe
            ->join('usuarios as usuario_origen', 'origen.id_usuario', '=', 'usuario_origen.id')  // Usuario que envía
            ->join('usuarios as usuario_destino', 'destino.id_usuario', '=', 'usuario_destino.id')  // Usuario que envía
            ->where(function ($query) use ($id) {
                $query->where('envio.id_billetera', $id)
                    ->orWhere('recibo.id_billetera', $id);
            })
            ->select(
                'transacciones.*',
                'envio.monto as monto_enviado',
                'recibo.monto as monto_recibido',
                'origen.id as origen_billetera',  // Cambia 'nombre' por el campo adecuado
                'destino.id as destino_billetera', // Cambia 'nombre' por el campo adecuado
                'usuario_origen.nombres as nombre_billetera_origen',  // Nombre del usuario que envía
                'usuario_destino.nombres as nombre_billetera_destino',  // Nombre del usuario que envía
            )
            ->orderBy('transacciones.created_at', 'desc')
            ->get();
        return response()->json([
            "success" => true,
            "message" => "Listado de Transacciones.",
            'data' => $sql
        ], 200);

    }
}
