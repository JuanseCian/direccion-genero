@extends('frontend.layouts.front')

@section('title','Reporte Institucional - Área Género')

@section('content')

<div class="card card-soft p-3 p-md-4 shadow-sm border-0">

    {{-- ENCABEZADO Y FILTROS RESPONSIVOS --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="mb-0 fs-3" style="color: #5651A0;">
                <i class="bi bi-graph-up-arrow"></i>
                Reporte Estadístico
            </h2>
            <small class="text-muted">
                Datos procesados al {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>

        <div class="d-flex flex-wrap gap-2 no-print">
            <form action="{{ route('stats.genero') }}" method="GET" class="d-flex flex-wrap flex-sm-nowrap gap-2 w-100 w-md-auto">
                <input type="date" name="desde" value="{{ $desde }}" class="form-control form-control-sm">
                <input type="date" name="hasta" value="{{ $hasta }}" class="form-control form-control-sm">
                <button type="submit" class="btn btn-sm btn-primary w-100 w-sm-auto" style="background-color: #5651A0;">
                    <i class="bi bi-filter"></i> <span class="d-md-none d-lg-inline">Filtrar</span>
                </button>
            </form>
            <div class="d-flex gap-2 w-100 w-md-auto justify-content-center">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm shadow-sm flex-fill">
                    <i class="bi bi-printer"></i>
                </button>
                <a href="{{ route('stats.genero.export',['desde'=>$desde,'hasta'=>$hasta]) }}" 
                   class="btn btn-success btn-sm shadow-sm flex-fill text-nowrap">
                    <i class="bi bi-file-earmark-excel"></i> Excel
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- COLUMNA IZQUIERDA: KPIs y Gráfico --}}
        <div class="col-lg-8">
            {{-- TOTAL GENERAL --}}
            <div class="card border-0 shadow-sm mb-4 text-center p-4 text-white" style="background: linear-gradient(45deg, #5651A0, #7A74C9);">
                <h6 class="text-uppercase opacity-75 mb-2 small">Total de Casos Área Género</h6>
                <h1 class="fw-bold display-4 mb-0">{{ $totalCasos }}</h1>
            </div>

            {{-- KPIs PRINCIPALES - Mejorado para tablets --}}
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-md-4">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-success">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Con Trabajo</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $trabajan }}</h3>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-danger">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Sin Trabajo</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $noTrabajan }}</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-info">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Vinculados Masc.</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $vinculadosMasculinidades }}</h3>
                    </div>
                </div>
            </div>

            {{-- GRÁFICO --}}
            <div class="card border-0 shadow-sm p-3 p-md-4 mb-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-3 gap-2">
                    <h6 class="m-0 fw-bold text-muted small text-uppercase">Distribución Geográfica</h6>
                    <div class="btn-group btn-group-sm no-print shadow-sm">
                        <button onclick="cambiarTipo('bar')" class="btn btn-outline-secondary">Barras</button>
                        <button onclick="cambiarTipo('doughnut')" class="btn btn-outline-secondary">Dona</button>
                    </div>
                </div>
                <div style="position: relative; height:300px; width: 100%;">
                    <canvas id="graficoZona"></canvas>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Listados con margen superior en móvil --}}
        <div class="col-lg-4 mt-lg-0">
            
            {{-- TIPOS DE VIOLENCIA --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold border-bottom pb-2 mb-3 small text-uppercase">Tipos de Violencia</h6>
                    <div class="list-group list-group-flush">
                        @foreach($violencias as $v)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span class="small text-truncate me-2">{{ $v->nombre }}</span>
                            <span class="badge bg-danger rounded-pill">{{ $v->total }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- MEDIDAS CAUTELARES --}}
            <div class="card border-0 shadow-sm mb-4 bg-light">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 small text-uppercase"><i class="bi bi-shield-check me-2"></i>Medidas Cautelares</h6>
                    @foreach($medidas as $m)
                    <div class="d-flex justify-content-between mb-2 border-bottom border-white pb-1">
                        <span class="small">{{ $m->nombre }}:</span>
                        <span class="fw-bold text-primary small">{{ $m->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RANGOS DE EDAD --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3 small text-uppercase text-muted">Distribución por Edad</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="small py-2">Rango</th>
                                    <th class="text-end small py-2">Cant.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($edades as $edad)
                                <tr>
                                    <td class="small">{{ $edad->rango }} años</td>
                                    <td class="text-end fw-bold small">{{ $edad->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ACORDEÓN ZONAS --}}
    <h5 class="fw-bold mt-4 mb-3" style="color: #5651A0;">Detalle por Barrio</h5>
    <div class="accordion shadow-sm" id="accordionZonas">
        @foreach($zonas as $zona)
        <div class="accordion-item border-0 mb-2 shadow-sm rounded overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#zona{{ $zona->id }}">
                    <i class="bi bi-geo-alt me-2"></i> 
                    <span class="text-truncate" style="max-width: 70%;">{{ $zona->nombre }}</span>
                    <span class="ms-auto badge bg-primary opacity-75 small">{{ $zona->total }}</span>
                </button>
            </h2>
            <div id="zona{{ $zona->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionZonas">
                <div class="accordion-body bg-white p-3">
                    <div class="row g-2">
                        @foreach($zona->barrios as $barrio)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="d-flex justify-content-between border-bottom py-1">
                                <span class="text-muted" style="font-size: 0.75rem;">{{ $barrio->nombre }}</span>
                                <span class="fw-bold small ms-2">{{ $barrio->direccion_genero_casos_count }}</span>
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

<style>
    /* Ajustes para Impresión */
    @media print {
        .no-print, .btn-group, form, .btn-flotante { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        body { background: white !important; }
        .accordion-collapse { display: block !important; }
        .accordion-button::after { display: none !important; }
    }

    /* Ajustes de Acordeón */
    .accordion-button:not(.collapsed) {
        background-color: #f8f9ff;
        color: #5651A0;
        box-shadow: none;
    }
    
    .accordion-button::after {
        background-size: 0.8rem;
    }

    /* Utilidades */
    .small { font-size: 0.85rem; }
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let grafico;
const labels = {!! json_encode($casosPorZona->pluck('nombre')) !!};
const datos = {!! json_encode($casosPorZona->pluck('total')) !!};
const ctx = document.getElementById('graficoZona').getContext('2d');

function crearGrafico(tipo){
    if(grafico) grafico.destroy();

    grafico = new Chart(ctx,{
        type: tipo,
        data:{
            labels: labels,
            datasets:[{
                label:'Casos por Zona',
                data: datos,
                backgroundColor: ['#5651A0','#7A74C9','#9C97E5','#C5C2F5','#3f3a8a','#BDBCF1'],
                borderWidth: 0
            }]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false,
            plugins:{
                legend:{
                    display: tipo === 'doughnut',
                    position:'bottom',
                    labels: { boxWidth: 12, font: { size: 10 } }
                }
            },
            scales: tipo === 'bar' ? { 
                y: { beginAtZero: true, ticks: { font: { size: 10 } } },
                x: { ticks: { font: { size: 10 } } }
            } : {}
        }
    });
}

function cambiarTipo(tipo){
    crearGrafico(tipo);
}

crearGrafico('bar');
</script>

@endsection