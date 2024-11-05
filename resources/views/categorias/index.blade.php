@extends('layouts.admin')

@section('title', 'Categorías')

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
    <h1 class="crud-header">Categorías</h1>
    <a href="{{ route('categorias.create') }}" class="crud-button">Crear Categoría</a>

    @if(session('success'))
        <div class="crud-success-message">{{ session('success') }}</div>
    @endif

    <table class="crud-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $categoria) }}" class="crud-link">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="crud-button crud-delete-button">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
