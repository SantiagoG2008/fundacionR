<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class PublicController extends Controller
{
    public function home()
    {
        return view('public.home');
    }

    public function adopta()
    {
        return view('public.adopta');
    }

    public function donar()
    {
        return view('public.donar');
    }

    public function quienesSomos()
    {
        return view('public.quienes-somos');
    }

    public function contacto()
    {
        return view('public.contacto');
    }

    public function storeContacto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string|max:1000',
        ]);

        Contacto::create($request->all());

        return redirect()->route('contacto')->with('success', '¡Gracias por tu mensaje! Te contactaremos pronto.');
    }

    public function voluntarios()
    {
        return view('public.voluntarios');
    }

    public function padrinos()
    {
        return view('public.padrinos');
    }

    public function casosEspeciales()
    {
        return view('public.casos-especiales');
    }

    public function canalesDonacion()
    {
        return view('public.canales-donacion');
    }
}
