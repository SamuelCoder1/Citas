<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Taquilla;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::viaRequest('session', function ($request) {
            if (Auth::check()) {
                $user = Auth::user();

                // Si el usuario es un asesor y no tiene taquilla asignada
                if ($user->rol === 'asesor' && !$user->taquilla_id) {
                    // Buscar una taquilla disponible (que no tenga asesores asignados)
                    $taquillaDisponible = Taquilla::whereDoesntHave('users')->first();

                    if ($taquillaDisponible) {
                        $user->taquilla_id = $taquillaDisponible->id;
                        $user->save();
                    }
                }

                return $user;
            }
        });

        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->rol === 'admin';
        });
    }
}
