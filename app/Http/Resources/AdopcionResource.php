<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdopcionResource extends JsonResource
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
            'id' => $this->id_adopcion,
            'fecha_adopcion' => $this->fecha_adopcion,
            'observaciones' => $this->observaciones,
            'mascota' => $this->whenLoaded('mascota', fn () => [
                'id' => $this->mascota->id_mascota,
                'nombre' => $this->mascota->nombre_mascota,
                'imagen_url' => $this->mascota->imagen_url,
            ]),
            'adoptante' => $this->whenLoaded('adoptante', fn () => [
                'id' => $this->adoptante->id_adoptante,
                'nombres' => $this->adoptante->nombres,
                'telefono' => $this->adoptante->telefono,
            ]),
        ];
    }
}
