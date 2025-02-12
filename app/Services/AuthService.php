<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function loginEmployee($documento, $contraseña)
    {
        // Intentar autenticar al usuario con el documento y la contraseña
        if (Auth::attempt(['documento' => $documento, 'contraseña' => $contraseña])) { // Cambié "password" por "contraseña"
            return Auth::user();
        }

        return null;
    }
}

