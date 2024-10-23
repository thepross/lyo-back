<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = "transacciones";

    protected $fillable = ["detalle", "monto", "fecha", "estado", "comprobante", "id_transaccion_salida", "id_transaccion_entrada"];

    
    public function movimientos() : BelongsToMany
    {
        return $this->belongsToMany(Movimiento::class, 'movimientos', 'id_billetera', 'id_transaccion');
    }
    
}
