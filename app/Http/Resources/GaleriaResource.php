<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GaleriaResource extends JsonResource
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
            'id' => $this->id_imagen,
            'nombre' => $this->nombre,
            'ruta' => $this->ruta,
            'ruta_url' => $this->ruta_url,
            'mascota' => $this->whenLoaded('mascota', fn () => [
                'id' => $this->mascota->id_mascota,
                'nombre' => $this->mascota->nombre_mascota,
            ]),
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
