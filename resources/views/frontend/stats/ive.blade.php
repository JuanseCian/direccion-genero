@extends('frontend.layouts.front')

@section('title', 'Reporte Institucional - IVE')

@section('content')

<div class="card card-soft p-4 shadow-sm border-0">

    {{-- ==========================================
          ENCABEZADO Y ACCIONES
    ========================================== --}}
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h2 class="mb-0" style="color: #5651A0;">
                <i class="bi bi-bar-chart-line me-2"></i>Reporte Estadístico - Área IVE
            </h2>
            <small class="text-muted">
                Emitido el {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>

        <div class="no-print">
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-printer"></i> Imprimir Reporte
            </button>
        </div>
    </div>

    {{-- ==========================================
          CONTENIDO PRINCIPAL
    ========================================== --}}
    <div class="row g-4">
        
        {{-- ================= COLUMNA IZQUIERDA (Gráfico Principal y KPIs) ================= --}}
        <div class="col-lg-8">
            
            {{-- TOTAL GENERAL --}}
            <div class="card border-0 shadow-sm mb-4 text-center p-4 text-white rounded-3" style="background: linear-gradient(45deg, #5651A0, #7A74C9);">
                <h6 class="text-uppercase opacity-75 mb-2"><i class="bi bi-clipboard2-heart me-2"></i>Total General de Atenciones</h6>
                <h1 class="fw-bold display-3 mb-0">{{ $totalCasos }}</h1>
            </div>

            {{-- KPIs PRINCIPALES --}}
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-success">
                        <small class="text-muted text-uppercase fw-bold">Con Obra Social</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $conObraSocial }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-danger">
                        <small class="text-muted text-uppercase fw-bold">Sin Obra Social</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $sinObraSocial }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-warning">
                        <small class="text-muted text-uppercase fw-bold">Int. Previa</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $conInterrupcionPrevia }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-info">
                        <small class="text-muted text-uppercase fw-bold">Prom. Semanas</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $promedioSemanas }}</h3>
                    </div>
                </div>
            </div>

            {{-- GRÁFICO DE EDADES --}}
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="m-0 fw-bold text-muted"><i class="bi bi-people-fill me-2"></i>Distribución por Rangos de Edad</h6>
                    <div class="btn-group btn-group-sm no-print">
                        <button onclick="cambiarTipo('bar')" class="btn btn-outline-secondary">Barras</button>
                        <button onclick="cambiarTipo('doughnut')" class="btn btn-outline-secondary">Dona</button>
                    </div>
                </div>
                <div style="height:350px;">
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
                            <button class="accordion-button collapsed fw-bold rounded" type="button" data-bs-toggle="collapse" data-bs-target="#zona{{ $zona->id }}">
                                <i class="bi bi-pin-map-fill me-2 text-danger"></i> {{ $zona->nombre }} 
                                <span class="ms-auto me-3 badge bg-primary opacity-75 rounded-pill">{{ $zona->total }} casos</span>
                            </button>
                        </h2>
                        <div id="zona{{ $zona->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionZonas">
                            <div class="accordion-body bg-white border-top">
                                <div class="row g-3">
                                    @foreach($zona->barrios->chunk(10) as $chunk)
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            @foreach($chunk as $barrio)
                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom-dashed">
                                                <span class="text-muted">{{ $barrio->nombre }}</span>
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
            
            {{-- TABLA DE EDADES (Complemento del gráfico) --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: #5651A0;"><i class="bi bi-list-ol me-2"></i>Detalle de Edades</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-muted">Rango</th>
                                    <th class="text-end text-muted">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($edades as $e)
                                <tr>
                                    <td>{{ $e->rango }}</td>
                                    <td class="text-end fw-bold">{{ $e->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- SEMANAS DE GESTACIÓN --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: #5651A0;"><i class="bi bi-calendar-event me-2"></i>Semanas de Gestación</h6>
                    @foreach($semanas as $s)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted">{{ $s->rango }}</span>
                        <span class="fw-bold">{{ $s->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- ESTADO CIVIL --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: #5651A0;"><i class="bi bi-heart me-2"></i>Estado Civil</h6>
                    @foreach($estadosCiviles as $ec)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted">{{ $ec->nombre }}</span>
                        <span class="fw-bold">{{ $ec->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- INTERRUPCIONES PREVIAS --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: #5651A0;"><i class="bi bi-arrow-repeat me-2"></i>Interrupciones Previas</h6>
                    @foreach($interrupcionesPrevias as $i)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted">{{ $i->tipo }}</span>
                        <span class="fw-bold">{{ $i->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

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
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(86, 81, 160, 0.2);
    }

    @media print {
        .no-print, .btn-group { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #eee !important; }
        .accordion-collapse { display: block !important; }
        .accordion-button::after { display: none !important; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let grafico;
        // Ahora usamos $edades para los datos del gráfico
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
                        label: 'Pacientes por Edad',
                        data: datos,
                        backgroundColor: [
                            '#5651A0', // Principal
                            '#7A74C9', 
                            '#9C97E5', 
                            '#C5C2F5', 
                            '#BDBCF1', 
                            '#3f3a8a'
                        ],
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
                            position: 'bottom'
                        }
                    },
                    scales: tipo === 'bar' ? { 
                        y: { 
                            beginAtZero: true, 
                            grid: { color: '#f0f0f0' },
                            ticks: { precision: 0 } 
                        },
                        x: { grid: { display: false } } 
                    } : {}
                }
            });
        };

        window.cambiarTipo = function(tipo) {
            crearGrafico(tipo);
        };

        crearGrafico('bar');
    });
</script>

@endsection