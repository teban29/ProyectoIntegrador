@extends('layouts.admin')

@section('title', 'Editar Servicio')

@section('admin-content')
<head>
    <link rel="stylesheet" href="{{ asset('css/crud_styles.css') }}">
</head>
<div class="crud-container" style="background-color: #2c2c2c; width: 100%; min-height: 100vh;">
    <h1 class="crud-header">Editar Servicio</h1>

    <form action="{{ route('servicios.update', $servicio) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $servicio->nombre }}" required>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" value="{{ $servicio->precio }}" required>

        <label for="duracion">Duración:</label>
        <input type="text" name="duracion" value="{{ $servicio->duracion }}" required>

        <button type="submit" class="crud-button">Actualizar</button>
    </form>
</div>
@endsection
