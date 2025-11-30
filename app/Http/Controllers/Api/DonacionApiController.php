<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonacionResource;
use App\Models\Donacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonacionApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 10) ?? 10, 50);

        $donaciones = Donacion::with(['adoptante', 'detalles'])
            ->latest('id_donacion')
            ->paginate($perPage);

        return DonacionResource::collection($donaciones);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $donacion = DB::transaction(function () use ($data) {
            $detalles = $data['descripcion_producto'];
            unset($data['descripcion_producto']);

            $donacion = Donacion::create($data);
            $donacion->detalles()->create([
                'descripcion_producto' => $detalles,
            ]);

            return $donacion;
        });

        return (new DonacionResource($donacion->load(['adoptante', 'detalles'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $donacion = Donacion::with(['adoptante', 'detalles'])->findOrFail($id);

        return new DonacionResource($donacion);
    }

    public function update(Request $request, $id)
    {
        $donacion = Donacion::findOrFail($id);
        $data = $this->validateData($request);

        DB::transaction(function () use ($donacion, $data) {
            $descripcion = $data['descripcion_producto'];
            unset($data['descripcion_producto']);

            $donacion->update($data);
            $donacion->detalles()->delete();
            $donacion->detalles()->create([
                'descripcion_producto' => $descripcion,
            ]);
        });

        return new DonacionResource($donacion->load(['adoptante', 'detalles']));
    }

    public function destroy($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->delete();

        return response()->json(['message' => 'Donación eliminada correctamente.']);
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'tipo' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'fecha' => 'required|date',
            'id_adoptante' => 'required|exists:adoptantes,id_adoptante',
            'descripcion_producto' => 'required|string|max:255',
        ]);
    }
}

