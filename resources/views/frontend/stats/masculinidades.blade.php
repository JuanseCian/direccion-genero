@extends('frontend.layouts.front')

@section('title','Reporte Institucional - Masculinidades')

@section('content')

<div class="card card-soft p-4 shadow-sm border-0">

    {{-- ENCABEZADO Y FILTROS --}}
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h2 class="mb-0" style="color: #5651A0;">
                <i class="bi bi-person-arms-up"></i>
                Reporte Estadístico - Masculinidades
            </h2>
            <small class="text-muted">
                Datos procesados al {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>

        <div class="d-flex gap-2 no-print">
            <form action="{{ route('stats.masculinidades') }}" method="GET" class="d-flex gap-2">
                <input type="date" name="desde" value="{{ $desde }}" class="form-control form-control-sm">
                <input type="date" name="hasta" value="{{ $hasta }}" class="form-control form-control-sm">
                <button type="submit" class="btn btn-sm btn-primary" style="background-color: #5651A0;">
                    <i class="bi bi-filter"></i> Filtrar
                </button>
            </form>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-printer"></i> Imprimir
            </button>
        </div>
    </div>

    <div class="row g-4">
        {{-- COLUMNA IZQUIERDA: KPIs y Edades --}}
        <div class="col-lg-8">
            {{-- TOTAL GENERAL --}}
            <div class="card border-0 shadow-sm mb-4 text-center p-4 text-white" style="background: linear-gradient(45deg, #5651A0, #7A74C9);">
                <h6 class="text-uppercase opacity-75 mb-2">Total General de Casos</h6>
                <h1 class="fw-bold display-3 mb-0">{{ $totalCasos }}</h1>
            </div>

            {{-- KPIs PRINCIPALES --}}
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-success">
                        <small class="text-muted text-uppercase fw-bold">Trabajan</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $trabajan }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-danger">
                        <small class="text-muted text-uppercase fw-bold">Sin Empleo</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $noTrabajan }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-warning">
                        <small class="text-muted text-uppercase fw-bold">Consumo</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $conConsumo }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 border-bottom border-3 border-info">
                        <small class="text-muted text-uppercase fw-bold">En Terapia</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $conTerapia }}</h3>
                    </div>
                </div>
            </div>

            {{-- GRÁFICO --}}
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="m-0 fw-bold text-muted">Distribución Geográfica</h6>
                    <div class="btn-group btn-group-sm no-print">
                        <button onclick="cambiarTipo('bar')" class="btn btn-outline-secondary">Barras</button>
                        <button onclick="cambiarTipo('doughnut')" class="btn btn-outline-secondary">Dona</button>
                    </div>
                </div>
                <div style="height:350px;">
                    <canvas id="graficoMasculinidades"></canvas>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Estados y Listados --}}
        <div class="col-lg-4">
            
            {{-- ESTADO DEL PROGRAMA --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Estado en el Programa</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="bi bi-play-circle text-primary me-2"></i>Asisten actualmente</span>
                            <span class="badge bg-primary rounded-pill">{{ $asisten }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="bi bi-check-circle text-success me-2"></i>Finalizaron</span>
                            <span class="badge bg-success rounded-pill">{{ $finalizaron }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="bi bi-x-circle text-muted me-2"></i>Abandono / Sin inicio</span>
                            <span class="badge bg-light text-dark border rounded-pill">{{ $abandono }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIESGO Y JUDICIAL --}}
            <div class="card border-0 shadow-sm mb-4 bg-light">
                <div class="card-body">
                    <h6 class="fw-bold text-danger mb-3"><i class="bi bi-exclamation-triangle me-2"></i>Indicadores de Riesgo</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Reincidencias:</span>
                        <span class="fw-bold text-danger">{{ $reincidencias }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Desobediencias:</span>
                        <span class="fw-bold">{{ $conDesobediencia }}</span>
                    </div>
                </div>
            </div>

            {{-- RANGOS DE EDAD --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Distribución por Edad</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Rango</th>
                                    <th class="text-end">Cant.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($edades as $edad)
                                <tr>
                                    <td>{{ $edad->rango }}</td>
                                    <td class="text-end fw-bold">{{ $edad->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ACCORDION ZONAS (Ocupa todo el ancho abajo) --}}
    <h5 class="fw-bold mt-2 mb-3" style="color: #5651A0;">Detalle por Barrio</h5>
    <div class="accordion shadow-sm" id="accordionZonas">
        @foreach($zonas as $zona)
        <div class="accordion-item border-0 mb-2 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#zona{{ $zona->id }}">
                    <i class="bi bi-geo-alt me-2"></i> {{ $zona->nombre }} 
                    <span class="ms-auto me-3 badge bg-primary opacity-75">{{ $zona->total }} casos</span>
                </button>
            </h2>
            <div id="zona{{ $zona->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionZonas">
                <div class="accordion-body bg-white">
                    <div class="row">
                        @foreach($zona->barrios->chunk(count($zona->barrios) > 5 ? ceil(count($zona->barrios)/2) : 10) as $chunk)
                        <div class="col-md-6">
                            @foreach($chunk as $barrio)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="text-muted">{{ $barrio->nombre }}</span>
                                <span class="fw-bold">{{ $barrio->total_casos }}</span>
                            </div>
                            @endforeach
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
    @media print {
        .no-print, .btn-group, form { display: none !important; }
        .card { shadow: none !important; border: 1px solid #eee !important; }
        body { background: white !important; }
        .accordion-collapse { display: block !important; } /* Para que se vean los barrios al imprimir */
    }
    .accordion-button:not(.collapsed) {
        background-color: #f8f9ff;
        color: #5651A0;
    }
</style>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let grafico;
const labels = {!! json_encode($casosPorZona->pluck('nombre')) !!};
const datos = {!! json_encode($casosPorZona->pluck('total')) !!};
const ctx = document.getElementById('graficoMasculinidades').getContext('2d');

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
                    position:'bottom'
                }
            },
            scales: tipo === 'bar' ? { y: { beginAtZero: true } } : {}
        }
    });
}

function cambiarTipo(tipo){
    crearGrafico(tipo);
}

crearGrafico('bar');
</script>

@endsection