<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BilleteraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'detalle' => $this->detalle,
            'fecha' => $this->fecha,
            'saldo' => $this->saldo,
            'id_usuario' => $this->id_usuario,
            'movimientos' => $this->transacciones,
            'usuario' => $this->usuario,
            // 'movimientos' => $this->movimientos,
        ];
    }
}
