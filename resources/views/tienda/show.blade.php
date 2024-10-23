<!-- resources/views/tienda/show.blade.php -->
@extends('base')

@section('title', $producto->nombre) <!-- Título de la página con el nombre del producto -->

@section('content')
<header>
    <link rel="stylesheet" href="{{ asset('css/products_styles.css') }}">
</header>
    <div class="product-detail-container">
        <!-- Imagen del producto -->
        <div class="product-image-container">
            <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-image">
        </div>

        <!-- Información del producto -->
        <div class="product-info-container">
            <h1 class="product-name">{{ $producto->nombre }}</h1> <!-- Nombre del producto -->
            <p class="product-description">{{ $producto->descripcion }}</p> <!-- Descripción del producto -->

            <p class="product-price">Precio: ${{ $producto->precio }}</p> <!-- Precio del producto -->

            <p class="product-stock">Stock disponible: {{ $producto->stock }}</p> <!-- Stock disponible -->

            <!-- Botón para agregar al carrito -->
            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                @csrf
                <button type="submit" class="add-to-cart-button">Agregar al carrito</button>
            </form>
        </div>
    </div>
@endsection
