<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Mascota;
use App\Models\Adoptante;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    public function index()
    {
        $adopciones = Adopcion::with(['mascota', 'adoptante'])->paginate(10);
        return view('adopciones.index', compact('adopciones'));
    }

    public function create()
    {
        $mascotas = Mascota::all();
        $adoptantes = Adoptante::all();
        return view('adopciones.create', compact('mascotas', 'adoptantes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_mascota' => 'required|exists:mascota,id_mascota',
            'id_adoptante' => 'required|exists:adoptantes,id_adoptante',
            'fecha_adopcion' => 'nullable|date',
            'observaciones' => 'required|string|max:255'
        ]);

        Adopcion::create($data);

        return redirect()->route('adopciones.index')->with('success', 'Adopción registrada correctamente.');
    }

    public function edit(Adopcion $adopcion)
    {
        $mascotas = Mascota::all();
        $adoptantes = Adoptante::all();
        return view('adopciones.edit', compact('adopcion', 'mascotas', 'adoptantes'));
    }

    public function update(Request $request, Adopcion $adopcion)
    {
        $data = $request->validate([
            'id_mascota' => 'required|exists:mascota,id_mascota',
            'id_adoptante' => 'required|exists:adoptantes,id_adoptante',
            'fecha_adopcion' => 'nullable|date',
            'observaciones' => 'required|string|max:255'
        ]);

        $adopcion->update($data);

        return redirect()->route('adopciones.index')->with('success', 'Adopción actualizada correctamente.');
    }

    public function destroy(Adopcion $adopcion)
    {
        $adopcion->delete();

        return redirect()->route('adopciones.index')->with('success', 'Adopción eliminada correctamente.');
    }
}