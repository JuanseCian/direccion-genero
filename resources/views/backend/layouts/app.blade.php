<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Panel Administrador')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/back.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/logo_genero.png') }}" type="image/png">


</head>
<body class="sidebar-collapsed">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session("success") }}',
            iconColor: '#5651a0',
            background: '#ffffff',
        });
    @endif
</script>

@if(session('error'))
<script>
    Toast.fire({
        icon: 'error',
        title: '{{ session("error") }}',
        background: '#fff5f5',
    });
</script>
@endif

@if(session('deleted'))
<script>
    Toast.fire({
        icon: 'success',
        title: 'Registro eliminado',
        text: '{{ session("deleted") }}',
        iconHtml: '<i class="bi bi-trash" style="font-size:20px; color:#dc3545"></i>',
    });
</script>
@endif

<header class="admin-header">

    <button id="toggleSidebar" class="btn btn-light btn-sm me-3">
        <i class="bi bi-list"></i>
    </button>

    <div class="title">
        <i class="bi bi-speedometer2"></i>
        <span class="ms-2">Panel de Administrador</span>
    </div>

    <div class="right ms-auto">
        <a href="{{ route('home') }}" class="text-white text-decoration-none">
            <i class="bi bi-box-arrow-left"></i> Salir del panel
        </a>
    </div>

</header>

<aside class="sidebar" id="sidebar">

    <div class="section">Gestión</div>

    <a href="{{ route('admin.users.index') }}">
        <i class="bi bi-people-fill"></i>
        <span class="menu-text">Panel de Usuarios</span>
    </a>

    <a href="{{ route('backend.papelera.index') }}">
        <i class="bi bi-trash"></i>
        <span class="menu-text">Registros Eliminados</span>
    </a>

    <div class="menu-group">

        <a href="#" class="menu-parent ubicaciones-btn" onclick="toggleUbicaciones(event)">

            <i class="bi bi-geo-alt"></i>
            <span class="menu-text">Ubicaciones</span>
            <i class="bi bi-chevron-down collapse-arrow"></i>

        </a>


        <div class="submenu" id="submenuUbicaciones">

            
            <a  href="{{ route('localidades.index') }}" class="fw-bold">Localidades</a>
            <a href="{{ route('barrios.index') }}" class="fw-bold">Barrios</a>
            <a href="{{ route('zonas.index') }}" class="fw-bold">Zonas</a>

        </div>

    </div>

    <a href="{{ route('backend.estado-civil.index') }}">
        <i class="bi bi-people"></i>
        <span class="menu-text">Estados Civiles</span>
    </a>
    
    <a href="{{ route('backend.nivel-estudio.index') }}">
        <i class="bi bi-mortarboard"></i>
        <span class="menu-text">Niveles de Estudio</span>
    </a>
    
    <a href="{{ route('backend.encargados.index') }}">
        <i class="bi bi-person-badge"></i>
        <span class="menu-text">Encargado</span>
    </a>

    <div class="menu-group">
        <a href="#" class="menu-parent ubicaciones-btn" onclick="toggleContencion(event)">
            <i class="bi bi-heart-pulse"></i>
            <span class="menu-text">Medidas de Contención</span>
            <i class="bi bi-chevron-down collapse-arrow"></i>
        </a>


        <div class="submenu" id="submenuContencion">

            <a href="{{ route('medidas-cautelares.index') }}" class="fw-bold">Medidas Cautelares</a>
            <a href="{{ route('espacios-grupales.index') }}" class="fw-bold">Espacios Grupales</a>
            <a href="{{ route('backend.situaciones-habitacionales.index') }}" class="fw-bold">Situaciones Habitacionales</a>
            <a href="{{ route('backend.programas-asistencia.index') }}" class="fw-bold">Programas de Asistencia</a>
            <a href="{{ route('backend.situaciones-sanitarias.index') }}" class="fw-bold">Situaciones Sanitarias</a>
            <a href="{{ route('backend.tipo-violencia.index') }}" class="fw-bold">Tipos de Violencia</a>

        </div>

    </div>
    
    <a href="{{ route('backend.tipo-intervencion.index') }}">
        <i class="bi bi-person-gear"></i>
        <span class="menu-text">Tipos de Intervención</span>
    </a>


    <a href="{{ route('home') }}">
        <i class="bi bi-house"></i>
        <span class="menu-text">Volver al inicio</span>
    </a>

</aside>

<main class="content" id="content">
    @yield('content')
</main>

<script>
function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
    document.getElementById('content').classList.toggle('content-expanded');
}
</script>
<script>
document.getElementById("toggleSidebar").addEventListener("click", function(){
    document.body.classList.toggle("sidebar-collapsed");
});
</script>
<script>

function toggleUbicaciones(e){

if(document.body.classList.contains('sidebar-collapsed'))
return;

e.preventDefault();

document
.getElementById('submenuUbicaciones')
.classList.toggle('open');

}

</script>
<script>
function toggleContencion(e){

    if(document.body.classList.contains('sidebar-collapsed'))
        return;

    e.preventDefault();

    document
    .getElementById('submenuContencion')
    .classList.toggle('open');

}
</script>
<script>
function confirmDelete(form) {
    Swal.fire({
        title: '¿Confirmar eliminación?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#5651a0',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Volver',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(); // Si confirma, se envía el formulario
        }
    });

    return false; // Evita el envío automático del formulario
}
</script>
<script>

document.addEventListener("DOMContentLoaded", function(){

    document.querySelectorAll(".form-delete").forEach(function(form){

        form.addEventListener("submit", function(e){

            e.preventDefault();

            Swal.fire({

                title: '¿Estás seguro?',
                text: "¿Estás seguro de eliminar este tipo de intervención?",
                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#5651a0',

                confirmButtonText: '<i class="bi bi-trash"></i> Eliminar',
                cancelButtonText: 'Cancelar',

                reverseButtons: true,

                width: 450,
                padding: '2em',

            }).then((result)=>{

                if(result.isConfirmed){
                    form.submit();
                }

            });

        });

    });

});

</script>
</body>
</html>