<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Panel Administrador')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/back.css') }}" rel="stylesheet">

</head>
<body class="sidebar-collapsed">

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

    <a href="#">
        <i class="bi bi-people-fill"></i>
        <span class="menu-text">Panel de Usuarios</span>
    </a>

    <a href="#">
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

            <a href="{{ route('provincias.index') }}">Provincias</a>
            <a href="{{ route('localidades.index') }}">Localidades</a>
            <a href="{{ route('barrios.index') }}">Barrios</a>
            <a href="{{ route('zonas.index') }}">Zonas</a>

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
    
    <a href="#">
        <i class="bi bi-person-badge"></i>
        <span class="menu-text">Encargado</span>
    </a>

    <a href="#">
        <i class="bi bi-gender-ambiguous"></i>
        <span class="menu-text">Género</span>
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

</body>
</html>