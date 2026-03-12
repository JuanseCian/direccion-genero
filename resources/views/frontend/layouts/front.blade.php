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
        body{
            background: #f4f7fb;
            min-height:100vh;
        }

        .navbar-custom{
            background: #7973cf;
            min-height: 110px;
            padding-top: 0;
            padding-bottom: 0;
            display:flex;
            align-items:center;
        }

        .navbar-custom .container{
            height:110px;
            display:flex;
            align-items:center;
        }

        .navbar-brand{
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing:.5px;
            margin-left:4px; 
            padding-left:0;
        }

        .navbar-nav{
            align-items:center;
        }

        .navbar-nav .nav-item{
            display:flex;
            align-items:center;
        }

        .navbar-custom .nav-link{
            color:rgba(255,255,255,.90);
            padding:10px 18px !important;   
            font-size: .95rem;
            font-weight: 500;
            letter-spacing: .3px;
            border-radius: 10px;            
            display: flex;
            align-items: center;
            gap: 6px;  
        }

        .navbar-custom .nav-link{
            color:rgba(255,255,255,.85);
            transition:.2s;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: .3px;
        }

        .navbar-custom .nav-link:hover{
            color:#fff;
            transform:translateY(-1px);
        }
        
        .dropdown-genero{
            border:none;
            border-radius:12px;
            box-shadow:0 8px 20px rgba(0,0,0,.12);
            padding:8px;
        }

        .dropdown-genero .dropdown-item{
            border-radius:8px;
            padding:8px 14px;
            display:flex;
            align-items:center;
            gap:6px;
            font-weight:500;
        }

        .dropdown-genero .nav-masculinidades{
            background:white;
            color:#6c63ff;
        }

        .dropdown-genero .nav-ive{
            color: #6c63ff;
        }

        .dropdown-genero .dropdown-item:hover{
            background:#e9e9e9;
        }


        .nav-masculinidades{
            background: white;
            color:#6c63ff !important;
        }

        .nav-ive{
            color: #6c63ff !important;
        }

        .nav-diversidad{
            background: white;
            color:#6c63ff !important;
        }

        .nav-destacado{
            padding:12px 22px !important;
            font-size:1.05rem;
            font-weight:600;
            border-radius:12px;
            display:flex;
            align-items:center;
            gap:8px;
}

        .nav-destacado:hover{
            background:rgba(255,255,255,.15);
            transform:translateY(-2px);
        }

        .nav-admin{
            padding:12px 22px !important;
            font-size:1.05rem;
            font-weight:700;
            border-radius:12px;
            background: #682d98; 
            color: #ffffff !important;
            display:flex;
            align-items:center;
            gap:8px;
        }

        .nav-admin:hover{
            background: #894fb8;
        }

        .nav-masculinidades:hover,
        .nav-ive:hover,
        .nav-diversidad:hover{
            background:#e9e9e9;
            transform:translateY(-2px);
        }
        
        .navbar .container-fluid{
            padding-right: 8px;
            padding-left: 8px;
        }

        .btn-outline-light{
            padding:6px 14px;
            font-size:.9rem;
        }

        .card-soft{
            border:none;
            border-radius:14px;
            box-shadow:0 6px 18px rgba(0,0,0,.08);
        }

        footer{
            background: #7973cf;
            color:white;
            height: 90px;
            padding-top:18px !important;
            padding-bottom:18px !important;
            font-size:.9rem;
        }

            

        .fade-page{
            animation: fadePage .85s ease;
        }

        @keyframes fadePage{
            from{
                opacity:0;
                transform:translateY(10px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            Dirección de Género
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navGenero">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navGenero">
            <ul class="navbar-nav me-auto ">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle nav-diversidad"
                    href="#"
                    id="dropdownAreas"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                        <i class="bi bi-grid mx-1 "></i> Áreas
                    </a>

                    <ul class="dropdown-menu dropdown-genero">

                        <li>
                            <a class="dropdown-item nav-diversidad" href="{{ route('genero.index') }}">
                                <i class="bi bi-gender-ambiguous"></i> Género
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item nav-masculinidades" href="{{ route('masculinidades.index') }}">
                                <i class="bi bi-people"></i> Masculinidades
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item nav-ive"  href="{{ route('frontend.areas.ive.index') }}">
                                <i class="bi bi-heart-pulse"></i> IVE
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link nav-destacado" href="{{ route('frontend.stats.index') }}">
                        <i class="bi bi-bar-chart"></i> Estadísticas
                    </a>
                </li>
                
                
                @auth
                    <li class="nav-item mx-1">
                        <a class="nav-link nav-destacado" href="{{ route('manuales') }}">
                            <i class="bi bi-journal-text"></i> Manuales
                        </a>
                    </li>

                    @if(auth()->user()->esAdmin())
                        <li class="nav-item mx-1">
                            <a class="nav-link nav-admin" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-shield-lock"></i> Panel Administrador
                            </a>
                        </li>
                    @endif
                @endauth
                @auth
                <li class="nav-item">
                    <form class="d-flex ms-4" action="{{ route('buscar') }}" method="GET">
                        <div class="input-group">
                            <input 
                                type="text"
                                name="buscar"
                                class="form-control form-control-sm border-0"
                                placeholder="Buscar por DNI, Nombre o Apellido"
                                style="width:320px;height:38px;"
                                value="{{ request('buscar') }}"
                            >
                            <button class="btn btn-outline-light" style="height:38px;">
                                Buscar
                            </button>
                        </div>
                    </form>
                </li>
                @endauth
            </ul>


            @auth
                <div class="d-flex align-items-center gap-3">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-dark">
                            Salir
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

<main class="container flex-grow-1 py-4 fade-page">
    @yield('content')
</main>

<footer class="mt-auto py-3">
    <div class="container text-center small">
        Sistema institucional — Secretaría de Desarrollo Humano
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

@if(session('success'))
Toast.fire({
    icon: 'success',
    title: "{{ session('success') }}"
});
@endif

@if(session('error'))
Toast.fire({
    icon: 'error',
    title: "{{ session('error') }}"
});
@endif

@if(session('warning'))
Toast.fire({
    icon: 'warning',
    title: "{{ session('warning') }}"
});
@endif

@if(session('info'))
Toast.fire({
    icon: 'info',
    title: "{{ session('info') }}"
});
@endif

</script>




<script>
document.querySelectorAll('.form-eliminar').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({
            title: '¿Eliminar registro?',
            text: "No se podrá recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#5651a0',
            confirmButtonText: 'Sí, eliminar'
        }).then((result)=>{

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});
</script>
</body>
</html>
