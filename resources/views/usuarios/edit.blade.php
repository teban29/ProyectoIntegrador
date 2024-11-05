@extends('layouts.admin') 

@section('title', 'Editar Usuario')

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
<div class="crud-container" style="background-color: #2c2c2c; width: 100%; min-height: 100vh;">
    <h1 class="crud-header">Editar Usuario</h1>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')

        <!-- Campos de formulario -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required>

        <label for="password">Contraseña (dejar en blanco para no cambiar):</label>
        <input type="password" name="password">

        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation">

        <label for="rol_id">Rol:</label>
        <select name="rol_id" required>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ $rol->id == $usuario->rol_id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
            @endforeach
        </select>

        <button type="submit" class="crud-button">Actualizar</button>
    </form>
</div>
@endsection