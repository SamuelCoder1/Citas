<div class="flex flex-col items-center space-y-4 p-6">
    <h1 class="text-2xl font-bold">Gestión de Turnos</h1>

    <div class="p-6 bg-blue-300 text-black rounded shadow-lg">
        <h2 class="text-4xl font-bold">Atendiendo Turno</h2>
        <p class="text-5xl">{{ $turnoActual->numero_turno ?? '---' }}</p>

        @if($turnoActual && $turnoActual->taquilla)
            <p class="text-xl">Taquilla: <strong>{{ $turnoActual->taquilla->nombre }}</strong></p>
        @endif
    </div>

    <button wire:click="siguienteTurno" class="bg-green-500 text-white px-4 py-2 rounded">
        Llamar Siguiente
    </button>
</div>
