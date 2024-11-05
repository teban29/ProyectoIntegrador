@extends('base')

@section('title', 'Inicio')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/home_styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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

        <!-- Slider Section -->
        <div class="slider-section">
            <div class="slider">
                <div class="slide">
                    <img src="{{ asset('img/servicios_slider.png') }}" alt="Servicios">
                    <h3 class="slider-title">Servicios</h3>
                    <p class="slider-text">Cortes clásicos, modernos, afeitados, y más.</p>
                </div>
                <div class="slide">
                    <img src="{{ asset('img/barberos_slider.png') }}" alt="Barberos">
                    <h3 class="slider-title">Barberos Expertos</h3>
                    <p class="slider-text">Nuestros profesionales están listos para darte el mejor look.</p>
                </div>
                <div class="slide">
                    <img src="{{ asset('img/tienda_online.png') }}" alt="Tienda">
                    <h3 class="slider-title">Tienda Online</h3>
                    <p class="slider-text">Productos exclusivos para el cuidado personal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('.slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false
        });
    });
</script>
@endsection
