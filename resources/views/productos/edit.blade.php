@extends('layouts.admin')

@section('title', 'Editar Producto')

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
    <h1>Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" required>
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required>{{ $producto->descripcion }}</textarea>
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="{{ $producto->precio }}" required>
    </div>
    <div>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="{{ $producto->stock }}" min="0" required>
    </div>
    <div>
        <label for="marca_id">Marca:</label>
        <select id="marca_id" name="marca_id" required>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}" {{ $marca->id == $producto->marca_id ? 'selected' : '' }}>
                    {{ $marca->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen">
    </div>
    <button type="submit">Actualizar Producto</button>
</form>
@endsection