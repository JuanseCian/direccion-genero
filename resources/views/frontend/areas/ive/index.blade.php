@extends('frontend.layouts.front')

@section('title','Área IVE')

@section('content')
<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-hospital"></i>
            Área IVE 
        </h2>
        <span class="badge rounded-pill px-3 py-2" style="background: #ecebfa; color: #5651A0;">
            Atención y Consejería
        </span>
    </div>

    <hr class="my-4" style="opacity: 0.1;">

    <div class="row g-4">
        {{-- LISTADO --}}
        <div class="col-md-4">
            <div class="card card-soft p-4 text-center border-0 shadow-sm h-100">
                <div class="mb-3">
                    <i class="bi bi-file-medical" style="font-size: 2.5rem; color: #5651A0;"></i>
                </div>
                <h5 class="fw-bold">Registro Histórico</h5>
                <p class="text-muted small">Acceda al listado de atenciones y acompañamientos realizados.</p>
                <a href="#" class="btn text-white w-100 mt-auto" style="background: #5651A0;">
                    Ver Listado
                </a>
            </div>
        </div>

        {{-- ESTADISTICAS --}}
        <div class="col-md-4">
            <div class="card card-soft p-4 text-center border-0 shadow-sm h-100">
                <div class="mb-3">
                    <i class="bi bi-pie-chart" style="font-size: 2.5rem; color: #5651A0;"></i>
                </div>
                <h5 class="fw-bold">Estadísticas IVE</h5>
                <p class="text-muted small">Análisis de solicitudes, edades y zonas de residencia.</p>
                <a href="#" class="btn btn-outline-secondary w-100 mt-auto">
                    Ver Reportes
                </a>
            </div>
        </div>

        {{-- NUEVO --}}
        <div class="col-md-4">
            <div class="card card-soft p-4 text-center border-0 shadow-sm h-100" style="background: #fdfdfd;">
                <div class="mb-3">
                    <i class="bi bi-clipboard2-plus" style="font-size: 2.5rem; color: #198754;"></i>
                </div>
                <h5 class="fw-bold">Nueva Atención</h5>
                <p class="text-muted small">Registrar una nueva solicitud o consulta de interrupción.</p>
                <a href="#" class="btn btn-success w-100 mt-auto shadow-sm">
                    <i class="bi bi-plus-lg"></i> Iniciar Registro
                </a>
            </div>
        </div>
    </div>
</div>
@endsection