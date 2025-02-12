<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Login para empleados
    public function login(Request $request)
    {
        $credentials = $request->only('documento', 'contraseña'); 

        // Intentar autenticar al empleado con documento y contraseña
        $user = $this->authService->loginEmployee($credentials['documento'], $credentials['contraseña']);

        // Retornar la respuesta si el login es exitoso
        if ($user) {
            return response()->json(['user' => $user], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
