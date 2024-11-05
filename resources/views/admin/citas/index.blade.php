@extends('layouts.admin')

@section('title', 'Citas')

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
    <h1 class="crud-header">Citas</h1>
    <a href="{{ route('admin.citas.create') }}" class="crud-button">Crear Cita</a>

    @if(session('success'))
        <div class="crud-success-message">{{ session('success') }}</div>
    @endif

    <table class="crud-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Cliente</th>
                <th>Barbero</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($citas as $cita)
            <tr>
                <td>{{ $cita->fecha }}</td>
                <td>{{ $cita->hora }}</td>
                <td>{{ $cita->servicio->nombre ?? 'Servicio no disponible' }}</td>
                <td>{{ $cita->cliente->nombre ?? 'Cliente no disponible' }}</td>
                <td>{{ $cita->barbero->nombre ?? 'Barbero no disponible' }}</td>
                <td>
                    <a href="{{ route('admin.citas.edit', $cita->id) }}" class="crud-link">Editar</a>
                    <form action="{{ route('admin.citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="crud-button crud-delete-button">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>

@endsection
