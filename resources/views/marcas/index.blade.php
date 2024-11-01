@extends('layouts.admin')

@section('title', 'Marcas')

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
    <h1>Marcas</h1>
    <a href="{{ route('marcas.create') }}">Crear Marca</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($marcas as $marca)
                <tr>
                    <td>{{ $marca->id }}</td>
                    <td>{{ $marca->nombre }}</td>
                    <td>
                        <a href="{{ route('marcas.edit', $marca) }}">Editar</a>
                        <form action="{{ route('marcas.destroy', $marca) }}" method="POST" style="display:inline;">
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