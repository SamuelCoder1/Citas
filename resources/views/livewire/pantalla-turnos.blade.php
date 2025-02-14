<div wire:poll.3000ms>
    <h1 class="text-3xl font-bold">Turnos en Atención</h1>

    <div class="p-6 bg-yellow-300 text-black rounded shadow-lg">
        <h2 class="text-4xl font-bold">Turno Actual</h2>
        <p class="text-5xl">{{ $turnoActual->numero_turno ?? '---' }}</p>

        @if($turnoActual && $turnoActual->asesor && $turnoActual->taquilla)
            <p class="text-xl">Diríjase a: <strong>{{ $turnoActual->taquilla->nombre }}</strong></p>
            <p class="text-xl">Atendido por: <strong>{{ $turnoActual->asesor->name }}</strong></p>
        @endif
    </div>

    <h2 class="text-xl mt-4">Próximos Turnos</h2>
    <ul class="list-disc">
        @foreach($turnosEnEspera as $turno)
            <li class="text-2xl font-semibold">
                Turno {{ $turno->numero_turno }}
                @if($turno->taquilla && $turno->asesor)
                    - Taquilla: {{ $turno->taquilla->nombre }} (Atendido por: {{ $turno->asesor->name }})
                @endif
            </li>
        @endforeach
    </ul>
</div>

<!-- 🔊 Audio para el sonido cuando se llama un nuevo turno -->
<audio id="turno-sound" src="{{ asset('sounds/turno.mp3') }}"></audio>

<script>
    window.addEventListener('play-sound', event => {
        let turno = event.detail.turno;
        console.log("🔊 Sonido para Turno: " + turno);
        document.getElementById('turno-sound').play();
    });
</script>
