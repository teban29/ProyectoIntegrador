<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/base_styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">North Barber</a>
            <ul class="navbar-menu">
                <li class="nav-items">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/home.png') }}" alt="Inicio" class="nav-picture">Inicio
                    </a>
                </li>
                <li class="nav-items">
                    <a href="#">
                        <img src="{{ asset('img/services.png') }}" alt="Servicios" class="nav-picture">Servicios
                    </a>
                </li>
                <li class="nav-items">
                    <a href="{{ route('tienda.index') }}">
                        <img src="{{ asset('img/shop.png') }}" alt="Comprar" class="nav-picture">Tienda
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->rol_id == 1)
                    <li class="nav-items">
                        <a href="{{ route('gestion.index') }}">
                            <img src="{{ asset('img/dashboard.png') }}" alt="Dashboard" class="nav-picture">Gestión
                    </li>
                @endif
                <!-- Menú desplegable para "Citas" -->
                <li class="nav-items citas-dropdown">
                    <a href="#">
                        <img src="{{ asset('img/citas.png') }}" alt="Citas" class="nav-picture">Citas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('citas.agendar') }}">Nueva Cita</a></li>
                        <li><a class="dropdown-item" href="{{ route('citas.ver') }}">Ver Citas</a></li>
                    </ul>
                </li>
                <li class="nav-items">
                    <a href="{{ route('carrito.mostrar') }}">
                        <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="nav-picture">Carrito
                    </a>
                </li>

                <!-- Verificamos si el usuario está autenticado -->
                @if(Auth::check())
                    <li class="nav-items">
                        <a href="{{ route('profile.edit') }}">
                            <img 
                                src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('img/profile.png') }}" 
                                alt="Perfil" class="nav-picture profile-picture">Perfil
                        </a>
                    </li>
                    <li class="nav-items">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <img src="{{ asset('img/logout.png') }}" alt="Logout" class="nav-picture">Logout
                        </a>
                    </li>
                @else
                    <li class="nav-items"><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li class="nav-items"><a href="{{ route('register') }}">Registrarse</a></li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Contenido Dinámico -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->

</body>
</html>
