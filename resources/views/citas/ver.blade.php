@extends('base')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/citas_styles.css') }}">
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
                    @if (Auth::user()->rol_id == 3) <!-- Cliente -->
                        <th>Barbero</th>
                    @elseif (Auth::user()->rol_id == 2) <!-- Barbero -->
                        <th>Cliente</th>
                    @endif
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td>{{ optional($cita->servicio)->nombre ?? 'Servicio eliminado' }}</td>
                        @if (Auth::user()->rol_id == 3) <!-- Cliente -->
                            <td>{{ optional($cita->barbero)->nombre ?? 'Barbero no disponible' }} {{ optional($cita->barbero)->apellido }}</td>
                        @elseif (Auth::user()->rol_id == 2) <!-- Barbero -->
                            <td>{{ optional($cita->cliente)->nombre ?? 'Cliente no disponible' }} {{ optional($cita->cliente)->apellido }}</td>
                        @endif
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>
                            @if (Auth::user()->rol_id == 3) <!-- Solo los clientes pueden cancelar las citas -->
                                <form action="{{ route('citas.cancelar', $cita->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta cita?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Cancelar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
