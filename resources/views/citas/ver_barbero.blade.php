@extends('base')

@section('title', 'Citas Asignadas')

@section('content')
    <div class="citas-container">
        <h1>Citas Asignadas</h1>
        @if(count($citas) > 0)
            <table class="table-citas">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Servicio</th>
                        <th>Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td>{{ $cita->fecha }}</td>
                            <td>{{ $cita->hora }}</td>
                            <td>{{ $cita->servicio->nombre }}</td>
                            <td>{{ $cita->cliente->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tienes citas asignadas.</p>
        @endif
    </div>
@endsection
