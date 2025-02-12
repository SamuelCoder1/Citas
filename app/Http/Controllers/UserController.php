<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Crear un empleado (medico o admin)
    public function storeEmployee(Request $request)
    {
        // Validación de los datos del request
        $validated = $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'documento' => 'required|string|unique:users,documento',
            'contraseña' => 'required|string', // Cambié "password" por "contraseña"
            'rol' => 'required|in:medico,admin',
        ]);

        // Crear el empleado utilizando el servicio
        $user = $this->userService->createEmployee($validated);

        // Retornar el usuario creado
        return response()->json(['user' => $user], 201);
    }
}
