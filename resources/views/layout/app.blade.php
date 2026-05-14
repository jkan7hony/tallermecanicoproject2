<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Taller Mecánico')</title>
    @fonts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --mechanic-bg: #16181d;
            --mechanic-panel: #1f232a;
            --mechanic-panel-2: #272c34;
            --mechanic-border: #3a404a;
            --mechanic-text: #eef1f5;
            --mechanic-muted: #a8b0bb;
            --mechanic-accent: #c21f2f;
            --mechanic-accent-hover: #e33648;
        }

        html, body { min-height: 100%; }

        body.mechanic-body {
            color: var(--mechanic-text);
            background:
                radial-gradient(circle at top, rgba(194, 31, 47, 0.18), transparent 30%),
                linear-gradient(180deg, #111319 0%, #171b21 40%, #0e1014 100%);
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
        }

        .mechanic-navbar {
            background: linear-gradient(90deg, #20242b 0%, #171a20 60%, #101318 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* --- ESTILOS NAVBAR DROPDOWN HORIZONTAL --- */
        @media (min-width: 992px) {
            .dropdown-menu-horizontal {
                display: none;
                flex-direction: row !important;
                padding: 0.5rem !important;
                gap: 5px;
                background: rgba(31, 35, 42, 0.98) !important;
                border: 1px solid var(--mechanic-border) !important;
                box-shadow: 0 10px 25px rgba(0,0,0,0.5);
                /* Centrar bajo el elemento */
                position: absolute;
                left: 50% !important;
                transform: translateX(-50%) !important;
            }

            .dropdown-menu-horizontal.show {
                display: flex !important;
            }

            .dropdown-menu-horizontal li {
                border-right: 1px solid rgba(255,255,255,0.1);
            }

            .dropdown-menu-horizontal li:last-child {
                border-right: none;
            }

            .dropdown-menu-horizontal .dropdown-item {
                white-space: nowrap;
                padding: 0.5rem 1.2rem !important;
                color: var(--mechanic-text);
                display: flex;
                align-items: center;
                gap: 8px;
                border-radius: 4px;
            }

            .dropdown-menu-horizontal .dropdown-item:hover {
                background: var(--mechanic-accent) !important;
                color: white !important;
            }
        }

        /* Reutilización de estilos de tu código anterior */
        .mechanic-main::before {
            content: ''; position: fixed; inset: 0; pointer-events: none;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 36px 36px; mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.5), transparent 85%);
            opacity: 0.35;
        }

        .card,
        .card-header,
        .card-body,
        .table-container,
        .table-responsive {
            background: rgba(31, 35, 42, 0.95);
            color: var(--mechanic-text);
        }

        .table thead th,
        .table tbody td {
            color: var(--mechanic-text) !important;
            background-color: transparent !important;
        }

        .table thead th {
            background: var(--mechanic-panel-2) !important;
        }

        .badge-mechanic {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: rgba(194, 31, 47, 0.18);
            color: #ffd7db;
            border: 1px solid rgba(194, 31, 47, 0.35);
            font-size: 0.85rem;
        }

        .btn-edit-custom,
        .btn-delete-custom {
            border-radius: 999px;
            padding: 0.55rem 1rem;
            font-weight: 600;
        }

        .btn-edit-custom {
            --bs-btn-color: #dff6ff;
            --bs-btn-bg: rgba(13, 110, 253, 0.18);
            --bs-btn-border-color: rgba(13, 110, 253, 0.35);
            --bs-btn-hover-bg: rgba(13, 110, 253, 0.32);
            --bs-btn-hover-border-color: rgba(13, 110, 253, 0.5);
        }

        .btn-delete-custom {
            --bs-btn-color: #ffe2e5;
            --bs-btn-bg: rgba(220, 53, 69, 0.16);
            --bs-btn-border-color: rgba(220, 53, 69, 0.35);
            --bs-btn-hover-bg: rgba(220, 53, 69, 0.3);
            --bs-btn-hover-border-color: rgba(220, 53, 69, 0.5);
        }

        .entity-page {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
        }

        .entity-shell {
            width: 100%;
        }

        .entity-card {
            border: 0;
            border-radius: 1.25rem;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.28) !important;
            background: rgba(31, 35, 42, 0.96);
            color: var(--mechanic-text);
        }

        .entity-card .card-header {
            background: rgba(39, 44, 52, 0.92);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .entity-index-card .card-header,
        .entity-index-card .card-body {
            background: transparent;
        }

        .entity-index-card .table-responsive {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .entity-title {
            color: #ffffff;
            font-weight: 700;
        }

        .entity-subtitle,
        .entity-muted {
            color: var(--mechanic-muted) !important;
        }

        .entity-form .input-group-text {
            width: 45px;
            justify-content: center;
            border-right: none;
            background: transparent;
            color: var(--mechanic-muted);
            border-color: var(--mechanic-border);
        }

        .entity-form .form-control,
        .entity-form .form-select {
            border-left: none;
            background-color: var(--mechanic-panel-2);
            color: var(--mechanic-text);
        }

        .entity-form .form-control:focus,
        .entity-form .form-select:focus {
            background-color: var(--mechanic-panel-2);
            color: var(--mechanic-text);
            border-color: var(--mechanic-accent);
            box-shadow: 0 0 0 0.25rem rgba(194, 31, 47, 0.2);
        }

        .entity-form .form-control.is-invalid,
        .entity-form .form-select.is-invalid {
            border-color: #dc3545 !important;
        }

        .entity-form .form-control::placeholder {
            color: var(--mechanic-muted);
        }

        .entity-actions {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 1.25rem;
            margin-top: 1rem;
        }

        .nav-link { transition: color 0.3s ease; }
        .nav-link:hover { color: var(--mechanic-accent) !important; }
        .nav-link.active { color: white !important; font-weight: bold; border-bottom: 2px solid var(--mechanic-accent); }
    </style>
    @stack('styles')
</head>

<body class="mechanic-body">
    <nav class="navbar navbar-expand-lg navbar-dark mechanic-navbar shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-gear-fill text-danger me-2"></i>TALLER MECÁNICO
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Clientes
                        </a>
                        <ul class="dropdown-menu dropdown-menu-horizontal">
                            <li><a class="dropdown-item" href="{{ route('clientes.index') }}"><i class="bi bi-person-lines-fill"></i> Listar</a></li>
                            <li><a class="dropdown-item" href="{{ route('clientes.create') }}"><i class="bi bi-person-plus-fill"></i> Crear</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Vehículos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-horizontal">
                            <li><a class="dropdown-item" href="{{ route('vehiculos.index') }}"><i class="bi bi-car-front"></i> Listar</a></li>
                            <li><a class="dropdown-item" href="{{ route('vehiculos.create') }}"><i class="bi bi-plus-square"></i> Crear</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Órdenes
                        </a>
                        <ul class="dropdown-menu dropdown-menu-horizontal">
                            <li><a class="dropdown-item" href="{{ route('orden-trabajos.index') }}"><i class="bi bi-clipboard-check"></i> Listar</a></li>
                            <li><a class="dropdown-item" href="{{ route('orden-trabajos.create') }}"><i class="bi bi-plus-square"></i> Crear</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Repuestos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-horizontal">
                            <li><a class="dropdown-item" href="{{ route('repuestos.index') }}"><i class="bi bi-tools"></i> Listar</a></li>
                            <li><a class="dropdown-item" href="{{ route('repuestos.create') }}"><i class="bi bi-plus-square"></i> Crear</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Servicios
                        </a>
                        <ul class="dropdown-menu dropdown-menu-horizontal">
                            <li><a class="dropdown-item" href="{{ route('detalle-servicios.index') }}"><i class="bi bi-list-check"></i> Listar</a></li>
                            <li><a class="dropdown-item" href="{{ route('detalle-servicios.create') }}"><i class="bi bi-plus-square"></i> Crear</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main class="mechanic-main py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>