@extends('layouts.admin')

@section('title', 'Editar Marca')

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
    <h1 class="crud-header">Editar Marca</h1>

    <form action="{{ route('marcas.update', $marca) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $marca->nombre }}" required>

        <button type="submit" class="crud-button">Actualizar</button>
    </form>
</div>
@endsection
