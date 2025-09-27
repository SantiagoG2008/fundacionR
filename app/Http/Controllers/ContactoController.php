<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $contactos = Contacto::orderBy('created_at', 'desc')->paginate(10);
        return view('contactos.index', compact('contactos'));
    }

    public function show(Contacto $contacto)
    {
        // Marcar como leído
        $contacto->update(['leido' => true]);
        return view('contactos.show', compact('contacto'));
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
        return redirect()->route('contactos.index')->with('success', 'Mensaje eliminado correctamente.');
    }
}