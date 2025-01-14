<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\UsuarioResource;
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
//        $usuarios = UsuarioResource::collection(Usuario::paginate(4));
        $usuarios = UsuarioResource::collection(
            DB::table('usuarios')
                ->where('deleted', 'false')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
        );
        return $usuarios;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        $result = Usuario::create($request->all());
        return response()->json(
            [
                'success' => true,
                'message' => 'Registrado correctamente.',
                'data' => $result
            ], 200
        );
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
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->all());
        $usuario->refresh();
        return response()->json(
            [
                'success' => true,
                'message' => 'Modificado correctamente.',
                'data' => $usuario
            ], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Eliminado correctamente.',
                'data' => $usuario
            ], 200
        );
    }
}
