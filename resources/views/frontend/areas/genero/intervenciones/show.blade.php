@extends('frontend.layouts.front')

@section('title', 'Detalle de Intervención')

@section('content')

<div class="container py-4" id="intervencion-detalle">

    {{-- ENCABEZADO --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge rounded-pill px-3 py-2"
                      style="background:#e8f5ee; color:#198754;">
                    <i class="bi bi-clipboard2-pulse me-1"></i>
                    Intervención #{{ $intervencion->id }}
                </span>
            </div>

            <h2 class="fw-bold mb-1" style="color:#5651A0;">
                Detalle de la intervención
            </h2>

            <p class="text-muted mb-0">
                Caso #{{ $caso->id }} —
                {{ $caso->persona->apellido }},
                {{ $caso->persona->nombre }}
            </p>
        </div>

        <div class="d-flex flex-wrap gap-2 d-print-none" data-ocultar-en-modal>

            <button type="button"
                    class="btn btn-outline-secondary"
                    onclick="window.print()">
                <i class="bi bi-printer me-1"></i>
                Imprimir
            </button>

            <a href="{{ route('genero.intervenciones.edit', $intervencion->id) }}"
            class="btn btn-outline-primary">
                <i class="bi bi-pencil-square me-1"></i>
                Editar
            </a>

            <a href="{{ route('genero.edit', $caso->id) }}"
            class="btn text-white"
            style="background:#5651A0;">
                <i class="bi bi-arrow-left me-1"></i>
                Volver al caso
            </a>

        </div>

    </div>

    <div class="row g-4">

        {{-- INFORMACIÓN PRINCIPAL --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
                    <h5 class="fw-bold mb-0 text-success">
                        <i class="bi bi-file-text me-2"></i>
                        Información de la intervención
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">

                    <div class="row g-4 mb-4">

                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-label">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Fecha
                                </span>

                                <div class="info-value">
                                    {{ $intervencion->fecha_intervencion
                                        ? \Carbon\Carbon::parse($intervencion->fecha_intervencion)->format('d/m/Y')
                                        : 'Sin fecha registrada'
                                    }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-label">
                                    <i class="bi bi-tag me-1"></i>
                                    Tipo de intervención
                                </span>

                                <div class="info-value">
                                    {{ $intervencion->tipo->nombre ?? 'Sin especificar' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="info-box">
                                <span class="info-label">
                                    <i class="bi bi-person-badge me-1"></i>
                                    Profesional responsable
                                </span>

                                <div class="info-value">
                                    @if($intervencion->encargado)
                                        {{ $intervencion->encargado->apellido }},
                                        {{ $intervencion->encargado->nombre }}
                                    @else
                                        Sin profesional asignado
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <div>
                        <label class="fw-bold text-secondary mb-2">
                            <i class="bi bi-card-text me-1"></i>
                            Detalle de la intervención
                        </label>

                        <div class="detalle-intervencion">
                            {{ $intervencion->detalle ?: 'No se registró un detalle para esta intervención.' }}
                        </div>
                    </div>

                </div>

            </div>

            {{-- DOCUMENTACIÓN ADJUNTA --}}
            <div class="card border-0 shadow-sm mt-4">

                <div class="card-header bg-white border-0 px-4 pt-4 pb-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="fw-bold mb-0" style="color:#5651A0;">
                            <i class="bi bi-paperclip me-2"></i>
                            Documentación adjunta
                        </h5>

                        @if($intervencion->adjuntos->isNotEmpty())
                            <span class="badge rounded-pill bg-primary-subtle text-primary">
                                {{ $intervencion->adjuntos->count() }}
                                {{ $intervencion->adjuntos->count() === 1 ? 'archivo' : 'archivos' }}
                            </span>
                        @endif

                    </div>

                </div>

                <div class="card-body px-4 pb-4">

                    @forelse($intervencion->adjuntos as $adjunto)

                        @php
                            $mime = strtolower($adjunto->tipo_mime ?? '');
                            $esPdf = str_contains($mime, 'pdf');
                            $esImagen = str_starts_with($mime, 'image/');
                            $urlVisualizacion = route(
                                'genero.intervenciones.adjuntos.visualizar',
                                ['id' => $adjunto->id]
                            );
                        @endphp

                        <div class="archivo-container mb-4">

                            {{-- ENCABEZADO DEL ARCHIVO --}}
                            <div class="archivo-header">

                                <div class="d-flex align-items-center gap-3 overflow-hidden">

                                    <div class="archivo-icono">

                                        @if($esPdf)
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                        @elseif($esImagen)
                                            <i class="bi bi-file-earmark-image-fill text-primary"></i>
                                        @else
                                            <i class="bi bi-file-earmark-fill text-secondary"></i>
                                        @endif

                                    </div>

                                    <div class="overflow-hidden">

                                        <div class="fw-bold text-dark text-truncate"
                                            title="{{ $adjunto->nombre_original }}">
                                            {{ $adjunto->nombre_original }}
                                        </div>

                                        <small class="text-muted">

                                            {{ $adjunto->tipo_mime ?? 'Tipo desconocido' }}

                                            @if($adjunto->tamaño)
                                                ·
                                                {{ number_format($adjunto->tamaño / 1024, 1) }} KB
                                            @endif

                                        </small>

                                    </div>

                                </div>

                                <div class="d-flex gap-2 flex-shrink-0">

                                    <a href="{{ $urlVisualizacion }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Abrir en otra pestaña">

                                        <i class="bi bi-box-arrow-up-right me-1"></i>
                                        Abrir

                                    </a>

                                    <a href="{{ route('adjuntos.descargar', $adjunto->id) }}"
                                    class="btn btn-sm btn-outline-success"
                                    title="Descargar archivo">

                                        <i class="bi bi-download me-1"></i>
                                        Descargar

                                    </a>

                                </div>

                            </div>

                            {{-- VISUALIZACIÓN DEL ARCHIVO --}}
                            <div class="archivo-visor">

                                @if($esPdf)

                                    <iframe
                                        src="{{ $urlVisualizacion }}"
                                        class="visor-pdf"
                                        title="Documento PDF: {{ $adjunto->nombre_original }}">
                                    </iframe>

                                @elseif($esImagen)

                                    <a href="{{ $urlVisualizacion }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="d-block text-center">

                                        <img
                                            src="{{ $urlVisualizacion }}"
                                            alt="{{ $adjunto->nombre_original }}"
                                            class="imagen-adjunta">

                                    </a>

                                @else

                                    <div class="text-center py-5 text-muted">

                                        <i class="bi bi-file-earmark-arrow-down fs-1 d-block mb-3 opacity-50"></i>

                                        <p class="mb-3">
                                            Este tipo de archivo no puede visualizarse directamente.
                                        </p>

                                        <a href="{{ route('adjuntos.descargar', $adjunto->id) }}"
                                        class="btn btn-outline-success">

                                            <i class="bi bi-download me-1"></i>
                                            Descargar archivo

                                        </a>

                                    </div>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5 text-muted">

                            <div class="mb-3">
                                <i class="bi bi-folder-x"
                                style="font-size:3rem; opacity:.4;"></i>
                            </div>

                            <h6 class="fw-bold">
                                Sin documentación adjunta
                            </h6>

                            <p class="small mb-0">
                                Esta intervención no tiene archivos cargados.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm sticky-lg-top"
                 style="top:20px;">

                <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
                    <h5 class="fw-bold mb-0" style="color:#5651A0;">
                        <i class="bi bi-person-vcard me-2"></i>
                        Datos del caso
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">

                    <div class="mb-3">
                        <span class="d-block small text-muted fw-semibold">
                            Persona
                        </span>

                        <span class="fw-bold">
                            {{ $caso->persona->apellido }},
                            {{ $caso->persona->nombre }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <span class="d-block small text-muted fw-semibold">
                            DNI
                        </span>

                        <span class="fw-bold">
                            {{ $caso->persona->dni ?? 'Sin DNI' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <span class="d-block small text-muted fw-semibold">
                            Número de caso
                        </span>

                        <span class="badge bg-light text-dark border">
                            #{{ str_pad($caso->id, 6, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    <hr>

                    <div class="small text-muted">
                        <div class="mb-2">
                            <i class="bi bi-clock me-1"></i>
                            Registrada:
                            {{ $intervencion->created_at
                                ? $intervencion->created_at->format('d/m/Y H:i')
                                : 'Sin información'
                            }}
                        </div>

                        <div>
                            <i class="bi bi-arrow-repeat me-1"></i>
                            Última modificación:
                            {{ $intervencion->updated_at
                                ? $intervencion->updated_at->format('d/m/Y H:i')
                                : 'Sin información'
                            }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style data-intervencion-estilos>
    .card {
        border-radius: 16px;
    }

    .info-box {
        background: #f8f9fb;
        border: 1px solid #eceef2;
        border-radius: 12px;
        padding: 16px;
        height: 100%;
    }

    .info-label {
        display: block;
        color: #6c757d;
        font-size: .78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 6px;
    }

    .info-value {
        color: #212529;
        font-size: 1rem;
        font-weight: 600;
    }

    .detalle-intervencion {
        min-height: 180px;
        padding: 20px;
        background: #fafafa;
        border: 1px solid #e6e6e6;
        border-left: 4px solid #198754;
        border-radius: 10px;
        color: #343a40;
        line-height: 1.75;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .archivo-adjunto {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 16px;
        background: #f8f9fb;
        border: 1px solid #e7e9ed;
        border-radius: 12px;
    }

    .archivo-icono {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid #e7e9ed;
        border-radius: 12px;
        font-size: 1.5rem;
    }

    @media print {
        .d-print-none {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .sticky-lg-top {
            position: static !important;
        }
    }

    .archivo-container {
        border: 1px solid #e4e7ec;
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
    }

    .archivo-container:last-child {
        margin-bottom: 0 !important;
    }

    .archivo-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 14px 16px;
        background: #f8f9fb;
        border-bottom: 1px solid #e4e7ec;
    }

    .archivo-icono {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #ffffff;
        border: 1px solid #e4e7ec;
        font-size: 1.4rem;
    }

    .archivo-visor {
        background: #f2f4f7;
        min-height: 200px;
    }

    .visor-pdf {
        display: block;
        width: 100%;
        height: 650px;
        border: 0;
        background: white;
    }

    .imagen-adjunta {
        display: block;
        max-width: 100%;
        max-height: 700px;
        width: auto;
        height: auto;
        margin: 0 auto;
        padding: 18px;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .archivo-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .archivo-header > .d-flex:last-child {
            width: 100%;
        }

        .archivo-header > .d-flex:last-child .btn {
            flex: 1;
        }

        .visor-pdf {
            height: 500px;
        }
    }

    @media print {
        .archivo-header .btn {
            display: none !important;
        }

        .visor-pdf {
            height: 700px;
        }
    }
</style>

@endsection