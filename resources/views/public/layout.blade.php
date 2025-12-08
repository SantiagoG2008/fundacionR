<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fundación Rescata Amor')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    image.png <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                <li><a href="{{ route('galeria') }}">Galería</a></li>
                <li><a href="{{ route('donar') }}">Donaciones</a></li>
                <li><a href="{{ route('contacto') }}">Contacto</a></li>
                <li><a href="{{ url('/adopta?seccion=mis-solicitudes#mis-solicitudes') }}">Mis solicitudes</a></li>
                @php
                    $panelActivo = \App\Models\PanelConfig::isPanelActive();
                    $isAuthenticated = \Illuminate\Support\Facades\Auth::check();
                @endphp
                @if($panelActivo)
                <li>
                    <a href="{{ $isAuthenticated ? route('admin.dashboard') : route('login') }}">
                        Panel administrador
                    </a>
                </li>
                @endif
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

        // Atajo de teclado para activar/desactivar panel: Ctrl+Shift+P
        let keysPressed = {};
        document.addEventListener('keydown', function(e) {
            keysPressed[e.key] = true;
            
            if (keysPressed['Control'] && keysPressed['Shift'] && e.key === 'P') {
                e.preventDefault();
                togglePanel();
            }
        });

        document.addEventListener('keyup', function(e) {
            delete keysPressed[e.key];
        });

        function togglePanel() {
            fetch('{{ route("panel.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ key: 'ctrl_shift_p' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    @stack('scripts')
</body>
</html>

