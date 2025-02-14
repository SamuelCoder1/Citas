<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Turno;
use App\Models\Taquilla;

class PantallaTurnos extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh']; // 🔄 Auto-actualización

    public function render()
    {
        return view('livewire.pantalla-turnos', [
            'taquillas' => Taquilla::whereHas('users')->get(), // ✅ Solo taquillas con asesores activos
            'turnosEnAtencion' => Turno::where('estado', 'En Atención')->get(),
        ])->layout('layouts.app'); 
    }
}
