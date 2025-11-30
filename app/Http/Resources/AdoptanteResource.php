<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdoptanteResource extends JsonResource
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
            'id' => $this->id_adoptante,
            'nombres' => $this->nombres,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'edad' => $this->edad,
            'documento' => $this->nro_docum,
            'correo' => $this->correo,
            'sexo' => $this->sexo,
            'rol' => $this->rol,
            'tipo_documento' => $this->whenLoaded('tipoDocumento', function () {
                return [
                    'id' => $this->tipoDocumento->id_tipo,
                    'nombre' => $this->tipoDocumento->descripcion ?? $this->tipoDocumento->nombre ?? null,
                ];
            }),
            'localidad' => $this->whenLoaded('localidad', function () {
                return [
                    'id' => $this->localidad->id_localidad,
                    'nombre' => $this->localidad->nombre_localidad ?? $this->localidad->nombre ?? null,
                ];
            }),
            'barrio' => $this->whenLoaded('barrio', function () {
                return [
                    'id' => $this->barrio->id_barrio,
                    'nombre' => $this->barrio->nombre_barrio ?? $this->barrio->nombre ?? null,
                ];
            }),
        ];
    }
}
