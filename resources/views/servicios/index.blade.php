@extends('layouts.admin')

@section('title', 'Servicios')

@section('admin-content')
    <h1>Servicios</h1>
    <a href="{{ route('servicios.create') }}">Crear Servicio</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
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
                        <a href="{{ route('servicios.edit', $servicio) }}">Editar</a>
                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
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
