<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Taquilla;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('Las credenciales ingresadas no son correctas.'),
            ]);
        }
    
        $user = Auth::user();
    
        // ✅ Solo permitir acceso a asesores y admins
        if ($user->rol !== 'asesor' && $user->rol !== 'admin') {
            Auth::logout();
            return back()->withErrors(['email' => 'No tienes permisos para acceder.']);
        }
    
        $request->session()->regenerate();
    
        return redirect()->route('gestion-turnos');

        if ($user->rol === 'asesor' && !$user->taquilla_id) {
            $taquillaDisponible = Taquilla::whereDoesntHave('users')->first();
        
            if ($taquillaDisponible) {
                $user->taquilla_id = $taquillaDisponible->id;
                $user->save();
            }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
