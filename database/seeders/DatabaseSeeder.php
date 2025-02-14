<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Taquilla; // ✅ Importar el modelo Taquilla
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ✅ Crear taquillas
        for ($i = 1; $i <= 5; $i++) {
            Taquilla::firstOrCreate(['nombre' => "Taquilla $i"]);
        }

        // ✅ Crear asesores y asignarlos a taquillas
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate([
                'email' => "asesor$i@example.com",
            ], [
                'name' => "Asesor $i",
                'password' => Hash::make('password'),
                'rol' => 'asesor',
                'documento' => "12345678$i",
                'taquilla_id' => $i, // Asignar taquilla correspondiente
            ]);
        }

        // ✅ Crear usuario administrador
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'rol' => 'admin',
            'documento' => '999999999',
        ]);

        $this->command->info("✅ Usuario Admin creado: admin@example.com | Contraseña: password");
    }
}
