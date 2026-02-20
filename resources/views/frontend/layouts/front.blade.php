<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dirección de Género')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body{
            background: #f4f7fb;
            min-height:100vh;
        }

        .navbar-custom{
            background: linear-gradient(135deg,#6a1b9a,#8e24aa);
        }

        .navbar-custom .nav-link{
            color:rgba(255,255,255,.85);
            transition:.2s;
        }

        .navbar-custom .nav-link:hover{
            color:#fff;
            transform:translateY(-1px);
        }

        .card-soft{
            border:none;
            border-radius:14px;
            box-shadow:0 6px 18px rgba(0,0,0,.08);
        }

        footer{
            background:#6a1b9a;
            color:white;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            Dirección de Género
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navGenero">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navGenero">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Masculinidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">IVE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Género y Diversidad</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manuales') }}">
                            <i class="bi bi-journal-text"></i> Manuales
                        </a>
                    </li>

                    @if(auth()->user()->esAdmin())
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="{{ route('admin.panel') }}">
                                <i class="bi bi-shield-lock"></i> Panel Administrador
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            @auth
                <div class="d-flex align-items-center gap-3">
                    <span class="text-white small">
                        <i class="bi bi-person-circle"></i>
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Salir
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-in-right"></i> Ingresar
                </a>
            @endauth
        </div>
    </div>
</nav>

<main class="container flex-grow-1 py-4">
    @yield('content')
</main>

<footer class="mt-auto py-3">
    <div class="container text-center small">
        Sistema institucional — Secretaría de Desarrollo Humano
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
