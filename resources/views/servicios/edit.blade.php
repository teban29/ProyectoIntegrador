@extends('layouts.admin')

@section('title', 'Editar Servicio')

@section('admin-content')
    <h1>Editar Servicio</h1>

    <form action="{{ route('servicios.update', $servicio) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $servicio->nombre }}" required>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" value="{{ $servicio->precio }}" required>

        <label for="duracion">Duración:</label>
        <input type="text" name="duracion" value="{{ $servicio->duracion }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection
