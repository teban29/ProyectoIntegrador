@extends('layouts.admin') <!-- Usa la plantilla de administración con navbar y sidebar -->

@section('title', 'Dashboard de Gestión')

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

<div class="dashboard-container">
    <h2>Dashboard de Gestión</h2>

    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total de Productos</h3>
            <p>{{ $totalProductos }}</p>
        </div>
        <div class="stat-card">
            <h3>Citas Agendadas</h3>
            <p>{{ $citasAgendadas }}</p>
        </div>
        <div class="stat-card">
            <h3>Citas Completadas</h3>
            <p>{{ $citasCompletadas }}</p>
        </div>
        <div class="stat-card">
            <h3>Clientes Registrados</h3>
            <p>{{ $totalClientes }}</p>
        </div>
    </div>

    <div class="dashboard-charts">
        <div class="chart-container">
            <h4>Citas por Estado</h4>
            <canvas id="citasEstadoChart"></canvas>
        </div>
        <div class="chart-container">
            <h4>Productos por Categoría</h4>
            <canvas id="productosCategoriaChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Citas por Estado Chart
        var citasEstadoCtx = document.getElementById('citasEstadoChart').getContext('2d');
        var citasEstadoChart = new Chart(citasEstadoCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($citasEstadosLabels) !!},
                datasets: [{
                    data: {!! json_encode($citasEstadosData) !!},
                    backgroundColor: ['#4CAF50', '#FF9800', '#F44336', '#2196F3']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Productos por Categoría Chart
        var productosCategoriaCtx = document.getElementById('productosCategoriaChart').getContext('2d');
        var productosCategoriaChart = new Chart(productosCategoriaCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($productosCategoriasLabels) !!},
                datasets: [{
                    label: 'Productos',
                    data: {!! json_encode($productosCategoriasData) !!},
                    backgroundColor: '#2196F3'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection
