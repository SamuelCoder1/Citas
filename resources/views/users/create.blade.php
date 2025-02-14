@extends('layouts.app')

@section('content')
    <h1>Crear Usuario</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
        </div>
        <div>
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" required>
        </div>
        <div>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <div>
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="medico">Médico</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit">Crear</button>
    </form>
@endsection