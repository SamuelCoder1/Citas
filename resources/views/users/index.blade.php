@extends('layouts.app')

@section('content')
    <h1>Lista de Usuarios</h1>
    <a href="{{ route('users.create') }}">Crear Nuevo Usuario</a>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->nombre }} {{ $user->apellidos }} - <a href="{{ route('users.show', $user->id) }}">Ver</a> - <a href="{{ route('users.edit', $user->id) }}">Editar</a></li>
        @endforeach
    </ul>
@endsection