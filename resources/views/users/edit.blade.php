@extends('layouts.app')

@section('content')
    <h1>Editar Usuario</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $user->nombre }}" required>
        </div>
        <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="{{ $user->apellidos }}" required>
        </div>
        <div>
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" value="{{ $user->documento }}" required>
        </div>
        <div>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <div>
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="medico" {{ $user->rol == 'medico' ? 'selected' : '' }}>Médico</option>
                <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button type="submit">Actualizar</button>
    </form>
@endsectionH