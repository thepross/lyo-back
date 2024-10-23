<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $table = "seguimientos";

    protected $fillable = ["detalle", "fecha", "id_transaccion"];
}
