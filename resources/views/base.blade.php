<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/home_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">North Barber</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="">Servicios</a></li>
                <li><a href="">Productos</a></li>
                <li><a href="">Citas</a></li>
                <li><a href="">Contacto</a></li>
                <!-- Verificamos si el usuario está autenticado -->
                @if(Auth::check())
                    <li><a href="">Perfil</a></li>
                    <!-- Formulario para cerrar sesión -->
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Contenido Dinámico -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 North Barber.</p>
        </div>
    </footer>
</body>
</html>
