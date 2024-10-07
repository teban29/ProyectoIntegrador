
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/auth_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="title-container">
            <h2>Iniciar Sesión</h2>
        </div>
        <div class="form-image-wrapper">
            <div class="form-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-item">
                        <label for="email">Email:</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-item">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="button-container">
                        <button type="submit">Iniciar Sesión</button>
                    </div>
                    <div class="messages-container">
                        <div class="text-center mt-3">
                            <p>¿No tienes cuenta? <a href="{{ route('register') }}">Registrarse</a></p>
                        </div>     
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <p class="alerta-error">{{ $error }}</p>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
