@extends('frontend.layouts.front')

@section('title', 'Reporte Institucional - IVE')

@section('content')

<div class="card card-soft p-2 p-md-4 shadow-sm border-0">

    {{-- ==========================================
          ENCABEZADO Y ACCIONES
    ========================================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
        <div>
            <h2 class="mb-0 fs-3 fs-md-2" style="color: #5651A0;">
                <i class="bi bi-bar-chart-line me-2"></i>Reporte Estadístico - Área IVE
            </h2>
            <small class="text-muted">
                Emitido el {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>

        <div class="no-print d-flex gap-2">
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-printer"></i> <span class="d-none d-sm-inline">Imprimir</span>
            </button>
            <a href="{{ route('stats.ive.export',['desde'=>$desde,'hasta'=>$hasta]) }}" 
               class="btn btn-success btn-sm shadow-sm">
                <i class="bi bi-file-earmark-excel"></i> <span class="d-none d-sm-inline">Excel</span>
            </a>
        </div>
    </div>

    {{-- ==========================================
          CONTENIDO PRINCIPAL
    ========================================== --}}
    <div class="row g-4">
        
        {{-- ================= COLUMNA IZQUIERDA ================= --}}
        <div class="col-lg-8">
            
            {{-- TOTAL GENERAL --}}
            <div class="card border-0 shadow-sm mb-4 text-center p-4 text-white rounded-3" style="background: linear-gradient(45deg, #5651A0, #7A74C9);">
                <h6 class="text-uppercase opacity-75 mb-2"><i class="bi bi-clipboard2-heart me-2"></i>Total General de Atenciones</h6>
                <h1 class="fw-bold display-3 mb-0">{{ $totalCasos }}</h1>
            </div>

            {{-- KPIs PRINCIPALES --}}
            <div class="row g-2 g-md-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-2 p-md-3 text-center h-100 border-bottom border-3 border-success">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Con Obra Social</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $conObraSocial }}</h3>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-2 p-md-3 text-center h-100 border-bottom border-3 border-danger">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Sin Obra Social</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $sinObraSocial }}</h3>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-2 p-md-3 text-center h-100 border-bottom border-3 border-warning">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Int. Previa</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $conInterrupcionPrevia }}</h3>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-2 p-md-3 text-center h-100 border-bottom border-3 border-info">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Prom. Semanas</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $promedioSemanas }}</h3>
                    </div>
                </div>
            </div>

            {{-- GRÁFICO DE EDADES --}}
            <div class="card border-0 shadow-sm p-3 p-md-4 mb-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-3 gap-2">
                    <h6 class="m-0 fw-bold text-muted"><i class="bi bi-people-fill me-2"></i>Distribución por Edades</h6>
                    <div class="btn-group btn-group-sm no-print">
                        <button onclick="cambiarTipo('bar')" class="btn btn-outline-secondary">Barras</button>
                        <button onclick="cambiarTipo('doughnut')" class="btn btn-outline-secondary">Dona</button>
                    </div>
                </div>
                <div class="chart-container" style="position: relative; height:350px; width:100%;">
                    <canvas id="graficoIveEdad"></canvas>
                </div>
            </div>

            {{-- DETALLE POR BARRIO --}}
            <div class="mt-4 border-top pt-4">
                <h5 class="fw-bold mb-3" style="color: #5651A0;"><i class="bi bi-map me-2"></i>Distribución Geográfica</h5>
                <div class="accordion shadow-sm" id="accordionZonas">
                    @foreach($zonas as $zona)
                    <div class="accordion-item border-0 mb-2 shadow-sm rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold rounded p-3" type="button" data-bs-toggle="collapse" data-bs-target="#zona{{ $zona->id }}">
                                <i class="bi bi-pin-map-fill me-2 text-danger"></i> {{ $zona->nombre }} 
                                <span class="ms-auto me-2 badge bg-primary opacity-75 rounded-pill">{{ $zona->total }}</span>
                            </button>
                        </h2>
                        <div id="zona{{ $zona->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionZonas">
                            <div class="accordion-body bg-white border-top p-2 p-md-3">
                                <div class="row g-2">
                                    @foreach($zona->barrios->chunk(ceil($zona->barrios->count() / 2) ?: 1) as $chunk)
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            @foreach($chunk as $barrio)
                                            <li class="list-group-item d-flex justify-content-between align-items-center px-2 py-2 border-bottom-dashed">
                                                <span class="text-muted small">{{ $barrio->nombre }}</span>
                                                <span class="fw-bold text-dark">{{ $barrio->total_casos }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ================= COLUMNA DERECHA ================= --}}
        <div class="col-lg-4">
            {{-- Usamos un componente de "Card" reutilizable para las tablas laterales --}}
            @php
                $tablasLaterales = [
                    ['titulo' => 'Detalle de Edades', 'icono' => 'bi-list-ol', 'data' => $edades, 'key' => 'rango'],
                    ['titulo' => 'Semanas de Gestación', 'icono' => 'bi-calendar-event', 'data' => $semanas, 'key' => 'rango'],
                    ['titulo' => 'Estado Civil', 'icono' => 'bi-heart', 'data' => $estadosCiviles, 'key' => 'nombre'],
                    ['titulo' => 'Interrupciones Previas', 'icono' => 'bi-arrow-repeat', 'data' => $interrupcionesPrevias, 'key' => 'tipo']
                ];
            @endphp

            @foreach($tablasLaterales as $tabla)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: #5651A0;">
                        <i class="bi {{ $tabla['icono'] }} me-2"></i>{{ $tabla['titulo'] }}
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <tbody>
                                @foreach($tabla['data'] as $item)
                                <tr>
                                    <td class="text-muted border-0 ps-0">{{ $item->{$tabla['key']} }}</td>
                                    <td class="text-end fw-bold border-0 pe-0">{{ $item->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .border-bottom-dashed { border-bottom: 1px dashed #dee2e6; }
    
    .accordion-button:not(.collapsed) {
        background-color: #f8f9ff;
        color: #5651A0;
        box-shadow: none;
    }

    /* Ajustes para pantallas pequeñas */
    @media (max-width: 576px) {
        .display-3 { font-size: 2.5rem; }
        .card-soft { border-radius: 0; }
    }

    @media print {
        .no-print, .btn-group, .accordion-button::after { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #eee !important; }
        .accordion-collapse { display: block !important; height: auto !important; visibility: visible !important; }
        .accordion-button { background-color: #f8f9ff !important; color: #000 !important; }
        body { background-color: #fff !important; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let grafico;
        const labels = {!! json_encode($edades->pluck('rango')) !!};
        const datos = {!! json_encode($edades->pluck('total')) !!};
        const ctx = document.getElementById('graficoIveEdad').getContext('2d');

        window.crearGrafico = function(tipo) {
            if(grafico) grafico.destroy();

            grafico = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pacientes',
                        data: datos,
                        backgroundColor: ['#5651A0', '#7A74C9', '#9C97E5', '#C5C2F5', '#BDBCF1', '#3f3a8a'],
                        borderWidth: 0,
                        borderRadius: tipo === 'bar' ? 6 : 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: tipo === 'doughnut',
                            position: 'bottom',
                            labels: { boxWidth: 12, font: { size: 11 } }
                        }
                    },
                    scales: tipo === 'bar' ? { 
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } } 
                    } : {}
                }
            });
        };

        window.cambiarTipo = function(tipo) { crearGrafico(tipo); };
        crearGrafico('bar');
    });
</script>
@endsection