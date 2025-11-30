<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriaClinicaResource;
use App\Models\HistoriaClinica;
use Illuminate\Http\Request;

class HistoriaClinicaApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 10) ?? 10, 50);

        $historias = HistoriaClinica::with('mascota')
            ->latest('id_historia')
            ->paginate($perPage);

        return HistoriaClinicaResource::collection($historias);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $historia = HistoriaClinica::create($data);

        return (new HistoriaClinicaResource($historia->load('mascota')))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $historia = HistoriaClinica::with('mascota')->findOrFail($id);

        return new HistoriaClinicaResource($historia);
    }

    public function update(Request $request, $id)
    {
        $historia = HistoriaClinica::findOrFail($id);

        $data = $this->validateData($request);

        $historia->update($data);

        return new HistoriaClinicaResource($historia->load('mascota'));
    }

    public function destroy($id)
    {
        $historia = HistoriaClinica::findOrFail($id);
        $historia->delete();

        return response()->json(['message' => 'Registro eliminado correctamente.']);
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'id_mascota' => 'required|exists:mascota,id_mascota',
            'fecha_chequeo' => 'required|date',
            'peso' => 'required|numeric',
            'tratamiento' => 'required|string',
            'observaciones' => 'nullable|string',
            'cuidados' => 'nullable|string',
        ]);
    }
}

