@extends('layouts.admin')

@section('title', 'Editar Categoría')

@section('admin-content')
    <h1>Editar Categoría</h1>
    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $categoria->nombre }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection