<?php

namespace App\Http\Controllers;

use App\Models\Adoptante;
use App\Models\TipoDocum;
use App\Models\LocalidadUsu;
use App\Models\Barrio;
use Illuminate\Http\Request;

class AdoptanteController extends Controller
{
    public function index()
    {
        $adoptantes = Adoptante::with(['tipoDocumento', 'localidad', 'barrio'])->paginate(10);
        return view('adoptantes.index', compact('adoptantes'));
    }

    public function create()
    {
        $tipos = TipoDocum::all();
        $localidades = LocalidadUsu::all();
        $barrios = Barrio::all();
        return view('adoptantes.create', compact('tipos', 'localidades', 'barrios'));
    }

    public function store(Request $request)
    {
        $messages = ['nro_docum.unique' => 'El número de documento ya está registrado.',];
        $data = $request->validate([
            'nombres' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:100',
            'edad' => 'nullable|integer',
            'nro_docum' => 'required|integer|unique:adoptantes,nro_docum',
            'id_tipo' => 'required|exists:tipo_docum,id_tipo',
            'correo' => 'nullable|email|max:100',
            'sexo' => 'nullable|string|max:10',
            'id_localidad' => 'required|exists:localidad_usu,id_localidad',
            'barrio_viv' => 'required|string|max:100',
            'rol' => 'required|in:adoptante,donante,ambos',
        ], $messages);

        $barrio = Barrio::firstOrCreate([
            'nombre_barrio' => $data['barrio_viv'],
            'id_localidad' => $data['id_localidad'],
        ]);

        Adoptante::create([
            'nombres' => $data['nombres'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'edad' => $data['edad'],
            'nro_docum' => $data['nro_docum'],
            'id_tipo' => $data['id_tipo'],
            'correo' => $data['correo'],
            'sexo' => $data['sexo'],
            'id_localidad' => $data['id_localidad'],
            'id_barrio' => $barrio->id_barrio,
            'rol' => $data['rol'],
        ]);

        return redirect()->route('adoptantes.index')->with('success', 'Adoptante registrado correctamente.');
    }

    public function edit(Adoptante $adoptante)
    {
        $tipos = TipoDocum::all();
        $localidades = LocalidadUsu::all();
        $barrios = Barrio::all();
        return view('adoptantes.edit', compact('adoptante', 'tipos', 'localidades', 'barrios'));
    }

    public function update(Request $request, Adoptante $adoptante)
    {
        $messages = [
            'nro_docum.unique' => 'El número de documento ya está registrado por otro adoptante.',
        ];

        $data = $request->validate([
            'nombres' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:100',
            'edad' => 'nullable|integer',
            'nro_docum' => 'required|integer|unique:adoptantes,nro_docum,' . $adoptante->id_adoptante . ',id_adoptante',
            'id_tipo' => 'required|exists:tipo_docum,id_tipo',
            'correo' => 'nullable|email|max:100',
            'sexo' => 'nullable|string|max:10',
            'id_localidad' => 'required|exists:localidad_usu,id_localidad',
            'barrio_viv' => 'required|string|max:100',
            'rol' => 'required|in:adoptante,donante,ambos',
        ], $messages);

        $barrio = Barrio::firstOrCreate([
            'nombre_barrio' => $data['barrio_viv'],
            'id_localidad' => $data['id_localidad'],
        ]);

        $adoptante->update([
            'nombres' => $data['nombres'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'edad' => $data['edad'],
            'nro_docum' => $data['nro_docum'],
            'id_tipo' => $data['id_tipo'],
            'correo' => $data['correo'],
            'sexo' => $data['sexo'],
            'id_localidad' => $data['id_localidad'],
            'id_barrio' => $barrio->id_barrio,
            'rol' => $data['rol'],
        ]);

        return redirect()->route('adoptantes.index')->with('success', 'Adoptante actualizado correctamente.');
    }

    public function destroy(Adoptante $adoptante)
    {
        $adoptante->delete();
        return redirect()->route('adoptantes.index')->with('success', 'Adoptante eliminado correctamente.');
    }
}
