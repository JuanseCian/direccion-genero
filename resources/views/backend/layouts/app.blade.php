<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Panel Administrador')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root{
    --sidebar-width:300px;
    --sidebar-bg:#244b63;
    --header-bg:#2f657d;
    --header-height:90px;
    --sidebar-width:260px;
}

body{
    margin:0;
    background:#f1f4f7;
    overflow-x:hidden;
}
.admin-header{
    height:var(--header-height);
    background-color: #5651a0;
    color:white;
    display:flex;
    align-items:center;
    padding:0 15px;
    position:fixed;
    top:0;
    left:0;
    right:0;
    z-index:1100;
}

.admin-header .title{
    font-size:1.3rem;
    font-weight:600;
}

.admin-header .right{
    margin-left:auto;
}

.sidebar{
    width:var(--sidebar-width);
    height:calc(100vh - var(--header-height));
    background: #7973cf;
    color:white;
    position:fixed;
    left:0;
    top:var(--header-height);
    transition:all .25s ease;
    overflow:hidden;
}

.menu-text{
    transition:opacity .2s, width .2s;
    white-space:nowrap;
}


.sidebar .menu-text{
    white-space:nowrap;
    transition:opacity .2s;
}

body.sidebar-collapsed .sidebar{
    width:85px;
}

body.sidebar-collapsed .sidebar .menu-text{
    opacity:0;
    pointer-events:none;
}

body.sidebar-collapsed .sidebar a{
    justify-content:center;
}

body.sidebar-collapsed .menu-text{
    opacity:0;
    width:0;
    overflow:hidden;
}

body.sidebar-collapsed .sidebar a{
    justify-content:center;
    padding-left:0;
    padding-right:0;
}

body.sidebar-collapsed .sidebar .section{
    opacity:0;
}

.main-content{
    margin-left:260px;
    transition:all .25s ease;
}

body.sidebar-collapsed .main-content{
    margin-left:72px;
}

.topbar{
    height:70px;
    background:#2e5f73;
    color:white;
    display:flex;
    align-items:center;
    padding:0 20px;
}
.sidebar a{
    color:#e6eef3;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:14px;
    padding:12px 22px;
    font-size:.95rem;
    transition:.2s;
}

.sidebar a i{
    font-size:1.25rem;
    min-width:26px;
    text-align:center;
}

.sidebar a:hover{
    background:rgba(255,255,255,.08);
    padding-left:28px;
}

.sidebar .section{
    font-size:.7rem;
    text-transform:uppercase;
    letter-spacing:1px;
    opacity:.6;
    padding:18px 22px 6px;
}

.content{
    margin-left:var(--sidebar-width);
    margin-top:var(--header-height);
    padding:30px;
    transition:.25s;
}


body.sidebar-collapsed .content{
    margin-left:72px;
}

.content-expanded{
    margin-left:0;
}

.toggle-btn{
    cursor:pointer;
    font-size:1.3rem;
    margin-right:15px;
}
</style>
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

    <a href="#">
        <i class="bi bi-exclamation-circle"></i>
        <span class="menu-text">Problemáticas</span>
    </a>

    <a href="#">
        <i class="bi bi-geo-alt"></i>
        <span class="menu-text">Zonas y Barrios</span>
    </a>

    <a href="#">
        <i class="bi bi-hammer"></i>
        <span class="menu-text">Causas Penales</span>
    </a>

    <a href="#">
        <i class="bi bi-building"></i>
        <span class="menu-text">Organismos</span>
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

</body>
</html>