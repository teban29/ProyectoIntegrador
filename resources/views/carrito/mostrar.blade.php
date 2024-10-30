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
                                @if(!empty($producto['imagen']))
                                <img src="{{ Storage::url('productos/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" class="cart-image">
                                @else
                                No disponible
                                @endif
                            </td>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>${{ $producto['precio'] }}</td>
                            <td>{{ $producto['cantidad'] }}</td>
                            <td>${{ $producto['precio'] * $producto['cantidad'] }}</td>
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
