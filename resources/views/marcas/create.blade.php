@extends('layouts.admin')

@section('title', 'Crear Marca')

@section('admin-content')
    <h1>Crear Marca</h1>

    <form action="{{ route('marcas.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <button type="submit">Crear</button>
    </form>        
@endsection