<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InformeResumenResource extends JsonResource
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
            'mascotas' => $this->resource['mascotas'] ?? 0,
            'adoptantes' => $this->resource['adoptantes'] ?? 0,
            'adopciones' => $this->resource['adopciones'] ?? 0,
            'historias_clinicas' => $this->resource['historias_clinicas'] ?? 0,
            'galeria' => $this->resource['galeria'] ?? 0,
            'donaciones' => $this->resource['donaciones'] ?? 0,
            'mensajes' => $this->resource['mensajes'] ?? 0,
            'ultima_actualizacion' => now()->toDateTimeString(),
        ];
    }
}
