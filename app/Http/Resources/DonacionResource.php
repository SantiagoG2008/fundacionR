<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id_donacion,
            'tipo' => $this->tipo,
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
            'adoptante' => $this->whenLoaded('adoptante', fn () => [
                'id' => $this->adoptante->id_adoptante,
                'nombres' => $this->adoptante->nombres,
                'telefono' => $this->adoptante->telefono,
            ]),
            'detalles' => $this->whenLoaded('detalles', fn () => $this->detalles->map(function ($detalle) {
                return [
                    'id' => $detalle->id_detalle,
                    'descripcion' => $detalle->descripcion_producto,
                ];
            })),
        ];
    }
}
