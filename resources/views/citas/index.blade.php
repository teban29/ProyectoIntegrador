@extends('layouts.admin')

@section('title', 'Citas')

@section('admin-content')
<h1>Citas</h1>
<a href="{{ route('citas.create') }}">Crear Cita</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
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
                <td>{{ $cita->servicio->nombre }}</td>
                <td>{{ $cita->cliente->nombre }}</td>
                <td>{{ $cita->barbero->nombre }}</td>
                <td>
                    <a href="{{ route('citas.show', $cita->id) }}">Ver</a>
                    <a href="{{ route('citas.edit', $cita->id) }}">Editar</a>
                    <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection