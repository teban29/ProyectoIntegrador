@extends('layouts.admin')

@section('title', 'Servicios')

@section('admin-content')
<head>
    <link rel="stylesheet" href="{{ asset('css/crud_styles.css') }}">
</head>
<div class="crud-container" style="background-color: #2c2c2c; width: 100%; min-height: 100vh;">
    <h1 class="crud-header">Servicios</h1>
    <a href="{{ route('servicios.create') }}" class="crud-button">Crear Servicio</a>

    @if(session('success'))
        <div class="crud-success-message">{{ session('success') }}</div>
    @endif

    <table class="crud-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Duración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->nombre }}</td>
                    <td>{{ $servicio->precio }}</td>
                    <td>{{ $servicio->duracion }}</td>
                    <td>
                        <a href="{{ route('servicios.edit', $servicio) }}" class="crud-link">Editar</a>
                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
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
@endsection
