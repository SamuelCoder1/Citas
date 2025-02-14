<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminGestionAsesores extends Component
{
    public $name, $email, $password, $documento, $asesorId;
    public $asesores;

    public function mount()
    {
        $this->asesores = User::where('rol', 'asesor')->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->asesorId,
            'documento' => 'required|unique:users,documento,' . $this->asesorId,
            'password' => $this->asesorId ? 'nullable' : 'required|min:6',
        ]);

        User::updateOrCreate(['id' => $this->asesorId], [
            'name' => $this->name,
            'email' => $this->email,
            'documento' => $this->documento,
            'rol' => 'asesor',
            'password' => $this->password ? Hash::make($this->password) : User::find($this->asesorId)->password,
        ]);

        session()->flash('message', $this->asesorId ? 'Asesor actualizado' : 'Asesor creado');
        $this->reset();
        $this->mount();
    }

    public function edit($id)
    {
        $asesor = User::find($id);
        $this->asesorId = $asesor->id;
        $this->name = $asesor->name;
        $this->email = $asesor->email;
        $this->documento = $asesor->documento;
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Asesor eliminado');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin-gestion-asesores')->layout('layouts.app');
    }
}
