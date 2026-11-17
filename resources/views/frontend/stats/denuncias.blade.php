@extends('frontend.layouts.front')

@section('title', 'Estadísticas de Denuncias')

@section('content')
<div class="card card-soft p-3 p-md-4 shadow-sm border-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="mb-0 fs-3" style="color:#5651A0;">
                <i class="bi bi-exclamation-triangle me-2"></i>Estadísticas de Denuncias
            </h2>
            <small class="text-muted">Indicadores filtrados sobre las denuncias registradas</small>
        </div>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm no-print">
            <i class="bi bi-printer me-1"></i> Imprimir
        </button>
    </div>

    <div class="card bg-light border-0 p-3 mb-4 no-print">
        <form method="GET" action="{{ route('stats.denuncias') }}" class="row g-3">
            <div class="col-6 col-md-2">
                <label class="small fw-bold text-muted">Desde</label>
                <input type="date" name="desde" value="{{ $desde }}" class="form-control form-control-sm">
            </div>

            <div class="col-6 col-md-2">
                <label class="small fw-bold text-muted">Hasta</label>
                <input type="date" name="hasta" value="{{ $hasta }}" class="form-control form-control-sm">
            </div>

            <div class="col-12 col-md-2">
                <label class="small fw-bold text-muted">Tipo de violencia</label>
                <select name="tipo_violencia" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach($tiposViolencia as $opcion)
                        <option value="{{ $opcion }}" {{ mb_strtoupper((string) $tipoViolencia, 'UTF-8') === $opcion ? 'selected' : '' }}>
                            {{ $opcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-2">
                <label class="small fw-bold text-muted">Edad</label>
                <select name="rango_edad" class="form-select form-select-sm">
                    <option value="">Todas</option>
                    @foreach($rangosEdad as $clave => $rango)
                        <option value="{{ $clave }}" {{ $rangoEdad === $clave ? 'selected' : '' }}>
                            {{ $rango['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-2">
                <label class="small fw-bold text-muted">Barrio</label>
                <select name="barrio" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach($barrios as $opcion)
                        <option value="{{ $opcion }}" {{ mb_strtoupper((string) $barrio, 'UTF-8') === $opcion ? 'selected' : '' }}>
                            {{ $opcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-2">
                <label class="small fw-bold text-muted">Tipo de amenaza</label>
                <select name="tipo_amenaza" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach($tiposAmenaza as $opcion)
                        <option value="{{ $opcion }}" {{ mb_strtoupper((string) $tipoAmenaza, 'UTF-8') === $opcion ? 'selected' : '' }}>
                            {{ $opcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 d-flex gap-2 justify-content-end">
                <a href="{{ route('stats.denuncias') }}" class="btn btn-light btn-sm border">Limpiar</a>
                <button class="btn btn-primary btn-sm px-4" style="background:#5651A0; border-color:#5651A0;">
                    <i class="bi bi-filter me-1"></i>Aplicar filtros
                </button>
            </div>
        </form>
    </div>

    <div class="card border-0 shadow-sm mb-4 text-center p-4 text-white" style="background:linear-gradient(45deg,#5651A0,#7A74C9);">
        <h6 class="text-uppercase opacity-75 mb-2 small">Total de denuncias</h6>
        <h1 class="fw-bold display-4 mb-0">{{ $totalDenuncias }}</h1>
    </div>

    <div class="row g-4">
        @foreach([
            ['title' => 'Por tipo de violencia', 'items' => $porTipoViolencia, 'icon' => 'bi-shield-exclamation'],
            ['title' => 'Por rango de edad', 'items' => $porEdad, 'icon' => 'bi-person-vcard'],
            ['title' => 'Por barrio', 'items' => $porBarrio, 'icon' => 'bi-geo-alt'],
            ['title' => 'Por tipo de amenaza', 'items' => $porTipoAmenaza, 'icon' => 'bi-exclamation-diamond'],
        ] as $bloque)
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold text-muted text-uppercase small">
                            <i class="{{ $bloque['icon'] }} me-2"></i>{{ $bloque['title'] }}
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="small">Categoría</th>
                                    <th class="small text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bloque['items'] as $item)
                                    <tr>
                                        <td class="small">{{ $item->nombre }}</td>
                                        <td class="text-end fw-bold">{{ $item->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted small py-3">Sin datos para los filtros seleccionados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    @media print {
        .no-print, form { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        body { background: white !important; }
    }
</style>
@endsection
