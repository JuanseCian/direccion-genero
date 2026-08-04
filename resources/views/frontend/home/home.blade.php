@extends('frontend.layouts.front')

@section('title', 'Inicio')

@section('content')

@php
    $user = auth()->user();

    $esAdmin = $user->rol_id == 2;

    $tieneGenero = $esAdmin
        || $user->areas->contains('nombre', 'direccion_genero');

    $tieneMasc = $esAdmin
        || $user->areas->contains('nombre', 'masculinidades');

    $tieneIVE = $esAdmin
        || $user->areas->contains('id', 3)
        || $user->iveCasos()->exists();
@endphp


{{-- ENCABEZADO --}}

<div class="card card-soft p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h3 class="mb-1">
                Bienvenido
            </h3>

            <p class="mb-0 text-muted">
                Sistema de la Dirección de Género
            </p>
        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('personas.index') }}"
                class="btn btn-primary btn-lg"
            >
                <i class="bi bi-people me-1"></i>
                Personas
            </a>

            <a
                href="{{ route('personas.create') }}"
                class="btn btn-success btn-lg"
            >
                <i class="bi bi-person-plus me-1"></i>
                Nueva Persona
            </a>

        </div>

    </div>

</div>


{{-- CARDS DE ÁREAS --}}

<div class="row text-center justify-content-center">


    {{-- GÉNERO Y DIVERSIDAD --}}

    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneGenero)
            <a
                href="{{ route('genero.index') }}"
                class="text-decoration-none"
            >
        @endif

        <div
            class="card card-soft p-4 h-100 area-card area-genero
            {{ !$tieneGenero ? 'bloqueado' : '' }}"
        >

            @unless($tieneGenero)
                <div class="liston">
                    Solo personal autorizado
                </div>
            @endunless

            <i class="bi bi-gender-ambiguous area-icon"></i>

            <h4 class="mt-3">
                Género y Diversidad
            </h4>

            <p class="text-muted mb-0">
                Gestión de legajos e intervenciones
            </p>

        </div>

        @if($tieneGenero)
            </a>
        @endif

    </div>


    {{-- MASCULINIDADES --}}

    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneMasc)
            <a
                href="{{ route('masculinidades.index') }}"
                class="text-decoration-none"
            >
        @endif

        <div
            class="card card-soft p-4 h-100 area-card area-masc
            {{ !$tieneMasc ? 'bloqueado' : '' }}"
        >

            @unless($tieneMasc)
                <div class="liston">
                    Solo personal autorizado
                </div>
            @endunless

            <i class="bi bi-people area-icon"></i>

            <h4 class="mt-3">
                Agresores/Masculinidades
            </h4>

            <p class="text-muted mb-0">
                Seguimiento de casos
            </p>

        </div>

        @if($tieneMasc)
            </a>
        @endif

    </div>


    {{-- IVE --}}

    <div class="col-lg-4 col-md-6 mb-4">

        @if($tieneIVE)
            <a
                href="{{ route('frontend.areas.ive.index') }}"
                class="text-decoration-none"
            >
        @endif

        <div
            class="card card-soft p-4 h-100 area-card area-ive
            {{ !$tieneIVE ? 'bloqueado' : '' }}"
        >

            @unless($tieneIVE)
                <div class="liston">
                    Solo personal autorizado
                </div>
            @endunless

            <i class="bi bi-heart-pulse area-icon"></i>

            <h4 class="mt-3">
                IVE
            </h4>

            <p class="text-muted mb-0">
                Atención y acompañamiento
            </p>

        </div>

        @if($tieneIVE)
            </a>
        @endif

    </div>

</div>


