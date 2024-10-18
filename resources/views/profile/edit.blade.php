@extends('base')

@section('title', 'Editar Perfil')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/profile_styles.css') }}">
</head>

<div class="profile-edit-container">
    <h1>Editar Perfil</h1>

    <!-- Mostrar mensajes de éxito si los hay -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="profile-image-section">
            @if($user->profile_image_url)
                <img src="{{ asset('storage/' . $user->profile_image_url) }}" alt="Imagen de Perfil" class="profile-image">
            @else
                <img src="https://via.placeholder.com/150" alt="Placeholder Image" class="profile-image">
            @endif

            <!-- Cambiar Imagen de Perfil -->
            <div class="form-group">
                <!-- Botón estilizado para adjuntar archivo -->
                <input type="file" name="profile_image" id="profile_image" hidden>
                <a href="#" class="btn-file" onclick="document.getElementById('profile_image').click();">Cambiar imagen</a>
                
                @error('profile_image')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $user->nombre) }}" readonly>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $user->apellido) }}" readonly>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $user->telefono) }}">
            @error('telefono')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            <small>Deja este campo en blanco si no deseas cambiar la contraseña.</small>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <!-- Botón de envío -->
        <div class="form-group">
            <button type="submit" class="btn">Actualizar Perfil</button>
        </div>
    </form>
</div>
@endsection
