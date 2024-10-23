<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Función para verificar la autenticación del usuario, devuelve un token(auth bearer).
     */
    final public function login(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized',
                'username' => ['Las credenciales son incorrectas.']
            ], 401);
        }
        $usuario = Usuario::where('id', $user->id_usuario)->first();
        return response()->json([
            'message' => 'Inicio de sesión correcto.',
            'data' => [$usuario, $usuario->billeteras],
            'token' => $user->createToken(request()->device_name)->plainTextToken
        ]);
    }

    /**
     * Función para cerrar sesión del usuario, eliminando el token correspondiente.
     */
    final public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Sesión cerrada.'
        ]);
    }
}
