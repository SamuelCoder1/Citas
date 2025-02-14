<div class="flex flex-col items-center space-y-4 p-6">
    <h1 class="text-2xl font-bold">Solicitar Turno</h1>
    <input type="text" wire:model="cedula" placeholder="Ingrese su cédula"
        class="border rounded p-2 w-64 text-center">
    <button wire:click="generarTurno"
        class="bg-blue-500 text-white px-4 py-2 rounded">
        Generar Turno
    </button>
    
    @if($numeroTurno)
        <div class="mt-4 p-4 bg-green-200 text-green-700 rounded">
            <p>Su número de turno es:</p>
            <h2 class="text-3xl font-bold">{{ $numeroTurno }}</h2>
        </div>
    @endif

    @if (session()->has('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

</div>
