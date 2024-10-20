<!-- resources/views/tienda/show.blade.php -->
@extends('base') <!-- Si estás usando layouts, ajusta el nombre -->

@section('content')
    <h1>{{ $producto->nombre }}</h1> <!-- O ajusta el campo según tu modelo -->
    <p>{{ $producto->descripcion }}</p>
    <p>Precio: {{ $producto->precio }}</p>
@endsection
