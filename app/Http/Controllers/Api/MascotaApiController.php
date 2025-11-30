<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MascotaResource;
use App\Models\Mascota;
use App\Models\Raza;
use App\Models\DetalleCondicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MascotaApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 12) ?? 12, 50);

        $mascotas = Mascota::with(['raza', 'estado', 'condicion'])
            ->when($request->filled('estado'), function ($query) use ($request) {
                $query->whereHas('estado', function ($sub) use ($request) {
                    $sub->where('descripcion', 'like', '%' . $request->estado . '%');
                });
            })
            ->when($request->filled('raza'), function ($query) use ($request) {
                $query->whereHas('raza', function ($sub) use ($request) {
                    $sub->where('nombre_raza', 'like', '%' . $request->raza . '%');
                });
            })
            ->latest('id_mascota')
            ->paginate($perPage);

        return MascotaResource::collection($mascotas);
    }

    public function store(Request $request)
    {
        $payload = $this->preparePayload($request);

        $mascota = Mascota::create($payload);

        return (new MascotaResource($mascota->load(['raza', 'estado', 'condicion', 'historiasClinicas'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $mascota = Mascota::with(['raza', 'estado', 'condicion', 'historiasClinicas'])->findOrFail($id);

        return new MascotaResource($mascota);
    }

    public function update(Request $request, $id)
    {
        $mascota = Mascota::findOrFail($id);

        $payload = $this->preparePayload($request, $mascota);

        $mascota->update($payload);

        return new MascotaResource($mascota->load(['raza', 'estado', 'condicion', 'historiasClinicas']));
    }

    public function destroy($id)
    {
        $mascota = Mascota::findOrFail($id);

        if ($mascota->condicion_id) {
            DetalleCondicion::where('id_condicion', $mascota->condicion_id)->delete();
        }

        if ($mascota->imagen && Storage::disk('public')->exists($mascota->imagen)) {
            Storage::disk('public')->delete($mascota->imagen);
        }

        $mascota->delete();

        return response()->json(['message' => 'Mascota eliminada correctamente.']);
    }

    protected function preparePayload(Request $request, ?Mascota $mascota = null): array
    {
        $rules = [
            'nombre_mascota' => 'required|string|max:255',
            'edad' => 'required|integer',
            'vacunado' => 'required',
            'peligroso' => 'required',
            'esterilizado' => 'required',
            'destetado' => 'required',
            'genero' => 'required|string|max:10',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'crianza' => 'required',
            'fecha_ingreso' => 'required|date',
            'estado_id' => 'required|exists:estados,id_estado',
            'nombre_raza' => 'required|string|max:100',
            'descripcion_condicion' => 'nullable|string',
            'condiciones_especiales' => 'nullable',
        ];

        $data = $request->validate($rules);

        foreach (['vacunado', 'peligroso', 'esterilizado', 'destetado', 'crianza', 'condiciones_especiales'] as $booleanField) {
            if (array_key_exists($booleanField, $data)) {
                $data[$booleanField] = filter_var($data[$booleanField], FILTER_VALIDATE_BOOLEAN);
            }
        }

        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('imagenes', 'public');
            $data['imagen'] = $ruta;
            if ($mascota && $mascota->imagen && Storage::disk('public')->exists($mascota->imagen)) {
                Storage::disk('public')->delete($mascota->imagen);
            }
        } else {
            unset($data['imagen']);
        }

        $raza = Raza::firstOrCreate(['nombre_raza' => $data['nombre_raza']]);
        $data['raza_id'] = $raza->id_raza;
        unset($data['nombre_raza']);

        $descripcionCondicion = $data['descripcion_condicion'] ?? null;
        unset($data['descripcion_condicion']);

        if (!empty($data['condiciones_especiales']) && $descripcionCondicion) {
            if ($mascota && $mascota->condicion_id) {
                DetalleCondicion::where('id_condicion', $mascota->condicion_id)->delete();
            }
            $detalle = DetalleCondicion::create(['descripcion' => $descripcionCondicion]);
            $data['condicion_id'] = $detalle->id_condicion;
            $data['condiciones_especiales'] = true;
        } else {
            if ($mascota && $mascota->condicion_id) {
                DetalleCondicion::where('id_condicion', $mascota->condicion_id)->delete();
            }
            $data['condicion_id'] = null;
            $data['condiciones_especiales'] = false;
        }

        return $data;
    }
}
