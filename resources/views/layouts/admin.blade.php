@extends('base') <!-- Extiende desde el archivo navbar llamado base.blade.php -->

@section('content')
<header>
    <link rel="stylesheet" href="{{ asset('css/base_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</header>
<div class="admin-container">
    <!-- Sidebar -->
    @include('partials.sidebar') <!-- Incluye el sidebar solo en las páginas de gestión -->

    <!-- Contenido Principal -->
    <div class="main-content">
        @yield('admin-content') <!-- Aquí se cargará el contenido específico de cada página de gestión -->
    </div>
</div>
@endsection
