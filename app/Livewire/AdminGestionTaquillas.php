<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Taquilla;

class AdminGestionTaquillas extends Component
{
    public $nombre, $taquillaId;
    public $taquillas;

    public function mount()
    {
        $this->taquillas = Taquilla::all();
    }

    public function save()
    {
        $this->validate(['nombre' => 'required|unique:taquillas,nombre,' . $this->taquillaId]);
        
        Taquilla::updateOrCreate(['id' => $this->taquillaId], ['nombre' => $this->nombre]);

        session()->flash('message', $this->taquillaId ? 'Taquilla actualizada' : 'Taquilla creada');
        $this->reset();
        $this->mount();
    }

    public function edit($id)
    {
        $taquilla = Taquilla::find($id);
        $this->taquillaId = $taquilla->id;
        $this->nombre = $taquilla->nombre;
    }

    public function delete($id)
    {
        Taquilla::find($id)->delete();
        session()->flash('message', 'Taquilla eliminada');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin-gestion-taquillas')->layout('layouts.app');
    }
}
