    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="icon" href="{{ asset('assets/img/entramados_logo.png') }}" type="image/x-icon">
        <title>Genero - Acceso</title>
        <style>
            body { 
                background-color: rgb(121, 115, 207);
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                background-position: center;

                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .flip-card-container { 
                perspective: 1000px; 
                width: 100%; 
                max-width: 1000px; 
                margin: 20px auto; 
                min-height: 550px; 
            }

            .flip-card-inner { 
                position: relative; 
                width: 100%; 
                height: 100%; 
                transition: transform 0.8s; 
                transform-style: preserve-3d; 
            }

            .is-flipped { transform: rotateY(180deg); }

            .flip-card-front, .flip-card-back { 
                position: absolute; 
                width: 100%; 
                height: 100%;
                backface-visibility: hidden; 
                -webkit-backface-visibility: hidden; 
            }

            .flip-card-front { z-index: 2; }
            .flip-card-back { transform: rotateY(180deg); z-index: 1; }

            .is-flipped .flip-card-front { z-index: 1; }
            .is-flipped .flip-card-back { z-index: 2;}

            .background-image {
                background-image: 
                    linear-gradient(rgba(60, 55, 127, 0.75), rgba(164, 159, 215, 0.85)),
                    url('{{ asset('assets/img/fondo-03.png') }}');
                background-size: cover;
                background-position: center;
            }


            .card { 
                border-radius: 15px; 
                box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            }

            section {
                flex: 1 auto; 
                padding-bottom: 0 !important; 
            }

            footer {
                flex-shrink: 0;
                margin-top: auto;
            }
        </style>
    </head>
    <body>
    @php
        $flip = request()->routeIs('register') || $errors->any();
    @endphp

    @error('username')
        <span class="text-danger">{{ $message }}</span>
    @enderror



    <section class="pt-4 px-3 px-md-5">
        <div class="container flip-card-container">
            <div class="flip-card-inner {{ $flip ? 'is-flipped' : '' }}" id="cardInner">
                
                <div class="flip-card-front">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-md-6 background-image d-none d-md-block">
                                <div class="d-flex align-items-center justify-content-center h-100 p-5 text-white">
                                    <div>
                                    <h2 class="h3">Dirección de Género</h2>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-4 p-xl-5 bg-white">
                                <h3>Iniciar Sesión</h3>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Usuario</label>
                                        <input type="text" name="login" class="form-control" placeholder="Usuario o Email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="login_password" class="form-control" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="login_password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100">Ingresar</button>
                                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                                </form>
                                <p class="mt-4 text-center">¿No tienes cuenta? <a href="javascript:void(0)" onclick="flip(true)">Regístrate</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flip-card-back">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-md-6 background-image d-none d-md-block">
                                <div class="d-flex align-items-center justify-content-center h-100 p-5 text-white">
                                    <h2 class="h3">Crea tu cuenta para comenzar.</h2>
                                </div>
                            </div>
                            <div class="col-md-6 p-4 p-xl-5 bg-white">
                                <h3 class="text-primary">Registro</h3>
                                @if ($errors->any())
                                    <div class="alert alert-danger py-2" style="font-size: 0.8rem;">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row g-2">
                                        <div class="col-12"><input type="text" name="username" class="form-control" placeholder="Usuario" required></div>
                                        <div class="col-6 position-relative">
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
                                                    <li id="a-lower" class="text-danger">✖ Al menos una letra minúscula</li>
                                                    <li id="a-special" class="text-danger">✖ Al menos un carácter especial</li>
                                                </ul>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar" required>
                                                
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <div id="matchAlert" class="alert alert-danger py-1 mt-1 d-none" style="font-size: 0.8rem;">
                                                    Las contraseñas no coinciden
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                                        <div class="col-6"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
                                        <div class="col-6"><input type="text" name="apellido" class="form-control" placeholder="Apellido" required></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-3">Registrar</button>
                                </form>
                                <p class="mt-4 text-center">¿Ya tienes cuenta? <a href="javascript:void(0)" onclick="flip(false)">Inicia Sesión</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- FOOTER --}}
    <footer class="bg-dark text-white py-3">
        <div class="container">
            <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start">
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
    const passwordInput = document.getElementById('password');

    if(passwordInput){
        passwordInput.addEventListener('input', function () {
            const value = this.value;

            const lengthRule = document.getElementById('rule-length');
            const lowerRule = document.getElementById('rule-lower');
            const specialRule = document.getElementById('rule-special');

            // Mínimo 8 caracteres
            if (value.length >= 8) {
                lengthRule.classList.replace('text-danger', 'text-success');
            } else {
                lengthRule.classList.replace('text-success', 'text-danger');
            }

            // Al menos una minúscula
            if (/[a-z]/.test(value)) {
                lowerRule.classList.replace('text-danger', 'text-success');
            } else {
                lowerRule.classList.replace('text-success', 'text-danger');
            }

            // Al menos un carácter especial
            if (/[!@#$%^&*()_+{}\[\]:;"'<>,.?~`]/.test(value)) {
                specialRule.classList.replace('text-danger', 'text-success');
            } else {
                specialRule.classList.replace('text-success', 'text-danger');
            }
        });
    }

    </script>

    <script>
    const passInput = document.getElementById('password');
    const passAlert = document.getElementById('passwordAlert');

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
                if (!validatePassword()) {
                    e.preventDefault();
                    passInput.focus();
                }
            });
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

    <script>
    const confirmInput = document.getElementById('password_confirmation');
    const matchAlert = document.getElementById('matchAlert');

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

    document.querySelector('form[action="{{ route('register') }}"]')
        .addEventListener('submit', function(e){
            if (passInput.value !== confirmInput.value) {
                e.preventDefault();
                matchAlert.classList.remove('d-none');
                confirmInput.focus();
            }
    });
    </script>

    @if ($errors->any())
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'No se pudo registrar',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        showConfirmButton: false,
        timer: 5000
    });
    </script>
    @endif
    </body>
    </html>