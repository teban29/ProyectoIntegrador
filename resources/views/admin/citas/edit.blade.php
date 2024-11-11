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

    <form action="{{ route('admin.citas.update', $cita->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PATCH')

        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="{{ $cita->fecha }}" required>
    
        <label for="hora">Hora:</label>
        <select id="hora" name="hora">
            <option value="">Seleccionar hora</option>
            @foreach ($horas as $hora)
                <option value="{{ $hora }}" {{ $cita->hora == $hora ? 'selected' : '' }}>
                    {{ $hora }}
                </option>
            @endforeach
        </select>

    
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

        <label for="estado_id">Estado:</label>
        <select id="estado_id" name="estado_id" required>
            @foreach($estados as $estado)
                <option value="{{ $estado->id }}" {{ $estado->id == $cita->estado_id ? 'selected' : '' }}>
                    {{ $estado->nombre }}
                </option>
            @endforeach
        </select>


        <button type="submit" class="crud-button">Actualizar</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
</body>
@endsection
