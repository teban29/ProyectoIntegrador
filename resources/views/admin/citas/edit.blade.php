@extends('layouts.admin')

@section('title', 'Editar Cita')

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
<body>
<div class="crud-container">
    <h1 class="crud-header">Editar Cita</h1>

    <form action="{{ route('admin.citas.edit', $cita->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')
        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="{{ $cita->fecha }}" required>
    
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" value="{{ $cita->hora }}" required>
    
        <label for="servicio_id">Servicio:</label>
        <select id="servicio_id" name="servicio_id" required>
            @foreach ($servicios as $servicio)
                <option value="{{ $servicio->id }}" {{ $servicio->id == $cita->servicio_id ? 'selected' : '' }}>
                    {{ $servicio->nombre }}
                </option>
            @endforeach
        </select>
    
        <label for="cliente_id">Cliente:</label>
        <select id="cliente_id" name="cliente_id" required>
            @foreach ($clientes as $cliente)                
                <option value="{{ $cliente->id }}" {{ $cliente->id == $cita->cliente_id ? 'selected' : '' }}>
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </select>
    
        <label for="barbero_id">Barbero:</label>
        <select id="barbero_id" name="barbero_id" required>
            @foreach ($barberos as $barbero)
                <option value="{{ $barbero->id }}" {{ $barbero->id == $cita->barbero_id ? 'selected' : '' }}>
                    {{ $barbero->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="crud-button">Actualizar</button>
    </form>
</div>

    
</body>
@endsection
