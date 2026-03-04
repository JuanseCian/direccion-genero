@extends('frontend.layouts.front')

@section('title', 'Estadísticas Generales')

@section('content')

@php
$user = auth()->user();

$esAdmin = $user->rol_id == 2;

$tieneGenero = $esAdmin || $user->areas->contains('nombre','direccion_genero');
$tieneMasc = $esAdmin || $user->areas->contains('nombre','masculinidades');
$tieneIVE = $esAdmin || $user->areas->contains('nombre','ive');
@endphp


<!-- HEADER -->

<div class="card card-soft p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h3 class="mb-1">
                Panel de Estadísticas
            </h3>

            <p class="mb-0 text-muted">
                Indicadores y métricas por área
            </p>
        </div>

        <div class="mt-2">
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Volver al Inicio
            </a>
        </div>

    </div>

</div>


<!-- CARDS ESTADÍSTICAS -->

<div class="row text-center justify-content-center">

    <!-- GENERO -->
    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneGenero)
        <a href="{{ route('stats.genero') }}" class="text-decoration-none">
        @endif

        <div class="card card-soft p-4 h-100 area-card area-genero
        {{ !$tieneGenero ? 'bloqueado' : '' }}">

            <div class="liston">
                Solo personal autorizado
            </div>

            <i class="bi bi-bar-chart-line area-icon"></i>

            <h4 class="mt-3">
                Estadísticas Género
            </h4>

            <p class="text-muted">
                Indicadores Dirección de Género
            </p>

        </div>

        @if($tieneGenero)
        </a>
        @endif

    </div>


    <!-- MASCULINIDADES -->
    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneMasc)
        <a href="{{ route('stats.masculinidades') }}" class="text-decoration-none">
        @endif

        <div class="card card-soft p-4 h-100 area-card area-masc
        {{ !$tieneMasc ? 'bloqueado' : '' }}">

            <div class="liston">
                Solo personal autorizado
            </div>

            <i class="bi bi-graph-up area-icon"></i>

            <h4 class="mt-3">
                Estadísticas Masculinidades
            </h4>

            <p class="text-muted">
                Métricas y evolución de casos
            </p>

        </div>

        @if($tieneMasc)
        </a>
        @endif

    </div>


    <!-- IVE -->
    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneIVE)
        <a href="{{ route('stats.ive') }}" class="text-decoration-none">
        @endif

        <div class="card card-soft p-4 h-100 area-card area-ive
        {{ !$tieneIVE ? 'bloqueado' : '' }}">

            <div class="liston">
                Solo personal autorizado
            </div>

            <i class="bi bi-pie-chart area-icon"></i>

            <h4 class="mt-3">
                Estadísticas IVE
            </h4>

            <p class="text-muted">
                Indicadores de acompañamiento
            </p>

        </div>

        @if($tieneIVE)
        </a>
        @endif

    </div>

</div>



<!-- ESTILOS (mismos que tu dashboard) -->

<style>

.area-icon{
    font-size:55px;
    color:#6c63ff;
}

.area-card{
    transition:.25s;
    cursor:pointer;
    border-radius:14px;
    position:relative;
    overflow:hidden;
}

/* HOVERS */

.area-genero:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    background:#b8b3f5;
    color:white;
}

.area-masc:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    background:#7ec8ff;
    color:white;
}

.area-ive:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    background:#63c97a;
    color:white;
}

.area-card:hover h4,
.area-card:hover p{
    color:white !important;
}

/* BLOQUEADO */

.bloqueado{
    opacity:0.9;
    cursor:not-allowed;
}

.bloqueado:hover{
    background:#ff5c5c;
    color:white;
    transform:translateY(-4px);
}

.liston{
    position:absolute;
    top:50%;
    left:-40%;
    width:180%;
    text-align:center;
    background:#8b0000;
    color:white;
    font-weight:bold;
    padding:10px;
    transform:rotate(-25deg);
    opacity:0;
    transition:.3s;
    font-size:14px;
}

.bloqueado:hover .liston{
    opacity:1;
}

</style>

@endsection