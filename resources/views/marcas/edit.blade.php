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
    <h1>Editar Marca</h1>

    <form action="{{ route('marcas.update', $marca) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $marca->nombre }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection