<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="icon" href="{{ asset('assets/img/entramados_logo.png') }}">
<title>Recuperar Contraseña</title>

<style>
body { 
    background-color: rgb(121, 115, 207);
    display:flex;
    min-height:100vh;
    align-items:center;
}
.background-image {
    background-image: 
        linear-gradient(rgba(60, 55, 127, 0.75), rgba(164, 159, 215, 0.85)),
        url('{{ asset('assets/img/fondo-03.png') }}');
    background-size: cover;
    background-position: center;
}
.card { border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,0.1);}
</style>
</head>
<body>

<div class="container">
<div class="card border-0">
<div class="row g-0">

<div class="col-md-6 background-image d-none d-md-flex align-items-center justify-content-center text-white p-5">
    <div>
        <h2>Dirección de Género</h2>
        <p>Te enviaremos un enlace para restablecer tu contraseña.</p>
    </div>
</div>

<div class="col-md-6 p-5 bg-white">
    <h3 class="mb-4">Recuperar contraseña</h3>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-dark w-100">
            Enviar enlace
        </button>

        <a href="{{ route('login') }}" class="d-block text-center mt-3">
            Volver al login
        </a>
    </form>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Enlace enviado',
    text: '{{ session('status') }}'
});
</script>
@endif

</body>
</html>