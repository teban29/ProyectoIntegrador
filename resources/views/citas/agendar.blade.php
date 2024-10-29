@extends('base')

@section('title', 'Agendar Cita')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/citas_styles.css') }}">
</head>
<div class="citas-container">
    <h1>Agendar Cita</h1>

    <!-- Formulario para filtrar barberos -->
    <form action="{{ route('citas.filtrar') }}" method="POST" class="citas-form">
    @csrf
    <div class="form-group">
        <label for="servicio_id">Seleccione un Servicio</label>
        <select name="servicio_id" id="servicio_id" class="form-control" required>
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="fecha">Seleccione una Fecha</label>
        <input type="date" name="fecha" id="fecha" min="{{ date('Y-m-d') }}" class="form-control" value="{{ old('fecha', $fecha ?? '') }}" required>
    </div>
    
    <div class="form-group">
        <label for="hora">Seleccione una Hora</label>
        <select name="hora" id="hora" class="form-control" required>
            @foreach($horas as $horaDisponible)
                <option value="{{ $horaDisponible }}">{{ $horaDisponible }}</option>
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Filtrar Barberos</button>
</form>


   <!-- Mostrar barberos disponibles solo si existen -->
@if (isset($barberosDisponibles) && count($barberosDisponibles) > 0)
<form action="{{ route('citas.store') }}" method="POST" class="citas-form">
    @csrf
    <input type="hidden" name="fecha" value="{{ $fecha }}">
    <input type="hidden" name="hora" value="{{ $horaSeleccionada }}">
    <input type="hidden" name="servicio_id" value="{{ $servicio_id }}">

    <div class="form-group">
        <label for="barbero_id">Seleccione un Barbero</label>
        <select name="barbero_id" id="barbero_id" class="form-control" required>
            @foreach ($barberosDisponibles as $barbero)
                <option value="{{ $barbero->id }}">{{ $barbero->nombre }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Agendar Cita</button>
</form>
@else
    <p>No hay barberos disponibles para la fecha y hora seleccionadas.</p>
@endif


</div>
@endsection
