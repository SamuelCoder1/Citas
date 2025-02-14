<nav class="bg-gray-800 text-white p-4 flex justify-between">
    <a href="{{ route('solicitar-turno') }}">Solicitar Turno</a>
    <a href="{{ route('pantalla-turnos') }}">Pantalla de Turnos</a>

    @auth
        <span>Bienvenido, {{ Auth::user()->name }}</span>

        @if(Auth::user()->rol === 'admin')
            <a href="{{ route('admin.asesores') }}" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded">Administrar Asesores</a>
            <a href="{{ route('admin.taquillas') }}" class="ml-4 bg-green-500 text-white px-4 py-2 rounded">Administrar Taquillas</a>
        @endif

        <form method="POST" action="{{ route('logout') }}" class="ml-4 inline">
            @csrf
            <button type="submit" class="bg-red-500 px-4 py-2 rounded">Cerrar sesión</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="bg-gray-500 px-4 py-2 rounded">Iniciar Sesión</a>
    @endauth
</nav>
