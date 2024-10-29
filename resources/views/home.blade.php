@extends('base')

@section('title', 'Inicio')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/home_styles.css') }}">
</head>
<section>
    <div class="home-container">
        <div class="welcome-section">
            <h1 class="welcome-title">Bienvenido a North Barber</h1>
            <p class="welcome-text">
                Experimenta los mejores cortes de cabello y servicios de barbería con nuestros barberos profesionales. ¡Agenda tu cita hoy mismo!
            </p>
            <a href="{{ route('citas.agendar') }}" class="btn-primary">Agendar Cita</a>
        </div>

        <div class="features-section">
            <div class="feature">
                <img src="{{ asset('img/services.png') }}" alt="Servicios" class="feature-image">
                <h3 class="feature-title">Servicios</h3>
                <p class="feature-text">Cortes clásicos, modernos, afeitados, y más.</p>
            </div>

            <div class="feature">
                <img src="{{ asset('images/barbers.jpg') }}" alt="Barberos" class="feature-image">
                <h3 class="feature-title">Barberos Expertos</h3>
                <p class="feature-text">Nuestros profesionales están listos para darte el mejor look.</p>
            </div>

            <div class="feature">
                <img src="{{ asset('img/shop.png') }}" alt="Tienda" class="feature-image">
                <h3 class="feature-title">Tienda Online</h3>
                <p class="feature-text">Productos exclusivos para el cuidado personal.</p>
            </div>
        </div>
    </div>
</section>
<th></th>
<section>
    <div class=services-section>
        <h2 class="section-title">Servicios</h2>
    </div>
</section>
@endsection
