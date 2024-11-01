@extends('layouts.admin')

@section('title', 'Crear Categoría')

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
    <h1>Crear Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <button type="submit">Crear</button>
    </form>
@endsection