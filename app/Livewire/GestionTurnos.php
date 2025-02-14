<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;

class GestionTurnos extends Component
{
    public $turnoActual;

    protected $listeners = ['refreshComponent' => '$refresh']; // 🔄 Auto-actualización

    public function mount()
    {
        $this->turnoActual = Turno::where('estado', 'En Atención')->where('asesor_id', Auth::id())->latest()->first();
    }

    public function siguienteTurno()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debe iniciar sesión para llamar turnos.');
            return;
        }

        if ($this->turnoActual) {
            $this->turnoActual->update(['estado' => 'Atendido']);
        }

        $nuevoTurno = Turno::where('estado', 'En Espera')->orderBy('numero_turno')->first();

        if ($nuevoTurno) {
            $nuevoTurno->update([
                'estado' => 'En Atención',
                'asesor_id' => Auth::id(),
                'taquilla_id' => Auth::user()->taquilla_id,
            ]);

            $this->turnoActual = $nuevoTurno;

            // 🔊 Emitir evento para actualizar pantalla y reproducir sonido
            $this->emit('nuevoTurnoLlamado', $nuevoTurno->numero_turno);
        }

        $this->emit('refreshComponent'); // 🔄 Refresca la vista después de llamar un turno
    }

    public function render()
    {
        return view('livewire.gestion-turnos', [
            'turnoActual' => $this->turnoActual,
        ])->layout('layouts.app');
    }
}
