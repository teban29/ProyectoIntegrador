@extends('layouts.admin')

@section('title', 'Crear Servicio')

@section('admin-content')
    <h1>Crear Servicio</h1>

    <form action="{{ route('servicios.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" required>

        <label for="duracion">Duración:</label>
        <input type="text" name="duracion" required>

        <button type="submit">Crear</button>
    </form>
@endsection
