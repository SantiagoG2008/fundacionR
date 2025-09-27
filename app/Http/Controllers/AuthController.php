<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        // Validación simple con credenciales fijas
        if ($request->usuario === 'admin' && $request->contraseña === 'admin') {
            Session::put('authenticated', true);
            Session::put('user', 'admin');
            
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenido al panel administrativo');
        }

        return back()->withErrors([
            'credentials' => 'Las credenciales proporcionadas no son correctas.',
        ])->withInput($request->only('usuario'));
    }

    public function logout()
    {
        Session::forget(['authenticated', 'user']);
        return redirect()->route('home')->with('success', 'Sesión cerrada correctamente');
    }
}
