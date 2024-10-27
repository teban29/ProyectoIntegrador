@extends('layouts.admin') <!-- Usa la plantilla de administración con navbar y sidebar -->

@section('title', 'Gestión de Clientes')

@section('admin-content')
<header>
    <link rel="stylesheet" href="{{ asset('css/crud_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</header>
    <h1>Gestión de Clientes</h1>
    <!-- Contenido específico de la gestión de clientes, como el listado y los botones de CRUD -->
@endsection
