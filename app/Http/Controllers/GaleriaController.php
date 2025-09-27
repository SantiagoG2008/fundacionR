<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\Mascota;


class GaleriaController extends Controller
{
    
public function create()
{
    $mascotas = Mascota::all(); // para llenar un select con mascotas, si lo necesitas
    return view('galeria.create', compact('mascotas'));
}

public function index()
{
    $imagenes = Galeria::with('mascota')->paginate(10); // usa paginate en lugar de get()
    return view('galeria.index', compact('imagenes'));
}

    // -----------------------------
    // -----------------------------
 public function store(Request $request)
{
    $request->validate([
        'id_mascota'     => 'required|exists:mascota,id_mascota',
        'nombre'         => 'required|string',
        'ruta'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // debe coincidir con el nombre del input
    ]);

    $rutaImagen = null;

    // Verifica si viene el archivo 'ruta' (que es el nombre del campo en el formulario)
    if ($request->hasFile('ruta')) {
        $file = $request->file('ruta'); // asegúrate que el input tenga name="ruta"
        $filename = time() . '_' . $file->getClientOriginalName();
        $ruta = $file->storeAs('imagenes', $filename, 'public');
        $rutaImagen = 'storage/' . $ruta;
    }

    // Crear la imagen con los datos, incluyendo la ruta si se subió
    Galeria::create([
        'id_mascota' => $request->id_mascota,
        'nombre'     => $request->nombre,
        'ruta'       => $rutaImagen,
    ]);

    return redirect()->route('galeria.index')->with('success', 'Imagen registrada correctamente.');
}





    public function edit($id)
    {
        $imagen = Galeria::findOrFail($id);

        $mascotas = Mascota::all();
        return view('galeria.edit', compact('imagen', 'mascotas'));
    }

    public function update(Request $request, $id)
{
    $imagen = Galeria::findOrFail($id);

    $request->validate([
        'id_mascota' => 'required|exists:mascota,id_mascota',
        'nombre'     => 'required|string|max:100',
        'nueva_ruta' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $datos = $request->only(['id_mascota', 'nombre']);

    // Si hay una nueva imagen, la subimos y reemplazamos
    if ($request->hasFile('nueva_ruta')) {
        $file = $request->file('nueva_ruta');
        $filename = time() . '_' . $file->getClientOriginalName();
        $ruta = $file->storeAs('imagenes', $filename, 'public');
        $datos['ruta'] = 'storage/' . $ruta;
    }

    $imagen->update($datos);

    return redirect()->route('galeria.index')->with('success', 'Registro actualizado.');
}
public function destroy($id)
{
    $imagen = Galeria::findOrFail($id);
    $imagen->delete();

    return redirect()->route('galeria.index')->with('success', 'Imagen eliminada correctamente.');
}


}
