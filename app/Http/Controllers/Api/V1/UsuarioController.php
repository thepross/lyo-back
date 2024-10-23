<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\UsuarioCollection;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Muestra el listado del recurso.
     */
    public function index()
    {
        return new UsuarioCollection(
            Usuario::where('deleted', 'false')
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        );
    }

    /**
     * Crea un recurso en el almacenamiento.
     */
    public function store(UsuarioRequest $request)
    {
        $usuario = Usuario::create($request->all());
        return response()->json(
            [
                'success' => true,
                'message' => 'Registrado correctamente.',
                'data' => $usuario
            ],
            200
        );

    }

    /**
     * Muestra el recurso especifico.
     */
    public function show(Usuario $usuario)
    {
        return new UsuarioResource($usuario);
    }

    /**
     * Actualiza el recurso especifico en el almacenamiento.
     */
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->all());
        return response()->json(
            [
                'success' => true,
                'message' => 'Modificado correctamente.',
                'data' => $usuario
            ],
            200
        );
    }

    /**
     * Elimina el recurso especifico del almacenamiento.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Eliminado correctamente.',
                'data' => $usuario
            ],
            200
        );
    }

    public function getAllBilleteras($id)
    {
        $usuario = Usuario::find($id);
        $billeteras = $usuario->billeteras;
        $data = [
            'usuario' => $usuario,
            'billeteras' => $billeteras,
        ];
        return response()->json(
            [
                'success' => true,
                'message' => 'Billeteras del usuario.',
                'data' => $data
            ],
            200
        );
    }


    public function funcion_necesaria()
    {
        $cadena = "este es un ejemplo de texto";
        for ($i = 0; $i < 10; $i++) {
            echo 'hola mundo';
        }
    }

    public function funcion_necesaria_old()
    {
        $cadena = "este es un ejemplo de texto";
        for ($i = 0; $i < 10; $i++) {
            echo "hola mundo";
        }
    }

    public function updateProfileImage(Request $request)
    {
        // Validar la imagen usando el Validator para poder devolver los errores personalizados
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Tamaño máximo 2MB
            'id' => 'required|integer|exists:usuarios,id',
        ]);

        // Si la validación falla, devolvemos los errores en formato JSON
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validación fallida',
                'errors' => $validator->errors()
            ], 400);
        }

        $user = Usuario::find($request->get('id'));

        // Subir la imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($user->imagen) {
                Storage::delete($user->imagen);
            }

            // Guardar la nueva imagen
            $path = $request->file('image')->store('imagen', 'public');
            $url = asset('storage/' . $path);

            // Guardar la ruta en la base de datos
            $user->update([
                'imagen' => $url,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Imagen de perfil actualizada correctamente',
                'data' => $url,
            ], 200);
        }
        // Si no se sube imagen, devuelve un error
        return response()->json([
            'status' => 'error',
            'message' => 'No se subió ninguna imagen',
        ], 400);

    }
}
