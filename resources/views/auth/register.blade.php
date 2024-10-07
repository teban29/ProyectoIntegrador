


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    
    <!-- Enlazar el archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="title-container">
            <h2>Registro</h2>
        </div>
        <div class="form-image-wrapper">
            <div class="form-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-item">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="form-item">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" value="{{ old('apellido') }}" required>
                    </div>
                    <div class="form-item">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}" required>
                    </div>
                    <div class="form-item">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-item">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-item">
                        <label for="password_confirm">Confirmar Contraseña:</label>
                        <input type="password" name="password_confirmation" required>
                    </div>
                    <div class="button-container">
                        <button type="submit">Registrarse</button>
                    </div>
                    <div class="text-center mt-3">
                        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
                    </div>
                    
                    <!-- Mensajes de error o éxito -->
                    <div class="messages-container">
                        @if(session('success'))
                            <p class="alerta-success">{{ session('success') }}</p>
                        @endif

                        @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="alerta-error">{{ $error }}</p>
                        @endforeach
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

