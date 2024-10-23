<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaccionResource extends JsonResource
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
            'monto' => $this->monto,
            'fecha' => $this->fecha,
            'estado' => $this->estado,
            'comprobante' => $this->comprobante,
        ];
    }
}
