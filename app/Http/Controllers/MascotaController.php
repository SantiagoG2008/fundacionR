<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Raza;
use App\Models\Estado;
use App\Models\DetalleCondicion;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotas = Mascota::with(['raza', 'estado', 'condicion'])->paginate(10);
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        $razas = Raza::all();
        $estados = Estado::all();
        return view('mascotas.create', compact('razas', 'estados'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_mascota' => 'required|string|max:255',
            'edad' => 'required|integer',
            'vacunado' => 'required|boolean',
            'peligroso' => 'required|boolean',
            'esterilizado' => 'required|boolean',
            'destetado' => 'required|boolean',
            'genero' => 'required|string|max:10',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'crianza' => 'required|boolean',
            'fecha_ingreso' => 'required|date',
            'estado_id' => 'required|exists:estados,id_estado',
            'nombre_raza' => 'required|string|max:100',
            'descripcion_condicion' => 'nullable|string',
        ]);

        // Procesar imagen
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('imagenes', 'public');
            $data['imagen'] = $ruta;
        }

        // Crear o asociar raza
        $raza = Raza::firstOrCreate(['nombre_raza' => $request->nombre_raza]);
        $data['raza_id'] = $raza->id_raza;
        unset($data['nombre_raza']);

        // Condición especial
        if ($request->has('condiciones_especiales') && $request->filled('descripcion_condicion')) {
            $detalle = DetalleCondicion::create(['descripcion' => $request->descripcion_condicion]);
            $data['condicion_id'] = $detalle->id_condicion;
            $data['condiciones_especiales'] = 1;
        } else {
            $data['condicion_id'] = null;
            $data['condiciones_especiales'] = 0;
        }

        Mascota::create($data);

        return redirect()->route('mascotas.index')->with('success', 'Mascota registrada correctamente.');
    }

    public function edit(Mascota $mascota)
    {
        $razas = Raza::all();
        $estados = Estado::all();
        return view('mascotas.edit', compact('mascota', 'razas', 'estados'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        $data = $request->validate([
            'nombre_mascota' => 'required|string|max:255',
            'edad' => 'required|integer',
            'vacunado' => 'required|boolean',
            'peligroso' => 'required|boolean',
            'esterilizado' => 'required|boolean',
            'destetado' => 'required|boolean',
            'genero' => 'required|string|max:10',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'crianza' => 'required|boolean',
            'fecha_ingreso' => 'required|date',
            'estado_id' => 'required|exists:estados,id_estado',
            'nombre_raza' => 'required|string|max:100',
            'descripcion_condicion' => 'nullable|string',
            'condiciones_especiales' => 'nullable|boolean',
        ]);

        // Imagen nueva
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('imagenes', 'public');
            $data['imagen'] = $ruta;
        }

        // Crear o asociar raza
        $raza = Raza::firstOrCreate(['nombre_raza' => $request->nombre_raza]);
        $data['raza_id'] = $raza->id_raza;
        unset($data['nombre_raza']);

        // Condición especial
        $tieneCondicion = $request->input('condiciones_especiales') == 1;

        if ($tieneCondicion && $request->filled('descripcion_condicion')) {
            if ($mascota->condicion_id) {DetalleCondicion::where('id_condicion', $mascota->condicion_id)->delete();}
            $detalle = DetalleCondicion::create(['descripcion' => $request->descripcion_condicion]);
            $data['condicion_id'] = $detalle->id_condicion;
            $data['condiciones_especiales'] = 1;
        } else {
            if ($mascota->condicion_id) {DetalleCondicion::where('id_condicion', $mascota->condicion_id)->delete();}
            $data['condicion_id'] = null;
            $data['condiciones_especiales'] = 0;
        }

        unset($data['descripcion_condicion']);

        $mascota->update($data);

        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada correctamente.');
    }

    public function destroy(Mascota $mascota)
    {
        if ($mascota->condicion_id) {
            DetalleCondicion::where('id_condicion', $mascota->condicion_id)->delete();
        }

        $mascota->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada correctamente.');
    }
}