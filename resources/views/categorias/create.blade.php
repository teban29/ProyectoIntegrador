@extends('layouts.admin')

@section('title', 'Crear Categoría')

@section('admin-content')
    <h1>Crear Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <button type="submit">Crear</button>
    </form>
@endsection