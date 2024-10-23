<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BilleteraRequest;
use App\Http\Resources\BilleteraCollection;
use App\Http\Resources\BilleteraResource;
use App\Models\Billetera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BilleteraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BilleteraCollection(
            Billetera::where('deleted', 'false')
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BilleteraRequest $request)
    {
        $request['fecha'] = date('Y-m-d H:i:s');
        // print_r($request->all());
        $billetera = Billetera::create($request->all());
        return response()->json(
            [
                'success' => true,
                'message' => 'Registrado correctamente.',
                'data' => $billetera
            ], 200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Billetera $billetera)
    {
        return new BilleteraResource($billetera);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billetera $billetera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billetera $billetera)
    {
        //
    }
}
