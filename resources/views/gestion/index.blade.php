@extends('layouts.admin') <!-- Usa la plantilla de administración con navbar y sidebar -->

@section('title', 'Gestión de Clientes')

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
<header>
    <link rel="stylesheet" href="{{ asset('css/crud_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</header>
<button id="toggleSidebar" class="btn-primary">Mostrar/Ocultar Sidebar</button>
    <h1>Gestión de Clientes</h1>


    <script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        // Alterna la clase en el sidebar y el contenido
        document.querySelector('.sidebar').classList.toggle('sidebar-visible');
        document.querySelector('.content').classList.toggle('sidebar-visible');
    });
</script>
    <!-- Contenido específico de la gestión de clientes, como el listado y los botones de CRUD -->
@endsection
