@extends('frontend.layouts.front')

@section('title','Reporte Institucional - Área Género')

@section('content')

<div class="card card-soft p-4 shadow-sm border-0">

    {{-- ENCABEZADO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" style="color: #5651A0;">
                <i class="bi bi-graph-up-arrow"></i>
                Reporte Estadístico - Área Género
            </h2>
            <small class="text-muted">
                Emitido el {{ now()->format('d/m/Y') }}
            </small>
        </div>

        <button onclick="window.print()" class="btn btn-light border shadow-sm">
            <i class="bi bi-printer"></i> Imprimir
        </button>
    </div>

    {{-- FILTRO PERIODO --}}
    <div class="p-3 rounded mb-4" style="background: #f8f9fa;">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="fw-bold">Desde</label>
                <input type="date" name="desde" value="{{ $desde }}" class="form-control border-0 shadow-sm">
            </div>
            <div class="col-md-4">
                <label class="fw-bold">Hasta</label>
                <input type="date" name="hasta" value="{{ $hasta }}" class="form-control border-0 shadow-sm">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn text-white w-100 shadow-sm" style="background:#5651A0;">
                    Aplicar Filtro
                </button>
            </div>
        </form>
    </div>
    <div class="card border-0 shadow-sm mb-4 text-center p-4" style="background:#5651A0;">
        <h6 class="text-white mb-2">TOTAL DE CASOS REGISTRADOS DEL ÁREA DE GÉNERO</h6>
        <h1 class="fw-bold text-white display-4 mb-0">
            {{ $totalCasos }}
        </h1>
    </div>

    {{-- KPI PRINCIPALES --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Total Casos</h6>
                <h2 class="fw-bold" style="color:#5651A0;">
                    {{ $totalCasos }}
                </h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Con Trabajo</h6>
                <h2 class="fw-bold text-success">
                    {{ $trabajan }}
                </h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Sin Trabajo</h6>
                <h2 class="fw-bold text-danger">
                    {{ $noTrabajan }}
                </h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Vinculados Masculinidades</h6>
                <h2 class="fw-bold text-secondary">
                    {{ $vinculadosMasculinidades }}
                </h2>
            </div>
        </div>

    </div>

    {{-- SECCIÓN ZONAS CON ACCORDION --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="accordion" id="accordionZonas">
                @foreach($zonas as $zona)
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="heading{{ $zona->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $zona->id }}">
                                {{ $zona->nombre }} - Total Casos: {{ $zona->total }}
                            </button>
                        </h2>
                        <div id="collapse{{ $zona->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionZonas">
                            <div class="accordion-body">
                                @foreach($zona->barrios as $barrio)
                                    <div class="d-flex justify-content-between border-bottom py-1">
                                        <span>{{ $barrio->nombre }}</span>
                                        <span class="badge bg-secondary">{{ $barrio->direccion_genero_casos_count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- GRÁFICO --}}
    <div class="card border-0 shadow-sm p-4 text-center mt-4">
        <div style="max-width: 700px; margin:auto; height:400px;">
            <canvas id="graficoZona"></canvas>
        </div>
    </div>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let tipoActual = 'bar';
    let grafico;

    const labels = {!! json_encode($casosPorZona->pluck('nombre')) !!};
    const datos = {!! json_encode($casosPorZona->pluck('total')) !!};

    const ctx = document.getElementById('graficoZona').getContext('2d');

    function crearGrafico(tipo) {
        if (grafico) grafico.destroy();

        grafico = new Chart(ctx, {
            type: tipo,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Casos por Zona',
                    data: datos,
                    backgroundColor: [
                        '#5651A0','#7A74C9','#9C97E5','#C5C2F5','#3f3a8a'
                    ],
                    borderWidth: 1
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
                }
            }
        });
    }

    function cambiarTipo(tipo) {
        tipoActual = tipo;
        crearGrafico(tipoActual);
    }

    // Inicializar
    crearGrafico(tipoActual);
</script>

{{-- BOTONES DE TIPO --}}
<div class="d-flex justify-content-center mt-2 gap-2">
    <button class="btn btn-sm btn-outline-secondary" onclick="cambiarTipo('bar')">Histograma</button>
    <button class="btn btn-sm btn-outline-secondary" onclick="cambiarTipo('doughnut')">Donut</button>
</div>

@endsection