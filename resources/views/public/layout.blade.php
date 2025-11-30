<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fundación Rescata Amor')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Concert+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    @stack('head')
</head>
<body>
    <header class="site-header">
        <div class="brand">
            <span class="brand-kicker">Fundación</span>
            <span class="brand-title">Rescata Amor</span>
            <span class="brand-tagline">El amor cambia vidas</span>
        </div>

        <button class="nav-toggle" aria-expanded="false" aria-controls="public-nav">
            <span></span>
        </button>

        <nav class="site-nav" id="public-nav">
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('adopta') }}">Mascotas</a></li>
                <li><a href="{{ url('/#galeria') }}">Galería</a></li>
                <li><a href="{{ route('donar') }}">Donaciones</a></li>
                <li><a href="{{ route('contacto') }}">Contacto</a></li>
                <li><a href="{{ url('/adopta#mis-solicitudes') }}">Mis solicitudes</a></li>
                <li><a href="{{ url('/adopta#mi-mascota') }}">Mi mascota</a></li>
                <li><a href="{{ route('login') }}">Panel administrador</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Fundación Rescata Amor © {{ now()->year }}</p>
        <p>Contacta a info@rescataamor.org | Bogotá, Colombia</p>
    </footer>

    <script defer src="{{ asset('js/app.js') }}"></script>
    <script>
        const navToggle = document.querySelector('.nav-toggle');
        const siteNav = document.querySelector('#public-nav');

        navToggle?.addEventListener('click', () => {
            const isOpen = siteNav.classList.toggle('is-open');
            navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    </script>
    @stack('scripts')
</body>
</html>

