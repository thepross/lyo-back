<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Billetera extends Model
{
    use HasFactory, HasUuids;

    protected $table = "billeteras";
    protected $fillable = ['detalle', 'fecha', 'saldo', 'id_usuario'];


    // public function movimientos(): HasMany
    // {
    //     return $this->hasMany(Movimiento::class, 'id_billetera');
    // }
    public function transacciones(): BelongsToMany
    {
        return $this->belongsToMany(Transaccion::class, 'movimientos', 'id_billetera', 'id_transaccion')
        ->withPivot('id', 'monto', 'detalle')->orderByPivot('created_at', 'desc');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
