<?php

use App\Livewire\GestionTurnos;
use App\Livewire\SolicitarTurno;
use App\Livewire\PantallaTurnos;
use App\Livewire\AdminGestionAsesores;
use App\Livewire\AdminGestionTaquillas;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Rutas públicas
Route::get('/solicitar-turno', SolicitarTurno::class)->name('solicitar-turno');
Route::get('/pantalla-turnos', PantallaTurnos::class)->name('pantalla-turnos');

// ✅ Rutas protegidas para asesores
Route::middleware(['auth'])->group(function () {
    Route::get('/gestion-turnos', GestionTurnos::class)->name('gestion-turnos');

    // ✅ Rutas protegidas solo para admins usando `Gate::authorize`
    Route::get('/admin/asesores', function () {
        Gate::authorize('admin'); // 🔹 Verifica si el usuario es admin
        return app(AdminGestionAsesores::class);
    })->name('admin.asesores');

    Route::get('/admin/taquillas', function () {
        Gate::authorize('admin'); // 🔹 Verifica si el usuario es admin
        return app(AdminGestionTaquillas::class);
    })->name('admin.taquillas');
});

// ✅ Ruta para cerrar sesión
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
