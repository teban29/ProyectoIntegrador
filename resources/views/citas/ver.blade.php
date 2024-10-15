@extends('base')

@section('content')
<head><link rel="stylesheet" href="{{ asset('css/citas_styles.css') }}">
</head>
<div class="citas-container">
    <h2>Mis Citas</h2>

    @if ($citas->isEmpty())
        <p>No tienes citas agendadas.</p>
    @else
        <table class="citas-table">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Barbero</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td>{{ optional($cita->servicio)->nombre ?? 'Servicio eliminado' }}</td>
                        <td>{{ optional($cita->barbero)->nombre ?? 'Barbero no disponible' }} {{ optional($cita->barbero)->apellido }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>
                            <form action="{{ route('citas.cancelar', $cita->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta cita?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
