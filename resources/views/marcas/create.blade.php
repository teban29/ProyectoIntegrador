@extends('layouts.admin')

@section('title', 'Crear Marca')

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
    <h1>Crear Marca</h1>

    <form action="{{ route('marcas.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <button type="submit">Crear</button>
    </form>        
@endsection