<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GaleriaResource;
use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 12) ?? 12, 60);

        $imagenes = Galeria::with('mascota')
            ->latest('id_imagen')
            ->paginate($perPage);

        return GaleriaResource::collection($imagenes);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('ruta')) {
            $data['ruta'] = $request->file('ruta')->store('imagenes', 'public');
        }

        $imagen = Galeria::create($data);

        return (new GaleriaResource($imagen->load('mascota')))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $imagen = Galeria::with('mascota')->findOrFail($id);

        return new GaleriaResource($imagen);
    }

    public function update(Request $request, $id)
    {
        $imagen = Galeria::findOrFail($id);

        $data = $this->validateData($request, true);

        if ($request->hasFile('ruta')) {
            if ($imagen->ruta && Storage::disk('public')->exists($imagen->ruta)) {
                Storage::disk('public')->delete($imagen->ruta);
            }
            $data['ruta'] = $request->file('ruta')->store('imagenes', 'public');
        } else {
            unset($data['ruta']);
        }

        $imagen->update($data);

        return new GaleriaResource($imagen->load('mascota'));
    }

    public function destroy($id)
    {
        $imagen = Galeria::findOrFail($id);

        if ($imagen->ruta && Storage::disk('public')->exists($imagen->ruta)) {
            Storage::disk('public')->delete($imagen->ruta);
        }

        $imagen->delete();

        return response()->json(['message' => 'Imagen eliminada correctamente.']);
    }

    protected function validateData(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'id_mascota' => 'required|exists:mascota,id_mascota',
            'nombre' => 'required|string|max:100',
            'ruta' => [$isUpdate ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);
    }
}

