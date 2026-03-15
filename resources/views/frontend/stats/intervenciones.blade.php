@extends('frontend.layouts.front')

@section('title','Reporte de Intervenciones')

@section('content')

<div class="card card-soft p-2 p-md-4 shadow-sm border-0">
    
    {{-- ENCABEZADO --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h2 style="color:#5651A0;" class="mb-0 fs-3">
            <i class="bi bi-activity"></i>
            Reporte de Intervenciones
        </h2>

        <div class="d-flex gap-2 w-100 w-md-auto no-print">
            <button onclick="window.print()" class="btn btn-light border btn-sm flex-fill">
                <i class="bi bi-printer"></i> <span class="d-none d-sm-inline">Imprimir</span>
            </button>

            <a href="{{ route('stats.intervenciones.export',['desde'=>$desde,'hasta'=>$hasta]) }}" 
               class="btn btn-success btn-sm flex-fill">
                <i class="bi bi-file-earmark-excel"></i> <span class="d-none d-sm-inline">Excel</span>
            </a>
        </div>
    </div>

    {{-- FILTRO --}}
    <div class="card bg-light border-0 p-3 mb-4 no-print">
        <form method="GET" class="row g-3">
            <div class="col-6 col-md-4">
                <label class="small fw-bold text-muted">Desde</label>
                <input type="date" name="desde" value="{{ $desde }}" class="form-control form-control-sm">
            </div>

            <div class="col-6 col-md-4">
                <label class="small fw-bold text-muted">Hasta</label>
                <input type="date" name="hasta" value="{{ $hasta }}" class="form-control form-control-sm">
            </div>

            <div class="col-12 col-md-4 d-flex align-items-end">
                <button class="btn text-white w-100 btn-sm shadow-sm" style="background:#5651A0;">
                    <i class="bi bi-filter"></i> Aplicar filtro
                </button>
            </div>
        </form>
    </div>

    {{-- TOTAL KPI --}}
    <div class="card border-0 shadow-sm mb-4 text-center p-4 text-white rounded-3" style="background: linear-gradient(45deg, #5651A0, #7A74C9);">
        <h6 class="text-uppercase opacity-75 mb-2 small">Total de Intervenciones</h6>
        <h1 class="display-4 fw-bold mb-0">{{ $totalIntervenciones }}</h1>
    </div>

    {{-- POR AREA (Grid Responsivo) --}}
    <div class="row g-3 mb-4">
        @foreach($porArea as $area)
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted small text-uppercase mb-2">
                    {{ $area->area }}
                </h6>
                <h3 class="fw-bold mb-0" style="color:#5651A0;">
                    {{ $area->total }}
                </h3>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4">
        {{-- TABLA POR TIPO --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <strong class="text-muted"><i class="bi bi-list-check me-2"></i>Por Tipo</strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small">Tipo</th>
                                <th class="text-end small">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($porTipo as $tipo)
                            <tr>
                                <td class="small">{{ $tipo->nombre }}</td>
                                <td class="text-end fw-bold">{{ $tipo->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- GRAFICO --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-3 p-md-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="m-0 fw-bold text-muted">Visualización</h6>
                    <div class="btn-group btn-group-sm no-print">
                        <button class="btn btn-outline-secondary" onclick="cambiarTipo('bar')">Barras</button>
                        <button class="btn btn-outline-secondary" onclick="cambiarTipo('doughnut')">Dona</button>
                    </div>
                </div>
                <div class="chart-container" style="position: relative; height:300px; width:100%;">
                    <canvas id="graficoIntervenciones"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 576px) {
        .display-4 { font-size: 2.5rem; }
    }

    @media print {
        .no-print { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #eee !important; }
        body { background-color: white !important; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let grafico;
    const labels = {!! json_encode($porTipo->pluck('nombre')) !!};
    const datos = {!! json_encode($porTipo->pluck('total')) !!};
    const ctx = document.getElementById('graficoIntervenciones').getContext('2d');

    function crearGrafico(tipo){
        if(grafico){ grafico.destroy(); }

        grafico = new Chart(ctx, {
            type: tipo,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Intervenciones',
                    data: datos,
                    backgroundColor: [
                        '#5651A0', '#7A74C9', '#9C97E5', '#C5C2F5', '#3f3a8a', '#BDBCF1'
                    ],
                    borderWidth: 0,
                    borderRadius: tipo === 'bar' ? 4 : 0
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
    }

    function cambiarTipo(tipo){ crearGrafico(tipo); }
    crearGrafico('bar');
</script>

@endsection