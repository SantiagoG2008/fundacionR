<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoriaClinicaResource extends JsonResource
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
            'id' => $this->id_historia,
            'fecha_chequeo' => $this->fecha_chequeo,
            'peso' => $this->peso,
            'tratamiento' => $this->tratamiento,
            'observaciones' => $this->observaciones,
            'cuidados' => $this->cuidados,
            'mascota' => $this->whenLoaded('mascota', fn () => [
                'id' => $this->mascota->id_mascota,
                'nombre' => $this->mascota->nombre_mascota,
                'imagen_url' => $this->mascota->imagen_url,
            ]),
        ];
    }
}
