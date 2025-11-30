<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdoptanteResource;
use App\Models\Adoptante;
use App\Models\Barrio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdoptanteApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 12) ?? 12, 50);

        $adoptantes = Adoptante::with(['tipoDocumento', 'localidad', 'barrio'])
            ->when($request->filled('rol'), fn ($query) => $query->where('rol', $request->rol))
            ->latest('id_adoptante')
            ->paginate($perPage);

        return AdoptanteResource::collection($adoptantes);
    }

    public function store(Request $request)
    {
        $payload = $this->preparePayload($request);

        $adoptante = Adoptante::create($payload);

        return (new AdoptanteResource($adoptante->load(['tipoDocumento', 'localidad', 'barrio'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $adoptante = Adoptante::with(['tipoDocumento', 'localidad', 'barrio'])->findOrFail($id);

        return new AdoptanteResource($adoptante);
    }

    public function update(Request $request, $id)
    {
        $adoptante = Adoptante::findOrFail($id);

        $payload = $this->preparePayload($request, $adoptante);

        $adoptante->update($payload);

        return new AdoptanteResource($adoptante->load(['tipoDocumento', 'localidad', 'barrio']));
    }

    public function destroy($id)
    {
        $adoptante = Adoptante::findOrFail($id);
        $adoptante->delete();

        return response()->json(['message' => 'Adoptante eliminado correctamente.']);
    }

    protected function preparePayload(Request $request, ?Adoptante $adoptante = null): array
    {
        $rules = [
            'nombres' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:100',
            'edad' => 'nullable|integer',
            'nro_docum' => [
                'required',
                'integer',
                Rule::unique('adoptantes', 'nro_docum')->ignore($adoptante?->id_adoptante, 'id_adoptante'),
            ],
            'id_tipo' => 'required|exists:tipo_docum,id_tipo',
            'correo' => 'nullable|email|max:100',
            'sexo' => 'nullable|in:M,F,O',
            'id_localidad' => 'required|exists:localidad_usu,id_localidad',
            'barrio_viv' => 'required|string|max:100',
            'rol' => 'required|in:adoptante,donante,ambos',
        ];

        $data = $request->validate($rules);

        $barrio = Barrio::firstOrCreate([
            'nombre_barrio' => $data['barrio_viv'],
            'id_localidad' => $data['id_localidad'],
        ]);

        $data['id_barrio'] = $barrio->id_barrio;
        unset($data['barrio_viv']);

        return $data;
    }
}
