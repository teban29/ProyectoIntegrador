@extends('layouts.admin') 

@section('title', 'Usuarios')

@section('admin-content')

<div class="content">
        <h1>Detalles del Usuario</h1>
        <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
        <p><strong>Apellido:</strong> {{ $usuario->apellido }}</p>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>
        <p><strong>Teléfono:</strong> {{ $usuario->telefono }}</p>
        <p><strong>Rol:</strong> {{ $usuario->rol_id }}</p>

        <a href="{{ route('usuarios.index') }}">Regresar a la lista de usuarios</a>
    </div>
@endsection