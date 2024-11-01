@extends('layouts.admin')

@section('title', 'Detalles de la Categoría')

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
    <h1>{{ $categoria->nombre }}</h1>
    <a href="{{ route('categorias.index') }}">Volver a la lista de categorías</a>
@endsection