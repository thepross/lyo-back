<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    protected $fillable = ["nombres", "apellidos", "direccion", "telefono", "tipo"];


    /**
     * Metodo "delete" para eliminar un usuario, modificado para cambiar estado del usuario.
     * @return void
     */
    public function delete()
    {
        $this->deleted = true;
        $this->update();
        $this->refresh();
    }

}
