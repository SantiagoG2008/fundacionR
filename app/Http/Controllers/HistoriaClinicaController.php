<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use App\Models\Mascota;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function index()
    {
        $historias = HistoriaClinica::with('mascota')->paginate(10);
        return view('historia_clinicas.index', compact('historias'));
    }

    public function create()
    {
        $mascotas = Mascota::all();
        return view('historia_clinicas.create', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'id_mascota'    => 'required|exists:mascota,id_mascota',
        'fecha_chequeo'   => 'required|date',
        'peso'            => 'required|numeric',
        'tratamiento'     => 'required|string',
        'observaciones'   => 'nullable|string',
        'cuidados'        => 'nullable|string',
        ]);

        HistoriaClinica::create($request->all());
        return redirect()->route('historia_clinicas.index')->with('success', 'Registro creado.');
    }

    public function edit(HistoriaClinica $historiaClinica)
    {
        $mascotas = Mascota::all();
        return view('historia_clinicas.edit', compact('historiaClinica', 'mascotas'));
    }

    public function update(Request $request, HistoriaClinica $historiaClinica)
    {
        $request->validate([
           'id_mascota'    => 'required|exists:mascota,id_mascota',
        'fecha_chequeo'   => 'required|date',
        'peso'            => 'required|numeric',
        'tratamiento'     => 'required|string',
        'observaciones'   => 'nullable|string',
        'cuidados'        => 'nullable|string',
        ]);

        $historiaClinica->update($request->all());
        return redirect()->route('historia_clinicas.index')->with('success', 'Registro actualizado.');
    }

    public function destroy(HistoriaClinica $historiaClinica)
    {
        $historiaClinica->delete();
        return redirect()->route('historia_clinicas.index')->with('success', 'Registro eliminado.');
    }
}