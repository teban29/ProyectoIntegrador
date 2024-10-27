@extends('layouts.admin')

@section('title', 'Crear Cita')

@section('admin-content')
    <h1>Crear Cita</h1>

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
    
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required>
    
        <label for="servicio_id">Servicio:</label>
        <select id="servicio_id" name="servicio_id" required>
            @foreach ($servicios as $servicio)
                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
            @endforeach
        </select>
    
        <label for="cliente_id">Cliente:</label>
        <select id="cliente_id" name="cliente_id" required>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>
    
        <label for="barbero_id">Barbero:</label>
        <select id="barbero_id" name="barbero_id" required>
            @foreach ($barberos as $barbero)
                <option value="{{ $barbero->id }}">{{ $barbero->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Crear</button>
    </form>        
@endsection