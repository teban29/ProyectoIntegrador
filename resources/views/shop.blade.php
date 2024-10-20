@extends('base')

@section('title', 'Tienda')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/product_styles.css') }}">
</head>
    <div class="shop-container">
        <h1 class="shop-title">Nuestros Productos</h1>

        <div class="product-grid">
            @foreach($productos as $producto)
                <div class="product-card">
                    <a href="{{ route('productos.show', $producto->id) }}">
                        <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-image">
                        <div class="product-info">
                            <h3 class="product-name">{{ $producto->nombre }}</h3>
                            <p class="product-price">${{ $producto->precio }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
