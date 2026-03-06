@extends('frontend.layouts.front')

@section('title', 'Inicio')

@section('content')

@php
$user = auth()->user();

$esAdmin = $user->rol_id == 2;

$tieneGenero = $esAdmin || $user->areas->contains('nombre','direccion_genero');
$tieneMasc = $esAdmin || $user->areas->contains('nombre','masculinidades');
$tieneIVE = $esAdmin || $user->areas->contains('nombre','ive');
@endphp

<div class="card card-soft p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h3 class="mb-1">
                Bienvenido
            </h3>

            <p class="mb-0 text-muted">
                Sistema de la Dirección de Género
            </p>

        </div>


        <div class="mt-2">

            <a href="{{ route('personas.index') }}" class="btn btn-primary btn-lg me-2">

               <i class="bi bi-people"></i> Personas </a>


                <a href="{{ route('personas.create') }}" class="btn btn-success btn-lg">

                <i class="bi bi-person-plus"></i> Nueva Persona </a>

        </div>

    </div>

</div>



<!-- CARDS AREAS -->

<div class="row text-center justify-content-center">


    <!-- GENERO -->

    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneGenero)
        <a href="{{ route('genero.index') }}" class="text-decoration-none">
        @endif

        <div class="card card-soft p-4 h-100 area-card area-genero
        {{ !$tieneGenero ? 'bloqueado' : '' }}">

            <div class="liston">
                Solo personal autorizado
            </div>

            <i class="bi bi-gender-ambiguous area-icon"></i>

            <h4 class="mt-3">
                Género y Diversidad
            </h4>

            <p class="text-muted">
                Gestión de legajos e intervenciones
            </p>

        </div>

        @if($tieneGenero)
        </a>
        @endif

        </div>



    <!-- MASCULINIDADES -->

    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneMasc)
        <a href="{{ route('masculinidades.index') }}" class="text-decoration-none">
        @endif

        <div class="card card-soft p-4 h-100 area-card area-masc
        {{ !$tieneMasc ? 'bloqueado' : '' }}">

            <div class="liston">
                Solo personal autorizado
            </div>

            <i class="bi bi-people area-icon"></i>

            <h4 class="mt-3">
                Agresores/Masculinidades
            </h4>

            <p class="text-muted">
                Seguimiento de casos
            </p>

        </div>

        @if($tieneMasc)
        </a>
        @endif

    </div>

    <!-- IVE -->

    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneIVE)
        <a href="{{ route('frontend.areas.ive.index') }}" class="text-decoration-none">
        @endif

        <div class="card card-soft p-4 h-100 area-card area-ive
        {{ !$tieneIVE ? 'bloqueado' : '' }}">

            <div class="liston">
                Solo personal autorizado
            </div>

            <i class="bi bi-heart-pulse area-icon"></i>

            <h4 class="mt-3">
                IVE
            </h4>

            <p class="text-muted">
                Atención y acompañamiento
            </p>

        </div>

        @if($tieneIVE)
        </a>
        @endif

    </div>


</div>



<!-- ESTILOS (DESPUÉS LOS PASAMOS A CSS) -->

<style>

.area-icon{

    font-size:55px;
    color:#6c63ff;

}


.area-card{
    transition:.25s;
    cursor:pointer;
    border-radius:14px;
}


/* GENERO */

.area-genero:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    background:#b8b3f5;
    color:white;
}


/* MASCULINIDADES */

.area-masc:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    background:#7ec8ff;
    color:white;
    }


/* IVE */

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


/* EFECTOS NORMALES */

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

/* HOVER BLOQUEADO */

.bloqueado:hover{
    background:#ff5c5c;
    color:white;
    transform:translateY(-4px);
}

/* LISTON */

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


/* APARECE SOLO EN HOVER */

.bloqueado:hover .liston{
    opacity:1;
}
</style>



<!-- ALERTAS -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if(session('success'))

<script>

Swal.fire({

toast:true,

position:'top-end',

icon:'success',

title:'{{ session('success') }}',

showConfirmButton:false,

timer:3000,

timerProgressBar:true

});

</script>

@endif


@endsection