@extends('frontend.layouts.front')

@section('title','Área Masculinidades')

@section('content')
<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-people"></i>
            Área de Masculinidades 
        </h2>
        <span class="badge rounded-pill px-3 py-2" style="background: #ecebfa; color: #5651A0;">
            Programas y Casos
        </span>
    </div>

    <hr class="my-4" style="opacity: 0.1;">

    <div class="row g-4">
        {{-- LISTADO --}}
        <div class="col-md-4">
            <div class="card card-soft p-4 text-center border-0 shadow-sm h-100">
                <div class="mb-3">
                    <i class="bi bi-folder2-open" style="font-size: 2.5rem; color: #5651A0;"></i>
                </div>
                <h5 class="fw-bold">Legajos Existentes</h5>
                <p class="text-muted small">Seguimiento de casos y participación en programas de masculinidad.</p>
                <a href="#" class="btn text-white w-100 mt-auto" style="background: #5651A0;">
                    Ver Listado
                </a>
            </div>
        </div>

        {{-- ESTADISTICAS --}}
        <div class="col-md-4">
            <div class="card card-soft p-4 text-center border-0 shadow-sm h-100">
                <div class="mb-3">
                    <i class="bi bi-graph-up-arrow" style="font-size: 2.5rem; color: #5651A0;"></i>
                </div>
                <h5 class="fw-bold">Estadísticas</h5>
                <p class="text-muted small">Reportes de impacto y evolución del área de masculinidades.</p>
                <a href="#" class="btn btn-outline-secondary w-100 mt-auto">
                    Ver Reportes
                </a>
            </div>
        </div>

        {{-- NUEVO --}}
        <div class="col-md-4">
            <div class="card card-soft p-4 text-center border-0 shadow-sm h-100" style="background: #fdfdfd;">
                <div class="mb-3">
                    <i class="bi bi-person-plus-fill" style="font-size: 2.5rem; color: #198754;"></i>
                </div>
                <h5 class="fw-bold">Nuevo Legajo</h5>
                <p class="text-muted small">Inicie la carga de un nuevo legajo para el programa.</p>
                <a href="#" class="btn btn-success w-100 mt-auto shadow-sm">
                    <i class="bi bi-plus-lg"></i> Crear Legajo
                </a>
            </div>
        </div>
    </div>
</div>
@endsection