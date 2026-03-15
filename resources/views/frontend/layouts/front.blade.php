<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dirección de Género')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="icon" href="{{ asset('assets/img/logo_genero.png') }}" type="image/png">
    
    <style>
        body {
            background: #f4f7fb;
            min-height: 100vh;
        }

        /* --- NAVBAR Y HEADER --- */
        .navbar-custom {
            /* Tonalidad un poco más oscura que el anterior */
            background: linear-gradient(135deg, #6a63c7 0%, #544ea1 100%);
            padding: 0.4rem 0; /* Padding reducido para compensar logo más grande */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .logo-animado {
            transition: transform 0.3s ease;
            filter: drop-shadow(0 3px 6px rgba(0,0,0,0.2));
        }
        
        .logo-animado:hover {
            transform: scale(1.03);
        }

        /* --- ENLACES DE NAVEGACIÓN --- */
        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 10px 18px !important;   
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 10px;            
            display: flex;
            align-items: center;
            gap: 6px;  
            transition: all 0.2s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-1px);
        }

        /* --- BOTONES DESTACADOS --- */
        .nav-destacado {
            font-size: 1.05rem;
            font-weight: 600;
        }

        .nav-admin {
            background: #682d98 !important; 
            color: #ffffff !important;
            padding-left: 25px !important; /* Más larguito */
            padding-right: 25px !important; /* Más larguito */
            white-space: nowrap; /* Evita los dos renglones */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* --- BUSCADOR POSICIONADO --- */
        .search-container {
            max-width: 380px;
            width: 100%;
        }

        .search-input {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            padding-left: 1.2rem;
        }

        .search-btn {
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            padding-right: 1.2rem;
        }

        /* --- FOOTER --- */
        footer {
            background: #544ea1; 
            color: white;
            padding: 0.5rem 0;
            font-size: 0.95rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-logo {
            max-height: 55px;
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }

        .footer-contact i {
            color: rgba(255, 255, 255, 0.7);
            margin-right: 8px;
        }

        .footer-contact p {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 1.5rem 0;
        }

        .fade-page {
            animation: fadePage 0.6s ease-out forwards;
        }

        @keyframes fadePage {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-genero {
            border: none;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 10px;
        }

        .color-genero { color: #6c63ff !important; }
        .color-masculinidades { color: #0dcaf0 !important; }
        .color-ive { color: #28a745 !important; }

        /*Modal de informacion*/
        .btn-flotante {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 55px;
            height: 55px;
            background-color: #682d98; 
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-flotante:hover {
            transform: scale(1.1) rotate(5deg);
            background-color: #894fb8;
            color: white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        /* --- ESTILO DEL MODAL --- */
        .modal-info-custom .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-info-custom .modal-header {
            background: linear-gradient(135deg, #6a63c7 0%, #544ea1 100%);
            color: white;
            border: none;
        }

        .modal-info-custom .btn-close {
            filter: brightness(0) invert(1); 
        }

    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid px-4">
        
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo_genero.png') }}" alt="Dirección de Género" height="68" class="logo-animado me-2">
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navGenero">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navGenero">
            <ul class="navbar-nav w-100 align-items-lg-center mt-3 mt-lg-0">
                
                {{-- BOTONES IZQUIERDA --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-destacado" href="#" id="dropdownAreas" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-grid mx-1"></i> Áreas
                    </a>
                    <ul class="dropdown-menu dropdown-genero">
                        <li><a class="dropdown-item color-genero" href="{{ route('genero.index') }}"><i class="bi bi-gender-ambiguous"></i> Género</a></li>
                        <li><a class="dropdown-item color-masculinidades" href="{{ route('masculinidades.index') }}"><i class="bi bi-people"></i> Masculinidades</a></li>
                        <li><a class="dropdown-item color-ive" href="{{ route('frontend.areas.ive.index') }}"><i class="bi bi-heart-pulse"></i> IVE</a></li>
                    </ul>
                </li>

                <li class="nav-item mx-lg-1">
                    <a class="nav-link nav-destacado" href="{{ route('frontend.stats.index') }}">
                        <i class="bi bi-bar-chart"></i> Estadísticas
                    </a>
                </li>
                
                @auth
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link nav-destacado" href="{{ route('manuales') }}">
                            <i class="bi bi-journal-text"></i> Manuales
                        </a>
                    </li>

                    @if(auth()->user()->esAdmin())
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link nav-admin" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-shield-lock"></i> Panel Administrador
                            </a>
                        </li>
                    @endif

                    {{-- BUSCADOR A LA DERECHA (ms-auto hace la magia) --}}
                    <li class="nav-item ms-lg-auto mt-3 mt-lg-0 search-container">
                        <form class="d-flex" action="{{ route('buscar') }}" method="GET">
                            <div class="input-group shadow-sm">
                                <input 
                                    type="text" 
                                    name="buscar" 
                                    class="form-control form-control-sm border-0 search-input" 
                                    placeholder="Buscar por DNI, Nombre o Apellido..." 
                                    value="{{ request('buscar') }}"
                                >
                                <button class="btn btn-light text-primary search-btn border-0" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                @endauth

                {{-- LOGIN / LOGOUT AL FINAL --}}
                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-dark btn-sm rounded-pill px-4 shadow-sm">
                                Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-pill px-4 shadow-sm text-primary fw-bold">
                            Ingresar
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container flex-grow-1 py-4 fade-page">
    @yield('content')
</main>

<footer class="mt-auto">
    <div class="container">
        <div class="row align-items-center">
            
            {{-- IZQUIERDA: Logo Municipalidad --}}
            <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/municipalidad_logo.png') }}" alt="Municipalidad" class="footer-logo">
            </div>

            {{-- CENTRO: Texto Institucional --}}
            <div class="col-lg-4 text-center mb-4 mb-lg-0">
                <div class="px-2">
                    <h6 class="fw-bold mb-2">Dirección de Género</h6>
                    <p class="mb-0 text-white-50">
                        &copy; {{ date('Y') }} Sistema Institucional <br>
                        Secretaría de Desarrollo Humano
                    </p>
                </div>
            </div>

            {{-- DERECHA: Contacto --}}
            <div class="col-lg-4 text-center text-lg-end footer-contact">
                <div class="d-inline-block text-start">
                    <p><i class="bi bi-envelope-fill"></i> contacto@municipalidad.gov.ar</p>
                    <p><i class="bi bi-telephone-fill"></i> +54 (0336) 448-XXXX</p>
                    <p><i class="bi bi-geo-alt-fill"></i> Calle Falsa 123, San Nicolás</p>
                </div>
            </div>

        </div>
    </div>
</footer>

<button type="button" class="btn-flotante" data-bs-toggle="modal" data-bs-target="#modalInfoSistema" title="Información del Sistema">
    <i class="bi bi-info-circle-fill"></i>
</button>

<div class="modal fade modal-info-custom" id="modalInfoSistema" tabindex="-1" aria-labelledby="modalInfoSistemaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header py-3">
                <h5 class="modal-title d-flex align-items-center" id="modalInfoSistemaLabel">
                    <i class="bi bi-cpu me-2"></i> Información del Sistema
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/logo_genero.png') }}" alt="Logo" height="60" class="mb-2">
                    <h6 class="fw-bold text-dark">Gestión Dirección de Género</h6>
                    <span class="badge bg-light text-muted border">Versión 2.1.0</span>
                </div>
                
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-check2-circle text-success me-2"></i>Estado del Servidor</span>
                        <span class="text-success fw-bold">Activo</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-database text-primary me-2"></i>Base de Datos</span>
                        <span class="text-muted">Conectada</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-shield-check text-info me-2"></i>Seguridad SSL</span>
                        <span class="text-muted">Encriptado</span>
                    </li>
                </ul>

                <div class="mt-4 p-3 bg-light rounded-3 small text-muted">
                    <p class="mb-1"><strong>Desarrollado por:</strong> Área de Modernización</p>
                    <p class="mb-0"><strong>Soporte:</strong> soporte@municipalidad.gov.ar</p>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true
    });

    @if(session('success')) Toast.fire({ icon: 'success', title: "{{ session('success') }}" }); @endif
    @if(session('error')) Toast.fire({ icon: 'error', title: "{{ session('error') }}" }); @endif
</script>
</body>
</html>