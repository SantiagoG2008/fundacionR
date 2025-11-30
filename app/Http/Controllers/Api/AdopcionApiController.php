<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdopcionResource;
use App\Models\Adopcion;
use Illuminate\Http\Request;

class AdopcionApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 10) ?? 10, 50);

        $adopciones = Adopcion::with(['mascota', 'adoptante'])
            ->latest('id_adopcion')
            ->paginate($perPage);

        return AdopcionResource::collection($adopciones);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $adopcion = Adopcion::create($data);

        return (new AdopcionResource($adopcion->load(['mascota', 'adoptante'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $adopcion = Adopcion::with(['mascota', 'adoptante'])->findOrFail($id);

        return new AdopcionResource($adopcion);
    }

    public function update(Request $request, $id)
    {
        $adopcion = Adopcion::findOrFail($id);

        $data = $this->validateData($request);

        $adopcion->update($data);

        return new AdopcionResource($adopcion->load(['mascota', 'adoptante']));
    }

    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $adopcion->delete();

        return response()->json(['message' => 'Adopción eliminada correctamente.']);
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'id_mascota' => 'required|exists:mascota,id_mascota',
            'id_adoptante' => 'required|exists:adoptantes,id_adoptante',
            'fecha_adopcion' => 'nullable|date',
            'observaciones' => 'required|string|max:255',
        ]);
    }
}

