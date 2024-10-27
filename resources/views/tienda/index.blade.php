@extends('base')

@section('title', 'Tienda')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/products_styles.css') }}">
</head>

<!-- Formulario de búsqueda y filtros -->
<form action="{{ route('productos.index') }}" method="GET" class="filter-form">
    <div class="filter-container">
        <!-- Búsqueda por nombre -->
<!-- Búsqueda por nombre -->
<input type="text" name="search" placeholder="Buscar productos..." value="{{ request('search') }}" class="filter-input search-input">

        <!-- Filtro por marca -->
        <select name="marca_id" class="filter-select">
            <option value="">Todas las marcas</option>
            @foreach($marcas as $marca)
                <option value="{{ $marca->id }}" {{ request('marca_id') == $marca->id ? 'selected' : '' }}>
                    {{ $marca->nombre }}
                </option>
            @endforeach
        </select>

        <!-- Filtro por categoría -->
        <select name="categoria_id" class="filter-select">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <!-- Botón de filtrado -->
        <button type="submit" class="filter-button">Filtrar</button>
    </div>
</form>

<!-- Grid de productos -->
<div class="product-grid">
    @foreach($productos as $producto)
        <div class="product-card">
            <a href="{{ route('tienda.show', $producto->id) }}" class="product-link">
                        @if($producto->imagen_url)
                            <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
                        @endif
                    <h3 class="product-name">{{ $producto->nombre }}</h3>
                    <p class="product-price">${{ $producto->precio }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