<style>

    /* CARDS DE ÁREAS */

    .area-card {
        position: relative;
        overflow: hidden;
        min-height: 250px;
        border-radius: 14px;
        cursor: pointer;
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            background-color 0.25s ease,
            color 0.25s ease;
    }

    .area-icon {
        font-size: 55px;
        color: #6c63ff;
        transition:
            color 0.25s ease,
            transform 0.25s ease;
    }

    .area-card h4,
    .area-card p {
        transition: color 0.25s ease;
    }

    .area-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .area-card:hover .area-icon {
        transform: scale(1.08);
        color: #ffffff;
    }

    .area-card:hover h4,
    .area-card:hover p {
        color: #ffffff !important;
    }


    /* GÉNERO */

    .area-genero:hover {
        background-color: #8e86e8;
        color: #ffffff;
    }


    /* MASCULINIDADES */

    .area-masc:hover {
        background-color: #50aeee;
        color: #ffffff;
    }


    /* IVE */

    .area-ive:hover {
        background-color: #52b96a;
        color: #ffffff;
    }


    /* ÁREA BLOQUEADA */

    .area-card.bloqueado {
        opacity: 0.88;
        cursor: not-allowed;
    }

    .area-card.bloqueado:hover {
        background-color: #d9534f;
        color: #ffffff;
        transform: translateY(-4px);
    }

    .area-card.bloqueado:hover .area-icon {
        color: #ffffff;
    }


    /* LISTÓN DE ÁREA BLOQUEADA */

    .liston {
        position: absolute;
        top: 50%;
        left: -40%;
        z-index: 3;
        width: 180%;
        padding: 10px;
        background-color: #8b0000;
        color: #ffffff;
        text-align: center;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.2px;
        opacity: 0;
        transform: translateY(-50%) rotate(-25deg);
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .bloqueado:hover .liston {
        opacity: 1;
    }


    /* SWEETALERT */

    .swal-toast-personalizado {
        width: auto !important;
        min-width: 330px !important;
        max-width: 430px !important;
        padding: 14px 18px !important;
        border-radius: 14px !important;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18) !important;
    }

    .swal-toast-titulo {
        margin: 0 10px !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        line-height: 1.4 !important;
        text-align: left !important;
    }

    .swal-toast-cerrar {
        font-size: 25px !important;
        transition:
            color 0.2s ease,
            transform 0.2s ease !important;
    }

    .swal-toast-cerrar:hover {
        transform: scale(1.12);
    }

    .swal-toast-barra {
        height: 4px !important;
        background-color: rgba(108, 99, 255, 0.75) !important;
    }


    /* ANIMACIÓN DE ENTRADA */

    .swal-toast-entrada {
        animation: swalToastEntrada 0.45s ease-out forwards;
    }

    @keyframes swalToastEntrada {

        from {
            opacity: 0;
            transform: translateX(120%);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }

    }


    /* ANIMACIÓN DE SALIDA */

    .swal-toast-salida {
        animation: swalToastSalida 0.35s ease-in forwards;
    }

    @keyframes swalToastSalida {

        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(120%);
        }

    }


    /* RESPONSIVE */

    @media (max-width: 576px) {

        .swal-toast-personalizado {
            min-width: calc(100vw - 30px) !important;
            max-width: calc(100vw - 30px) !important;
        }

        .area-card {
            min-height: 220px;
        }

    }

</style>


{{-- SWEETALERT2 --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const Toast = Swal.mixin({

            toast: true,

            position: 'top-end',

            showConfirmButton: false,

            showCloseButton: true,

            timer: 1435,

            timerProgressBar: true,

            customClass: {
                popup: 'swal-toast-personalizado',
                title: 'swal-toast-titulo',
                closeButton: 'swal-toast-cerrar',
                timerProgressBar: 'swal-toast-barra'
            },

            showClass: {
                popup: 'swal-toast-entrada'
            },

            hideClass: {
                popup: 'swal-toast-salida'
            },

            didOpen: function (toast) {

                toast.addEventListener(
                    'mouseenter',
                    Swal.stopTimer
                );

                toast.addEventListener(
                    'mouseleave',
                    Swal.resumeTimer
                );

            }

        });


        @if(session('success'))

            Toast.fire({
                icon: 'success',
                title: @json(session('success'))
            });

        @endif


        @if(session('error'))

            Toast.fire({
                icon: 'error',
                title: @json(session('error'))
            });

        @endif


        @if(session('warning'))

            Toast.fire({
                icon: 'warning',
                title: @json(session('warning'))
            });

        @endif


        @if(session('info'))

            Toast.fire({
                icon: 'info',
                title: @json(session('info'))
            });

        @endif


        @if($errors->any())

            Toast.fire({
                icon: 'error',
                title: @json($errors->first())
            });

        @endif

    });

</script>

@endsection