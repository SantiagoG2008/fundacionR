<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * Verifica si el usuario actual es administrador (está autenticado)
     */
    public static function isAdmin(): bool
    {
        return Auth::check();
    }

    /**
     * Obtiene el nombre del usuario administrador actual
     */
    public static function getAdminName(): ?string
    {
        if (!self::isAdmin()) {
            return null;
        }

        $user = Auth::user();
        return $user->email ?? $user->name ?? 'Administrador';
    }
}

