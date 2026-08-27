<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Tareas')</title>

    <!-- Tipografías con personalidad para títulos y texto de interfaz. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap aporta la base responsive que usan las vistas actuales. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Sistema visual de la aplicación: tinta, coral y lima. -->
    <style>
        :root {
            --ink: #172032;
            --ink-soft: #536071;
            --paper: #f4f6f1;
            --panel: #ffffff;
            --line: #dfe4df;
            --coral: #ff6b5e;
            --coral-dark: #d94c42;
            --lime: #d9f36a;
            --mint: #b9e6dc;
            --mono: 'DM Mono', monospace;
            --body: 'Manrope', sans-serif;
        }

        * { box-sizing: border-box; }

        body {
            color: var(--ink);
            background-color: var(--paper);
            background-image: linear-gradient(var(--line) 1px, transparent 1px), linear-gradient(90deg, var(--line) 1px, transparent 1px);
            background-size: 42px 42px;
            font-family: var(--body);
            letter-spacing: 0;
        }

        .navbar.navbar-dark.bg-primary {
            position: relative;
            background: var(--ink) !important;
            border-bottom: 5px solid var(--coral);
            box-shadow: 0 8px 0 rgba(23, 32, 50, 0.08);
        }

        .navbar-brand {
            color: #fff !important;
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: .02em;
        }

        .navbar-brand i { color: var(--lime); }
        .navbar .nav-link { color: #cbd3dd !important; font-weight: 700; }
        .navbar .nav-link:hover, .navbar .nav-link.active { color: #fff !important; }
        .navbar .nav-link i { color: var(--coral); }

        main.container { max-width: 1180px; padding-top: 2.8rem; padding-bottom: 4rem; }
        .page-form { max-width: 760px; margin-inline: auto; }
        .page-form .card-header { padding: 1.1rem 1.35rem; }
        .page-form .card-header h4 { font-size: 1.05rem; letter-spacing: -.01em; }
        .page-form .card-body { padding: 1.5rem; }
        .page-form .form-text { display: block; margin-top: .45rem; }
        .page-form .form-actions { border-top: 1px solid var(--line); margin-top: 1.5rem; padding-top: 1.25rem; }
        .page-form .tips-card { box-shadow: 4px 4px 0 rgba(23, 32, 50, .06); }
        .page-form .tips-card .card-header { background: #eef2ed !important; }
        h1, h2, h3, h4, h5, h6 { font-weight: 800; letter-spacing: -.03em; }
        h1 { font-size: clamp(2rem, 4vw, 3.5rem); line-height: 1; }
        .text-primary { color: var(--coral-dark) !important; }
        .text-muted { color: var(--ink-soft) !important; }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 4px;
            box-shadow: 8px 8px 0 rgba(23, 32, 50, 0.08);
            overflow: hidden;
        }
        .card-header { border-bottom: 1px solid var(--line); }
        .card-header.bg-primary { background: var(--ink) !important; }
        .card-header.bg-warning { background: var(--lime) !important; }
        .card-header.bg-success { background: var(--mint) !important; color: var(--ink) !important; }
        .card-header.bg-warning, .card-header.bg-success { color: var(--ink) !important; }
        .card.bg-primary { background: var(--ink) !important; }
        .card.bg-success { background: var(--mint) !important; color: var(--ink) !important; }
        .card.bg-warning { background: var(--lime) !important; color: var(--ink) !important; }
        .card.bg-info { background: var(--coral) !important; }
        .card.bg-primary, .card.bg-success, .card.bg-warning, .card.bg-info { border: 0; box-shadow: none; }
        .card-title { font-family: var(--mono); font-size: .7rem; letter-spacing: .08em; text-transform: uppercase; }
        .card-body h2 { font-size: 2.25rem; }
        .btn { border-radius: 3px; font-weight: 800; padding: .7rem 1rem; }
        .btn-primary { background: var(--coral); border-color: var(--coral); color: var(--ink); }
        .btn-primary:hover, .btn-primary:focus { background: var(--coral-dark); border-color: var(--coral-dark); color: #fff; }
        .btn-warning { background: var(--lime); border-color: var(--lime); color: var(--ink); }
        .btn-outline-primary { border-color: var(--coral); color: var(--coral-dark); }
        .btn-outline-primary:hover { background: var(--coral); border-color: var(--coral); color: var(--ink); }
        .btn-outline-warning { border-color: #a2b638; color: #667510; }
        .btn-outline-danger { border-color: #c84c45; color: #b03f39; }
        .table { --bs-table-bg: transparent; color: var(--ink); }
        .table thead th { border-bottom: 2px solid var(--ink); color: var(--ink-soft); font-family: var(--mono); font-size: .68rem; letter-spacing: .08em; text-transform: uppercase; }
        .table > :not(caption) > * > * { border-bottom-color: var(--line); padding: 1rem .75rem; }
        .table-hover > tbody > tr:hover > * { --bs-table-accent-bg: #f0f4ec; color: var(--ink); }
        .badge { border-radius: 2px; font-family: var(--mono); font-size: .65rem; letter-spacing: .04em; padding: .5rem .6rem; text-transform: uppercase; }
        .badge.bg-success { background: var(--mint) !important; color: var(--ink) !important; }
        .badge.bg-warning { background: var(--lime) !important; color: var(--ink) !important; }
        .form-control { border: 1px solid var(--line); border-radius: 3px; color: var(--ink); padding: .8rem .9rem; }
        .form-control:focus { border-color: var(--coral); box-shadow: 0 0 0 3px rgba(255, 107, 94, .18); }
        .form-label { font-weight: 800; }
        .alert { border: 0; border-left: 5px solid var(--coral); border-radius: 2px; margin-top: 1rem; }
        .completed { opacity: .7; }
        .completed .task-title { text-decoration: line-through; text-decoration-thickness: 2px; }
        footer { background: var(--ink) !important; color: #cbd3dd; }
        footer .text-muted { color: #cbd3dd !important; }
        .task-title { font-weight: 800; }
        @media (max-width: 575.98px) {
            main.container { padding-top: 1.8rem; }
            .page-form .card-body { padding: 1.1rem; }
            .d-flex.justify-content-between { gap: 1rem; flex-wrap: wrap; }
            .table { min-width: 700px; }
            .card { box-shadow: 4px 4px 0 rgba(23, 32, 50, .08); }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition: none !important; }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Barra de navegación principal -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-tasks me-2"></i>
                Gestión de Tareas
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('tareas.index') }}">
                            <i class="fas fa-list me-1"></i>
                            Tareas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tareas.create') }}">
                            <i class="fas fa-plus me-1"></i>
                            Nueva Tarea
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal de la aplicación -->
    <main class="container mt-4">
        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Contenido específico de cada vista -->
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="bg-light mt-5 py-3">
        <div class="container text-center">
            <p class="mb-0 text-muted">
                Aplicación de Gestión de Tareas con Laravel
            </p>
        </div>
    </footer>

    <!-- JavaScript de Bootstrap y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript personalizado -->
    <script>
        // Función para confirmar eliminación de tareas
        function confirmarEliminacion(url, nombreTarea) {
            if (confirm(`¿Estás seguro de que quieres eliminar la tarea "${nombreTarea}"?`)) {
                window.location.href = url;
            }
        }
    </script>
    
    @yield('scripts')
</body>
</html>