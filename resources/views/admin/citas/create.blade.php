@extends('layouts.admin')

@section('title', 'Crear Cita')

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
<div class="crud-container">
    <h1 class="crud-header">Crear Cita</h1>

    <!-- Formulario para filtrar barberos -->
    <form action="{{ route('admin.citas.filtrar') }}" method="POST" class="crud-form">
        @csrf
        <label for="cliente_id">Cliente:</label>
        <select id="cliente_id" name="cliente_id" required>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>

        <label for="servicio_id">Servicio:</label>
        <select id="servicio_id" name="servicio_id" required>
            @foreach ($servicios as $servicio)
                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
            @endforeach
        </select>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" min="{{ date('Y-m-d') }}" required>

        <label for="hora">Hora:</label>
        <select id="hora" name="hora" required>
            @foreach ($horas as $horaDisponible)
                <option value="{{ $horaDisponible }}">{{ $horaDisponible }}</option>
            @endforeach
        </select>

        <button type="submit" class="crud-button">Filtrar Barberos</button>
    </form>

    <!-- Mostrar barberos disponibles solo si existen -->
    @if (isset($barberosDisponibles) && count($barberosDisponibles) > 0)
    <form action="{{ route('admin.citas.store') }}" method="POST" class="crud-form">
        @csrf
        <input type="hidden" name="cliente_id" value="{{ $cliente_id }}">
        <input type="hidden" name="fecha" value="{{ $fecha }}">
        <input type="hidden" name="hora" value="{{ $horaSeleccionada }}">
        <input type="hidden" name="servicio_id" value="{{ $servicio_id }}">

        <label for="barbero_id">Barbero:</label>
        <select id="barbero_id" name="barbero_id" required>
            @foreach ($barberosDisponibles as $barbero)
                <option value="{{ $barbero->id }}">{{ $barbero->nombre }}</option>
            @endforeach
        </select>

        <button type="submit" class="crud-button">Crear</button>
    </form>
    @elseif (isset($barberosDisponibles))
        <p>No hay barberos disponibles para la fecha y hora seleccionadas.</p>
    @endif
</div>
@endsection
