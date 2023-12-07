<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = DB::table('usuarios')
            ->where('deleted', 'false')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        return response()->json($usuarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $data['nombres'] = $request['nombres'];
            $data['apellidos'] = $request['apellidos'];
            $data['direccion'] = $request['direccion'];
            $data['telefono'] = $request['telefono'];
            $data['tipo'] = $request['tipo'];
            $result = Usuario::create($data);
            return response()->json($result, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return response()->json($usuario, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario->update($request->all());
        $usuario->refresh();
        return response()->json($usuario, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json($usuario, 200);
    }
}
