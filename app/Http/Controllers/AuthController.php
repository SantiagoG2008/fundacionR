<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenido al panel administrativo');
        }

        return back()
            ->withErrors(['credentials' => 'El correo o la contraseña son incorrectos.'])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'Sesión cerrada correctamente');
    }
}
