<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = "movimientos";

    protected $fillable = ["detalle", "id_billetera", "monto", "id_transaccion"];
    // protected $fillable = ["detalle", "id_billetera_entrada", "id_billetera_salida", "monto", "id_transaccion"];


}
