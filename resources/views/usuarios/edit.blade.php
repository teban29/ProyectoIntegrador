@extends('layouts.admin') 

@section('title', 'Editar Usuario')

@section('admin-content')
<div class="container">
    <h1>Editar Usuario</h1>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos de formulario -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required>

        <label for="password">Contraseña (dejar en blanco para no cambiar)</label>
        <input type="password" name="password">

        <label for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation">

        <label for="rol_id">Rol:</label>

        <select name="rol_id" required>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ $rol->id == $usuario->rol_id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
