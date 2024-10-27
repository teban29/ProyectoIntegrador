@extends('layouts.admin')

@section('title', 'Detalles del Servicio')

@section('admin-content')
    <h1>{{ $servicio->nombre }}</h1>
    <p>Precio: {{ $servicio->precio }}</p>
    <p>Duración: {{ $servicio->duracion }}</p>
    <a href="{{ route('servicios.index') }}">Volver a la lista de servicios</a>
@endsection
