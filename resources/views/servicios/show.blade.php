@extends('layouts.admin')

@section('title', 'Detalles del Servicio')

@section('admin-content')
<head>
    <link rel="stylesheet" href="{{ asset('css/crud_styles.css') }}">
</head>
    <h1>{{ $servicio->nombre }}</h1>
    <p>Precio: {{ $servicio->precio }}</p>
    <p>Duración: {{ $servicio->duracion }}</p>
    <a href="{{ route('servicios.index') }}">Volver a la lista de servicios</a>
@endsection
