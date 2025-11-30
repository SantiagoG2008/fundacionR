<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MensajeResource;
use App\Models\Contacto;
use Illuminate\Http\Request;

class MensajeApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'store']);
    }

    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 10) ?? 10, 50);

        $mensajes = Contacto::latest()->paginate($perPage);

        return MensajeResource::collection($mensajes);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'asunto' => 'required|string|max:150',
            'mensaje' => 'required|string|max:1000',
        ]);

        $mensaje = Contacto::create($data);

        return (new MensajeResource($mensaje))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $mensaje = Contacto::findOrFail($id);

        return new MensajeResource($mensaje);
    }

    public function update(Request $request, $id)
    {
        $mensaje = Contacto::findOrFail($id);

        $data = $request->validate([
            'leido' => 'required|boolean',
        ]);

        $mensaje->update($data);

        return new MensajeResource($mensaje);
    }

    public function destroy($id)
    {
        $mensaje = Contacto::findOrFail($id);
        $mensaje->delete();

        return response()->json(['message' => 'Mensaje eliminado correctamente.']);
    }
}

