<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/entramados_logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/img/logo_genero.png') }}" type="image/png">
    <title>Genero - Acceso</title>
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; /* Tipografía moderna */
            background-color: rgb(121, 115, 207);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .flip-card-container { 
            perspective: 1000px; 
            width: 100%; 
            max-width: 1000px; 
            margin: 20px auto; 
        }

        .flip-card-inner { 
            position: relative; 
            width: 100%; 
            height: 100%; 
            transition: transform 0.8s cubic-bezier(0.4, 0.2, 0.2, 1); /* Transición más suave */
            transform-style: preserve-3d; 
            display: grid;
        }

        .is-flipped { transform: rotateY(180deg); }

        .flip-card-front, .flip-card-back { 
            grid-area: 1 / 1 / 2 / 2;
            width: 100%; 
            backface-visibility: hidden; 
            -webkit-backface-visibility: hidden; 
        }

        .flip-card-front { z-index: 2; }
        .flip-card-back { transform: rotateY(180deg); z-index: 1; }

        .is-flipped .flip-card-front { z-index: 1; }
        .is-flipped .flip-card-back { z-index: 2;}

        .background-image {
            background-image: 
                linear-gradient(rgba(60, 55, 127, 0.8), rgba(164, 159, 215, 0.9)),
                url('{{ asset('assets/img/fondo-03.png') }}');
            background-size: cover;
            background-position: center;
        }

        .card { 
            border-radius: 20px; /* Bordes más modernos */
            box-shadow: 0 10px 30px rgba(0,0,0,0.15); /* Sombra más profunda y elegante */
            overflow: hidden; /* Evita que el fondo se salga de los bordes redondeados */
            border: none;
        }

        /* Ajustes de estilo para inputs y botones */
        .form-control {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(121, 115, 207, 0.25);
            border-color: #7973cf;
        }

        .btn {
            border-radius: 8px;
            padding: 0.6rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Clase específica para controlar el logo */
        .logo-login {
            max-width: 220px; /* Tamaño controlado y proporcionado */
            width: 100%;
            height: auto;
            filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.2)); /* Leve sombra al logo */
        }

        section {
            flex: 1; 
            display: flex;
            align-items: center;    
            justify-content: center;
            padding: 40px 15px;      
        }

        footer {
            flex-shrink: 0;
            margin-top: auto;
        }

        a {
            color: #7973cf;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #585399;
            text-decoration: underline;
        }

        #passwordAlert {
            z-index: 1050;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            #passwordAlert {
                right: 0 !important;
                left: 0 !important;
                top: 100% !important;
                width: 100% !important;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    @php
        $flip = request()->routeIs('register') || $errors->any();
    @endphp

    <section class="px-3 px-md-5">
        <div class="container flip-card-container">
            <div class="flip-card-inner {{ $flip ? 'is-flipped' : '' }}" id="cardInner">
                
                <div class="flip-card-front">
                    <div class="card">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 background-image d-none d-md-block">
                                <div class="d-flex align-items-center justify-content-center h-100 p-5 text-white">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/logo_genero.png') }}" alt="Logo Género" class="img-fluid logo-login mb-3">
                                        <h4 class="fw-light">Bienvenido/a</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-4 p-xl-5 bg-white d-flex flex-column justify-content-center">
                                <h3 class="fw-bold mb-4" style="color: #3c377f;">Iniciar Sesión</h3>
                                
                                @error('username')
                                    <div class="alert alert-danger py-2 mb-3">{{ $message }}</div>
                                @enderror

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label text-muted small fw-bold">Usuario o Email</label>
                                        <input type="text" name="login" class="form-control" placeholder="Ingresa tu usuario o correo" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-bold">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="login_password" class="form-control" placeholder="••••••••" required>
                                            <button class="btn btn-outline-secondary toggle-password border-start-0" type="button" data-target="login_password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div class="text-end mt-2">
                                            <a href="{{ route('password.request') }}" class="small">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 mb-3" style="background-color: #3c377f; border: none;">Ingresar</button>
                                </form>
                                <p class="mt-3 text-center text-muted">¿No tienes cuenta? <a href="javascript:void(0)" onclick="flip(true)" class="fw-bold">Regístrate</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flip-card-back">
                    <div class="card">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 background-image d-none d-md-block">
                                <div class="d-flex align-items-center justify-content-center h-100 p-5 text-white text-center">
                                    <div>
                                        <img src="{{ asset('assets/img/logo_genero.png') }}" alt="Logo Género" class="img-fluid logo-login mb-3">
                                        <h2 class="h4 fw-light">Crea tu cuenta para comenzar</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-4 p-xl-5 bg-white">
                                <h3 class="fw-bold mb-3" style="color: #3c377f;">Registro</h3>
                                
                                @if ($errors->any())
                                    <div class="alert alert-danger py-2" style="font-size: 0.8rem;">
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input type="text" name="username" class="form-control" placeholder="Usuario" required>
                                        </div>
                                        
                                        <div class="col-sm-6 position-relative">
                                            <div class="input-group">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <div id="passwordAlert" class="alert alert-warning position-absolute d-none"
                                                style="top: 0; right: 105%; width: 260px; font-size: 0.8rem;">
                                                <strong>La contraseña debe tener:</strong>
                                                <ul class="mb-0 ps-3">
                                                    <li id="a-length" class="text-danger">✖ Mínimo 8 caracteres</li>
                                                    <li id="a-lower" class="text-danger">✖ Al menos una minúscula</li>
                                                    <li id="a-special" class="text-danger">✖ Al menos un carácter especial</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar" required>
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <div id="matchAlert" class="alert alert-danger py-1 mt-1 d-none w-100 text-center" style="font-size: 0.8rem; border-radius: 6px;">
                                                    No coinciden
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn w-100 mt-4 text-white" style="background-color: #3c377f;">Registrar cuenta</button>
                                </form>
                                <p class="mt-4 text-center text-muted">¿Ya tienes cuenta? <a href="javascript:void(0)" onclick="flip(false)" class="fw-bold">Inicia Sesión</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                    <a href="https://www.sannicolasciudad.gob.ar/" target="_blank">
                        <img src="./assets/img/municipalidad_logo.png" alt="Logo Footer" width="150" class="footer-logo">
                    </a>
                </div>
                <div class="col-md-9 text-center text-md-end">
                    <p class="mb-0">
                    <i class="fas fa-map-marker-alt"></i> Almte. Brown y José Luis Lazarte<br>
                    San Nicolás de Los Arroyos, Provincia de Buenos Aires<br>
                    <a href="mailto:entramados.sannicolas@gmail.com" class="text-white text-decoration-none">
                        <i class="fas fa-envelope"></i>denunciasviolenciasn@gmail.com
                    </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    </script>
    @endif

    @if(session('error'))
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true
    });
    </script>
    @endif

    <script>
        function flip(showRegister) {
            const card = document.getElementById('cardInner');
            if (showRegister) {
                card.classList.add('is-flipped');
                window.history.pushState({}, '', '{{ route('register') }}');
            } else {
                card.classList.remove('is-flipped');
                window.history.pushState({}, '', '{{ route('login') }}');
            }
        }
    </script>

    <script>
    const passInput = document.getElementById('password');
    const passAlert = document.getElementById('passwordAlert');
    const confirmInput = document.getElementById('password_confirmation');
    const matchAlert = document.getElementById('matchAlert');

    if (passInput) {
        function validatePassword() {
            const value = passInput.value;
            let errors = 0;

            function markRule(id, condition) {
                const el = document.getElementById(id);
                if (condition) {
                    el.classList.remove('text-danger');
                    el.classList.add('text-success');
                    el.innerHTML = el.innerHTML.replace('✖', '✔');
                } else {
                    el.classList.remove('text-success');
                    el.classList.add('text-danger');
                    el.innerHTML = el.innerHTML.replace('✔', '✖');
                    errors++;
                }
            }

            markRule('a-length', value.length >= 8);
            markRule('a-lower', /[a-z]/.test(value));
            markRule('a-special', /[!@#$%^&*()_+{}\[\]:;"'<>,.?~`]/.test(value));

            if (errors > 0 && value !== '') {
                passAlert.classList.remove('d-none');
            } else {
                passAlert.classList.add('d-none');
            }

            return errors === 0;
        }

        passInput.addEventListener('input', validatePassword);
        passInput.addEventListener('blur', validatePassword);

        document.querySelector('form[action="{{ route('register') }}"]')
            .addEventListener('submit', function(e){
                if (!validatePassword() || (confirmInput && passInput.value !== confirmInput.value)) {
                    e.preventDefault();
                    if(!validatePassword()) passInput.focus();
                    else confirmInput.focus();
                }
            });
    }

    function validateMatch() {
        if (!passInput || !confirmInput) return;

        if (confirmInput.value === "") {
            matchAlert.classList.add('d-none');
            return;
        }

        if (passInput.value !== confirmInput.value) {
            matchAlert.classList.remove('d-none');
            confirmInput.classList.add('is-invalid');
        } else {
            matchAlert.classList.add('d-none');
            confirmInput.classList.remove('is-invalid');
            confirmInput.classList.add('is-valid');
        }
    }

    if(confirmInput){
        confirmInput.addEventListener('input', validateMatch);
        passInput.addEventListener('input', validateMatch);
    }
    </script>

    <script>
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });
    </script>

    @if ($errors->any())
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'Por favor, revisa los errores',
        showConfirmButton: false,
        timer: 5000
    });
    </script>
    @endif
</body>
</html>