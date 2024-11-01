@extends('layouts.admin') 

@section('title', 'Crear Usuario')

@section('admin-content')

@php
    if (!(auth()->check() && auth()->user()->rol_id == 1)) {
        header('Location: /home');
        exit();
    }
@endphp

<head>
    <link rel="stylesheet" href="{{ asset('css/crud_styles.css') }}">
</head>
<div class="container">
    <h1>Crear Usuario</h1>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    
    <label for="password_confirmation">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" required>

    <label for="rol_id">Rol:</label>
    <select name="rol_id" required>
        @foreach($roles as $rol)
            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
        @endforeach
    </select>

    <button type="submit">Crear Usuario</button>
</form>

</div>
@endsection
