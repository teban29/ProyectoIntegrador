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
<div class="crud-container" style="background-color: #2c2c2c; width: 100%; min-height: 100vh;">
    <h1 class="crud-header">Crear Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST" class="crud-form">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <button type="submit" class="crud-button">Crear</button>
    </form>
</div>
@endsection
