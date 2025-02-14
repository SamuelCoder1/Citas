@extends('layouts.app')

@section('content')
    <h1>Detalles del Usuario</h1>
    <p>Nombre: {{ $user->nombre }}</p>
    <p>Apellidos: {{ $user->apellidos }}</p>
    <p>Documento: {{ $user->documento }}</p>
    <p>Rol: {{ $user->rol }}</p>
    <a href="{{ route('users.edit', $user->id) }}">Editar</a>
@endsection