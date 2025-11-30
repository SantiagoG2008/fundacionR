<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HistoriaClinicaResource;

class MascotaResource extends JsonResource
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
            'id' => $this->id_mascota,
            'nombre' => $this->nombre_mascota,
            'edad' => $this->edad,
            'genero' => $this->genero,
            'vacunado' => (bool) $this->vacunado,
            'peligroso' => (bool) $this->peligroso,
            'esterilizado' => (bool) $this->esterilizado,
            'destetado' => (bool) $this->destetado,
            'crianza' => (bool) $this->crianza,
            'condiciones_especiales' => (bool) $this->condiciones_especiales,
            'fecha_ingreso' => $this->fecha_ingreso,
            'imagen_url' => $this->imagen_url,
            'estado' => $this->whenLoaded('estado', function () {
                return [
                    'id' => $this->estado->id_estado,
                    'nombre' => $this->estado->descripcion,
                ];
            }),
            'raza' => $this->whenLoaded('raza', function () {
                return [
                    'id' => $this->raza->id_raza,
                    'nombre' => $this->raza->nombre_raza,
                ];
            }),
            'condicion' => $this->whenLoaded('condicion', function () {
                return [
                    'id' => $this->condicion->id_condicion,
                    'descripcion' => $this->condicion->descripcion,
                ];
            }),
            'historias_clinicas' => HistoriaClinicaResource::collection(
                $this->whenLoaded('historiasClinicas')
            ),
        ];
    }
}
