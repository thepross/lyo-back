<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Muestra el listado del recurso.
     */
    public function index()
    {
        return view('user');
        // return new UserCollection(
        //     DB::table('users')
        //         ->where('deleted', 'false')
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(5)
        // );
    }

    /**
     * Crea un recurso en el almacenamiento.
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        return response()->json(
            [
                'success' => true,
                'message' => 'Registrado correctamente.',
                'data' => $user
            ],
            200
        );
    }

    /**
     * Muestra el recurso especifico.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Actualiza el recurso especifico en el almacenamiento.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json(
            [
                'success' => true,
                'message' => 'Modificado correctamente.',
                'data' => $user
            ],
            200
        );
    }

    /**
     * Elimina el recurso especifico del almacenamiento.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Eliminado correctamente.',
                'data' => $user
            ],
            200
        );
    }
}
