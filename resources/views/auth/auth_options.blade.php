<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Iniciar Sesión o Registrarse</title>
    <link rel="stylesheet" href="{{ asset('css/auth_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="title-container">
            <h2>Bienvenio a North Barber</h2>
        </div>
        <!-- Cambié la clase a options-container para organizar los botones en columna -->
        <div class="options-container">
            <a href="{{ route('login') }}">
                <button class="auth-button">Iniciar Sesión</button>
            </a>
            <a href="{{ route('register') }}">
                <button class="auth-button">Registrarse</button>
            </a>
        </div>
    </div>
</body>
</html>
