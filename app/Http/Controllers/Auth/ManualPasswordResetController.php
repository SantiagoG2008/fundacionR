<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ManualResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ManualPasswordResetController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(ManualResetRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->validated()['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No encontramos un usuario con ese correo.'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'La contraseña se actualizó correctamente. Ya puedes iniciar sesión con la nueva clave.');
    }
}


