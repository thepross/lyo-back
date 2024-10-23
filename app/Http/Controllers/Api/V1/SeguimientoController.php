<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeguimientoRequest;
use App\Http\Resources\SeguimientoCollection;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new SeguimientoCollection(
            DB::table('seguimientos')
                ->where('deleted', false)
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeguimientoRequest $request)
    {
        $seguimiento = Seguimiento::create($request->all());
        return response()->json(
            [
                'success' => true,
                'message' => 'Registrado correctamente.',
                'data' => $seguimiento
            ],
            200
        );
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
}
