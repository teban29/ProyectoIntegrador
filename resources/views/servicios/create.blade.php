@extends('layouts.admin')

@section('title', 'Crear Servicio')

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
    <h1 class="crud-header">Crear Servicio</h1>

    <form action="{{ route('servicios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="duracion">Duración (en minutos):</label>
            <input type="number" name="duracion" id="duracion" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Servicio</button>
    </form>

</div>
@endsection
