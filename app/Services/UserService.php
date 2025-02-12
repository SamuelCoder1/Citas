<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function createEmployee($data)
    {
        // Crear el usuario, asegurándote de que el campo de contraseña sea el correcto
        $user = User::create([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'documento' => $data['documento'],
            'contraseña' => bcrypt($data['contraseña']), // Cambié "password" por "contraseña"
            'rol' => $data['rol'],
        ]);

        return $user;
    }

    public function getEmployeeById($id)
    {
        return User::findOrFail($id);
    }

    public function updateEmployee($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);

        return $user;
    }
}

