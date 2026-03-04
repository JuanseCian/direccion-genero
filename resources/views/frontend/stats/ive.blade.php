@extends('frontend.layouts.front')

@section('title','Reporte Institucional - IVE')

@section('content')

<div class="card card-soft p-4 shadow-sm border-0">

    {{-- ENCABEZADO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" style="color: #5651A0;">
                <i class="bi bi-bar-chart-line"></i>
                Reporte Estadístico - Área IVE
            </h2>
            <small class="text-muted">
                Emitido el {{ now()->format('d/m/Y') }}
            </small>
        </div>

        <button onclick="window.print()" class="btn btn-light border shadow-sm">
            <i class="bi bi-printer"></i> Imprimir
        </button>
    </div>

    {{-- TOTAL GENERAL --}}
    <div class="card border-0 shadow-sm mb-4 text-center p-4" style="background:#5651A0;">
        <h6 class="text-white mb-2">TOTAL GENERAL DE ATENCIONES</h6>
        <h1 class="fw-bold text-white display-4 mb-0">
            {{ $totalCasos }}
        </h1>
    </div>

    {{-- KPIs --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Con Obra Social</h6>
                <h2 class="fw-bold text-success">{{ $conObraSocial }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Sin Obra Social</h6>
                <h2 class="fw-bold text-danger">{{ $sinObraSocial }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Interrupción Previa</h6>
                <h2 class="fw-bold text-warning">{{ $conInterrupcionPrevia }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Promedio Semanas (ECO)</h6>
                <h2 class="fw-bold text-secondary">{{ $promedioSemanas }}</h2>
            </div>
        </div>

    </div>

    {{-- ACCORDION ZONAS --}}
    <div class="accordion mb-4" id="accordionZonas">
        @foreach($zonas as $zona)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#zona{{ $zona->id }}">
                    {{ $zona->nombre }} - Total: {{ $zona->total }}
                </button>
            </h2>
            <div id="zona{{ $zona->id }}"
                 class="accordion-collapse collapse"
                 data-bs-parent="#accordionZonas">
                <div class="accordion-body">
                    @foreach($zona->barrios as $barrio)
                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span>{{ $barrio->nombre }}</span>
                            <span class="badge bg-secondary">
                                {{ $barrio->total_casos }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- GRÁFICO --}}
    <div class="card border-0 shadow-sm p-4 text-center">
        <div style="max-width: 700px; margin:auto; height:400px;">
            <canvas id="graficoIve"></canvas>
        </div>

        <div class="d-flex justify-content-center mt-3 gap-2">
            <button class="btn btn-sm btn-outline-secondary" onclick="cambiarTipo('bar')">Histograma</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="cambiarTipo('doughnut')">Donut</button>
        </div>
    </div>

</div>

{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

let tipoActual = 'bar';
let grafico;

const labels = {!! json_encode($casosPorZona->pluck('nombre')) !!};
const datos = {!! json_encode($casosPorZona->pluck('total')) !!};

const ctx = document.getElementById('graficoIve').getContext('2d');

function crearGrafico(tipo){
    if(grafico) grafico.destroy();

    grafico = new Chart(ctx,{
        type: tipo,
        data:{
            labels: labels,
            datasets:[{
                label:'Atenciones por Zona',
                data: datos,
                backgroundColor:[
                    '#5651A0','#7A74C9','#9C97E5','#C5C2F5','#3f3a8a'
                ]
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
            }
        }
    });
}

function cambiarTipo(tipo){
    tipoActual = tipo;
    crearGrafico(tipoActual);
}

crearGrafico(tipoActual);

</script>

@endsection