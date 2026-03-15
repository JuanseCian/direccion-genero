@extends('frontend.layouts.front')

@section('title', 'Reporte Institucional - Masculinidades')

@section('content')

<div class="card card-soft p-3 p-md-4 shadow-sm border-0">

    {{-- ENCABEZADO Y FILTROS RESPONSIVOS --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="mb-0 fs-3" style="color: #5651A0;">
                <i class="bi bi-person-arms-up me-2"></i>Reporte Masculinidades
            </h2>
            <small class="text-muted">
                Datos procesados al {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>

        <div class="d-flex flex-wrap gap-2 no-print">
            <form action="{{ route('stats.masculinidades') }}" method="GET" class="d-flex flex-wrap flex-sm-nowrap gap-2 w-100 w-md-auto">
                <input type="date" name="desde" value="{{ $desde }}" class="form-control form-control-sm">
                <input type="date" name="hasta" value="{{ $hasta }}" class="form-control form-control-sm">
                <button type="submit" class="btn btn-sm text-white w-100 w-sm-auto" style="background-color: #5651A0;">
                    <i class="bi bi-filter"></i> <span class="d-md-none d-lg-inline">Filtrar</span>
                </button>
            </form>
            <div class="d-flex gap-2 w-100 w-md-auto justify-content-center">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm shadow-sm flex-fill">
                    <i class="bi bi-printer"></i>
                </button>
                <a href="{{ route('stats.masculinidades.export',['desde'=>$desde,'hasta'=>$hasta]) }}" 
                   class="btn btn-success btn-sm shadow-sm flex-fill text-nowrap">
                    <i class="bi bi-file-earmark-excel"></i> Excel
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        {{-- COLUMNA IZQUIERDA: KPIs, Gráfico y Zonas --}}
        <div class="col-lg-8">
            
            {{-- TOTAL GENERAL --}}
            <div class="card border-0 shadow-sm mb-4 text-center p-4 text-white rounded-3" style="background: linear-gradient(45deg, #5651A0, #7A74C9);">
                <h6 class="text-uppercase opacity-75 mb-2 small"><i class="bi bi-people-fill me-2"></i>Total General de Casos</h6>
                <h1 class="fw-bold display-4 mb-0">{{ $totalCasos }}</h1>
            </div>

            {{-- KPIs PRINCIPALES (Adaptados: 2x2 en móviles, 4x1 en PC) --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-success">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 0.7rem;">Trabajan</small>
                        <h4 class="fw-bold text-dark mb-0">{{ $trabajan }}</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-danger">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 0.7rem;">Sin Empleo</small>
                        <h4 class="fw-bold text-dark mb-0">{{ $noTrabajan }}</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-warning">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 0.7rem;">Consumo</small>
                        <h4 class="fw-bold text-dark mb-0">{{ $conConsumo }}</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-info">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 0.7rem;">En Terapia</small>
                        <h4 class="fw-bold text-dark mb-0">{{ $conTerapia }}</h4>
                    </div>
                </div>
            </div>

            {{-- GRÁFICO --}}
            <div class="card border-0 shadow-sm p-3 p-md-4 mb-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-3 gap-2">
                    <h6 class="m-0 fw-bold text-muted small text-uppercase">
                        <i class="bi bi-cone-striped me-2"></i>Tipos de Violencia
                    </h6>
                    <div class="btn-group btn-group-sm no-print shadow-sm">
                        <button onclick="cambiarTipo('bar')" class="btn btn-outline-secondary">Barras</button>
                        <button onclick="cambiarTipo('doughnut')" class="btn btn-outline-secondary">Dona</button>
                    </div>
                </div>
                <div style="position: relative; height:320px; width: 100%;">
                    <canvas id="graficoMasculinidades"></canvas>
                </div>
            </div>

            {{-- DETALLE POR BARRIO (Abajo del gráfico en la misma col) --}}
            <div class="mt-4 border-top pt-4">
                <h5 class="fw-bold mb-3" style="color: #5651A0;"><i class="bi bi-map me-2"></i>Detalle por Barrio</h5>
                <div class="accordion shadow-sm" id="accordionZonas">
                    @foreach($zonas as $zona)
                    <div class="accordion-item border-0 mb-2 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#zona{{ $zona->id }}">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i> 
                                <span class="text-truncate" style="max-width: 70%;">{{ $zona->nombre }}</span>
                                <span class="ms-auto badge bg-primary opacity-75 rounded-pill">{{ $zona->total }}</span>
                            </button>
                        </h2>
                        <div id="zona{{ $zona->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionZonas">
                            <div class="accordion-body bg-white p-3">
                                <div class="row g-2">
                                    @foreach($zona->barrios as $barrio)
                                    <div class="col-sm-6">
                                        <div class="d-flex justify-content-between border-bottom py-2 border-bottom-dashed">
                                            <span class="text-muted small"><i class="bi bi-house-door me-1 opacity-50"></i>{{ $barrio->nombre }}</span>
                                            <span class="fw-bold small">{{ $barrio->total_casos }}</span>
                                        </div>
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

        {{-- COLUMNA DERECHA: Listados con espaciado superior en móvil --}}
        <div class="col-lg-4 mt-2 mt-lg-0">
            
            {{-- ESTADO DEL PROGRAMA --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <h6 class="fw-bold border-bottom pb-2 mb-3 small text-uppercase" style="color: #5651A0;">
                        <i class="bi bi-activity me-2"></i>Estado en el Programa
                    </h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span class="small"><i class="bi bi-play-circle text-primary me-2"></i>Activos</span>
                            <span class="badge bg-primary rounded-pill">{{ $asisten }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span class="small"><i class="bi bi-check-circle text-success me-2"></i>Finalizaron</span>
                            <span class="badge bg-success rounded-pill">{{ $finalizaron }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span class="small"><i class="bi bi-x-circle text-muted me-2"></i>Abandono</span>
                            <span class="badge bg-light text-dark border rounded-pill">{{ $abandono }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INDICADORES DE RIESGO --}}
            <div class="card border-0 shadow-sm mb-4 bg-light">
                <div class="card-body p-3">
                    <h6 class="fw-bold text-danger mb-3 small text-uppercase">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Riesgo
                    </h6>
                    <div class="d-flex justify-content-between mb-2 pb-1 border-bottom border-white">
                        <span class="small text-muted">Reincidencias:</span>
                        <span class="fw-bold text-danger">{{ $reincidencias }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-0">
                        <span class="small text-muted">Desobediencias:</span>
                        <span class="fw-bold text-dark">{{ $conDesobediencia }}</span>
                    </div>
                </div>
            </div>

            {{-- TABLAS DE DATOS (Edad, Violencia, etc) --}}
            @php
                $tablas = [
                    ['title' => 'Distribución por Edad', 'icon' => 'calendar3', 'data' => $edades, 'key' => 'rango'],
                    ['title' => 'Tipos de Violencia', 'icon' => 'cone-striped', 'data' => $violencias, 'key' => 'nombre']
                ];
            @endphp

            @foreach($tablas as $tabla)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3 small text-uppercase" style="color: #5651A0;"><i class="bi bi-{{ $tabla['icon'] }} me-2"></i>{{ $tabla['title'] }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <tbody>
                                @foreach($tabla['data'] as $item)
                                <tr>
                                    <td class="small">{{ $item->{$tabla['key']} }}</td>
                                    <td class="text-end fw-bold small text-primary">{{ $item->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- LISTAS SIMPLES (Medidas, Derivaciones, Educación) --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3 small text-uppercase" style="color: #5651A0;"><i class="bi bi-shield-lock me-2"></i>Medidas Cautelares</h6>
                    @foreach($medidas as $m)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted small text-truncate me-2">{{ $m->nombre }}</span>
                        <span class="fw-bold small">{{ $m->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .border-bottom-dashed { border-bottom: 1px dashed #dee2e6 !important; }
    .accordion-button:not(.collapsed) { background-color: #f8f9ff; color: #5651A0; box-shadow: none; }
    .small { font-size: 0.85rem; }
    .text-truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    @media print {
        .no-print, .btn-group, form, .btn-flotante { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .accordion-collapse { display: block !important; }
        .accordion-button::after { display: none !important; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let grafico;
        
        // Cambiamos $casosPorZona por $violencias
        const labels = {!! json_encode($violencias->pluck('nombre')) !!};
        const datos = {!! json_encode($violencias->pluck('total')) !!};
        
        const ctx = document.getElementById('graficoMasculinidades').getContext('2d');

        window.crearGrafico = function(tipo) {
            if(grafico) grafico.destroy();
            grafico = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de Casos',
                        data: datos,
                        backgroundColor: ['#5651A0', '#7A74C9', '#9C97E5', '#C5C2F5', '#3f3a8a', '#BDBCF1'],
                        borderWidth: 0,
                        borderRadius: tipo === 'bar' ? 6 : 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: tipo === 'bar' ? 'y' : 'x', // Opcional: Eje Y para mejor lectura de nombres largos
                    plugins: {
                        legend: { 
                            display: tipo === 'doughnut', 
                            position: 'bottom', 
                            labels: { boxWidth: 12, font: { size: 11 } } 
                        }
                    },
                    scales: tipo === 'bar' ? { 
                        x: { beginAtZero: true, grid: { color: '#f0f0f0' }, ticks: { font: { size: 10 } } },
                        y: { grid: { display: false }, ticks: { font: { size: 10 } } }
                    } : {}
                }
            });
        };

        window.cambiarTipo = function(tipo) { crearGrafico(tipo); };
        crearGrafico('bar');
    });
</script>

@endsection