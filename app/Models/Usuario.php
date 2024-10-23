<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Exceptions\HttpResponseException;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    protected $fillable = ["nombres", "apellidos", "direccion", "telefono", "tipo", 'billeteras'];


    /**
     * Metodo "delete" para eliminar un usuario, modificado para cambiar estado del usuario.
     * @return void
     */
    // public function delete()
    // {
    //     if ($this->deleted) {
    //         throw new HttpResponseException(
    //             response()->json(
    //                 [
    //                     "success" => false,
    //                     "message" => "Error al eliminar",
    //                     "errors" => ["El usuario no se ha encontrado."]
    //                 ], 200
    //             )
    //         );
    //     } else {
    //         $this->deleted = true;
    //         $this->update();
    //         $this->refresh();
    //     }
    // }

    public function billeteras() : HasMany 
    {
        return $this->hasMany(Billetera::class, 'id_usuario');
    }

}
