<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Fundación de Mascotas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="admin-sidebar">
            <div class="sidebar-header">Fundación</div>
            <nav>
                <a href="{{ route('mascotas.index') }}" class="nav-link">🐾 Mascotas</a>
                <a href="{{ route('adoptantes.index') }}" class="nav-link">👤 Adoptantes</a>
                <a href="{{ route('adopciones.index') }}" class="nav-link">📄 Adopciones</a>
                <a href="{{ route('historia_clinicas.index') }}" class="nav-link">🩺 Historias Clínicas</a>
                <a href="{{ route('galeria.index') }}" class="nav-link">🖼️ Galería</a>
                <a href="{{ route('donaciones.index') }}" class="nav-link">🤝 Donaciones</a>
                <a href="{{ route('contactos.index') }}" class="nav-link">📧 Mensajes</a>
                <a href="{{ route('informes.index') }}" class="nav-link">📊 Informes</a>
            </nav>
        </aside>

        <div class="sidebar-backdrop" id="sidebar-backdrop" aria-hidden="true"></div>

        <!-- Main Content -->
        <main class="content">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-content">
                    <div class="header-left">
                        <button class="sidebar-toggle" aria-controls="admin-sidebar" aria-expanded="false">
                            <span></span>
                        </button>
                        <h1>Panel Administrativo - Fundación Rescata Amor</h1>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Ver sitio público</a>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </header>
           
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            // Inicializar DataTables solo en tablas con datos y estructura correcta
            $('table').each(function() {
                var $table = $(this);
                var $tbody = $table.find('tbody');
                var rowCount = $tbody.find('tr').length;
                var hasThead = $table.find('thead').length > 0;
                var hasTbody = $tbody.length > 0;
                
                // Verificar que la tabla tenga la estructura mínima requerida
                if (hasThead && hasTbody && rowCount > 0) {
                    // Verificar que todas las filas tengan el mismo número de columnas
                    var expectedCols = $table.find('thead th').length;
                    var isValidStructure = true;
                    
                    $tbody.find('tr').each(function() {
                        if ($(this).find('td').length !== expectedCols) {
                            isValidStructure = false;
                            return false;
                        }
                    });
                    
                    if (isValidStructure) {
                        try {
                            $table.DataTable({
                                scrollX: true,
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                                }
                            });
                        } catch (e) {
                            console.log('DataTables no se pudo inicializar:', e.message);
                        }
                    }
                }
            });

            const toggleButton = document.querySelector('.sidebar-toggle');
            const sidebar = document.querySelector('#admin-sidebar');
            const backdrop = document.querySelector('#sidebar-backdrop');

            function closeSidebar() {
                document.body.classList.remove('sidebar-open');
                toggleButton?.setAttribute('aria-expanded', 'false');
            }

            function toggleSidebar() {
                const isOpen = document.body.classList.toggle('sidebar-open');
                toggleButton?.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            }

            toggleButton?.addEventListener('click', toggleSidebar);
            backdrop?.addEventListener('click', closeSidebar);
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>
</html>
