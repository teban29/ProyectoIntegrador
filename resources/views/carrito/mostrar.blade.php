<!-- resources/views/carrito/mostrar.blade.php -->
@extends('base')

@section('title', 'Carrito de compras')

@section('content')

<header>
    <link rel="stylesheet" href="{{ asset('css/products_styles.css') }}">
</header>
<div class="cart-container">
    <h1>Carrito de compras</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($carrito) > 0)
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $producto)
                    <tr>
                        <td>
                        @if(!empty($producto['imagen_url']) && file_exists(public_path('storage/' . $producto['imagen_url'])))
                            <img src="{{ asset('storage/' . $producto['imagen_url']) }}" alt="{{ $producto['nombre'] }}" style="width: 100px; height: auto;">
                        @else
                            <span>Imagen no disponible</span>
                        @endif
                        </td>
                        <td>{{ $producto['nombre'] }}</td>
                        <td>${{ number_format($producto['precio'], 2) }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</td>
                        <td>
                            <div class="acciones-container">
                                <!-- Botón para sumar cantidad -->
                                <form action="{{ route('carrito.sumar', $id) }}" method="POST" class="accion-form">
                                    @csrf
                                    <button type="submit" class="btn-sumar">+</button>
                                </form>

                                <!-- Botón para eliminar producto -->
                                <form action="{{ route('carrito.eliminar', $id) }}" method="POST" class="accion-form">
                                    @csrf
                                    <button type="submit" class="btn-eliminar">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Botón para vaciar el carrito -->
        <form action="{{ route('carrito.vaciar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">Vaciar Carrito</button>
        </form>
    @else
        <p>Tu carrito está vacío.</p>
    @endif
</div>
@endsection
