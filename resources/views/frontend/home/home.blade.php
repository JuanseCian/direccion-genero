@extends('frontend.layouts.front')

@section('title', 'Inicio')

@section('content')

<!-- BIENVENIDA + BOTONES PERSONAS -->

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

            <a href="{{ route('personas.index') }}"
               class="btn btn-primary btn-lg me-2">

               <i class="bi bi-people"></i>
               Personas

            </a>


            <a href="{{ route('personas.create') }}"
               class="btn btn-success btn-lg">

               <i class="bi bi-person-plus"></i>
               Nueva Persona

            </a>

        </div>

    </div>

</div>



<!-- CARDS AREAS -->

<div class="row text-center justify-content-center">


    <!-- GENERO -->

    <div class="col-lg-4 col-md-6 mb-4">

        <a href="{{ route('genero.index') }}"
           class="text-decoration-none">

            <div class="card card-soft p-4 h-100 area-card area-genero">

                <i class="bi bi-gender-ambiguous area-icon"></i>

                <h4 class="mt-3">

                    Género y Diversidad

                </h4>

                <p class="text-muted">

                    Gestión de legajos e intervenciones

                </p>

            </div>

        </a>

    </div>



    <!-- MASCULINIDADES -->

    <div class="col-lg-4 col-md-6 mb-4">

        <a href="{{ route('masculinidades.index') }}"
           class="text-decoration-none">

            <div class="card card-soft p-4 h-100 area-card area-masc">

                <i class="bi bi-people area-icon"></i>

                <h4 class="mt-3">

                    Masculinidades

                </h4>

                <p class="text-muted">

                    Seguimiento de casos

                </p>

            </div>

        </a>

    </div>



    <!-- IVE -->

    <div class="col-lg-4 col-md-6 mb-4">

        <a href="{{ route('ive.index') }}"
           class="text-decoration-none">

            <div class="card card-soft p-4 h-100 area-card area-ive">

                <i class="bi bi-heart-pulse area-icon"></i>

                <h4 class="mt-3">

                    IVE

                </h4>

                <p class="text-muted">

                    Atención y acompañamiento

                </p>

            </div>

        </a>

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