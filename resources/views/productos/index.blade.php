@extends('layouts.admin')

@section('title', 'Productos')

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
    <h1 class="crud-header">Lista de Productos</h1>
    <a href="{{ route('productos.create') }}" class="crud-button">Crear Producto</a>

    <table class="crud-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>
                        @if($producto->imagen_url)
                            <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" style="width: 50px; height: auto;">
                        @else
                            No disponible
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="crud-link">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
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