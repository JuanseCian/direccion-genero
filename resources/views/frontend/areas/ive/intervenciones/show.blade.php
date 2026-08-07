@extends('frontend.layouts.front')

@section('title', 'Detalle de intervención IVE')

@section('content')

<div class="container py-4">

    {{-- ENCABEZADO --}}
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">

        <div>
            <p class="text-muted mb-1 small">
                IVE / Intervenciones
            </p>

            <h2 class="fw-bold mb-1">
                Intervención #{{ $intervencion->id }}
            </h2>

            @if($caso->persona)
                <p class="text-muted mb-0">
                    {{ $caso->persona->apellido }},
                    {{ $caso->persona->nombre }}
                    · DNI {{ $caso->persona->dni ?? 'Sin DNI' }}
                </p>
            @endif
        </div>

        <div class="d-flex flex-wrap gap-2 no-print">

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-printer me-1"></i>
                Imprimir
            </button>

            <a
                href="{{ route('ive.intervenciones.edit', $intervencion->id) }}"
                class="btn btn-outline-primary"
            >
                <i class="bi bi-pencil-square me-1"></i>
                Editar
            </a>

            <a
                href="{{ route('frontend.areas.ive.edit', $caso->id) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Volver al legajo
            </a>

        </div>

    </div>


    <div class="row g-4">

        {{-- COLUMNA PRINCIPAL --}}
        <div class="col-lg-8">

            {{-- INFORMACIÓN --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 p-4 pb-2">

                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="bi bi-journal-text me-2"></i>
                        Información de la intervención
                    </h5>

                </div>

                <div class="card-body p-4">

                    <div class="row g-4">

                        <div class="col-md-4">

                            <div class="info-label">
                                Fecha
                            </div>

                            <div class="info-value">
                                <i class="bi bi-calendar3 me-2"></i>

                                {{ $intervencion->fecha_intervencion
                                    ? \Carbon\Carbon::parse($intervencion->fecha_intervencion)->format('d/m/Y')
                                    : 'Sin fecha' }}
                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="info-label">
                                Tipo
                            </div>

                            <div class="info-value">
                                <i class="bi bi-tag me-2"></i>

                                {{ $intervencion->tipo->nombre ?? 'No especificado' }}
                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="info-label">
                                Profesional
                            </div>

                            <div class="info-value">
                                <i class="bi bi-person-badge me-2"></i>

                                @if($intervencion->encargado)
                                    {{ $intervencion->encargado->apellido }}
                                    {{ $intervencion->encargado->nombre }}
                                @else
                                    No asignado
                                @endif
                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    <div class="info-label mb-2">
                        Detalle
                    </div>

                    <div class="detalle">
                        {{ $intervencion->detalle ?: 'Sin detalle registrado.' }}
                    </div>

                </div>

            </div>


            {{-- DOCUMENTACIÓN --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 p-4 pb-2">

                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="fw-bold mb-0 text-primary">
                            <i class="bi bi-paperclip me-2"></i>
                            Documentación adjunta
                        </h5>

                        @if($intervencion->adjuntos->isNotEmpty())

                            <span class="badge bg-light text-dark border">
                                {{ $intervencion->adjuntos->count() }}
                                {{ $intervencion->adjuntos->count() == 1 ? 'archivo' : 'archivos' }}
                            </span>

                        @endif

                    </div>

                </div>


                <div class="card-body p-4">

                    @forelse($intervencion->adjuntos as $adjunto)

                        @php
                            $mime = strtolower($adjunto->tipo_mime ?? '');

                            $extension = strtolower(
                                pathinfo(
                                    $adjunto->nombre_original ?? '',
                                    PATHINFO_EXTENSION
                                )
                            );

                            $esPdf =
                                str_contains($mime, 'pdf') ||
                                $extension === 'pdf';

                            $esImagen =
                                str_starts_with($mime, 'image/') ||
                                in_array($extension, [
                                    'jpg',
                                    'jpeg',
                                    'png',
                                    'webp'
                                ]);

                            $urlArchivo = route(
                                'ive.intervenciones.adjuntos.visualizar',
                                ['id' => $adjunto->id]
                            );
                        @endphp


                        <div class="archivo-card mb-4">

                            {{-- HEADER ARCHIVO --}}
                            <div class="archivo-header">

                                <div class="d-flex align-items-center gap-3 overflow-hidden">

                                    <div class="archivo-icon">

                                        @if($esPdf)
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>

                                        @elseif($esImagen)
                                            <i class="bi bi-file-earmark-image-fill text-primary"></i>

                                        @else
                                            <i class="bi bi-file-earmark-fill text-secondary"></i>
                                        @endif

                                    </div>


                                    <div class="overflow-hidden">

                                        <div
                                            class="fw-semibold text-truncate"
                                            title="{{ $adjunto->nombre_original }}"
                                        >
                                            {{ $adjunto->nombre_original }}
                                        </div>

                                        <small class="text-muted">

                                            {{ $adjunto->tipo_mime ?? 'Archivo' }}

                                            @if($adjunto->tamaño)
                                                ·
                                                {{ number_format(
                                                    $adjunto->tamaño / 1024,
                                                    1,
                                                    ',',
                                                    '.'
                                                ) }} KB
                                            @endif

                                        </small>

                                    </div>

                                </div>


                                <div class="d-flex gap-2 no-print">

                                    <a
                                        href="{{ $urlArchivo }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        <i class="bi bi-box-arrow-up-right me-1"></i>
                                        Abrir
                                    </a>

                                    <a
                                        href="{{ route('adjuntos.descargar', $adjunto->id) }}"
                                        class="btn btn-sm btn-outline-success"
                                    >
                                        <i class="bi bi-download me-1"></i>
                                        Descargar
                                    </a>

                                </div>

                            </div>


                            {{-- PREVISUALIZACIÓN --}}
                            <div class="archivo-preview">

                                @if($esPdf)

                                    <iframe
                                        src="{{ $urlArchivo }}"
                                        class="pdf-viewer"
                                        title="{{ $adjunto->nombre_original }}"
                                    ></iframe>

                                @elseif($esImagen)

                                    <a
                                        href="{{ $urlArchivo }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <img
                                            src="{{ $urlArchivo }}"
                                            alt="{{ $adjunto->nombre_original }}"
                                            class="imagen-preview"
                                        >
                                    </a>

                                @else

                                    <div class="text-center py-5 text-muted">

                                        <i class="bi bi-file-earmark fs-1"></i>

                                        <p class="mt-3 mb-2">
                                            Este tipo de archivo no puede visualizarse.
                                        </p>

                                        <a
                                            href="{{ route('adjuntos.descargar', $adjunto->id) }}"
                                            class="btn btn-sm btn-outline-primary no-print"
                                        >
                                            Descargar archivo
                                        </a>

                                    </div>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5 text-muted">

                            <i class="bi bi-folder2-open display-5 opacity-50"></i>

                            <h6 class="fw-bold mt-3">
                                Sin documentación adjunta
                            </h6>

                            <p class="mb-0">
                                Esta intervención no tiene archivos cargados.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    <div class="avatar-persona mb-3">
                        <i class="bi bi-person"></i>
                    </div>


                    @if($caso->persona)

                        <div class="text-center mb-4">

                            <h5 class="fw-bold mb-1">
                                {{ $caso->persona->apellido }},
                                {{ $caso->persona->nombre }}
                            </h5>

                            <span class="text-muted">
                                DNI {{ $caso->persona->dni ?? 'Sin DNI' }}
                            </span>

                        </div>

                    @endif


                    <div class="dato-sidebar">

                        <span>
                            Caso
                        </span>

                        <strong>
                            #{{ $caso->id }}
                        </strong>

                    </div>


                    <div class="dato-sidebar">

                        <span>
                            Intervención
                        </span>

                        <strong>
                            #{{ $intervencion->id }}
                        </strong>

                    </div>

                </div>

            </div>


            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h6 class="fw-bold mb-3">
                        Información del registro
                    </h6>

                    <small class="text-muted d-block mb-1">
                        Creada
                    </small>

                    <div class="mb-3">
                        {{ optional($intervencion->created_at)->format('d/m/Y H:i') ?? 'Sin información' }}
                    </div>

                    <small class="text-muted d-block mb-1">
                        Última modificación
                    </small>

                    <div>
                        {{ optional($intervencion->updated_at)->format('d/m/Y H:i') ?? 'Sin información' }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<style>
    .card {
        border-radius: 16px;
    }

    .info-label {
        color: #6c757d;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .info-value {
        margin-top: 8px;
        font-weight: 600;
        color: #343a40;
    }

    .detalle {
        padding: 18px;
        min-height: 130px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        white-space: pre-wrap;
        line-height: 1.7;
        word-break: break-word;
    }

    .archivo-card {
        border: 1px solid #e4e7ec;
        border-radius: 14px;
        overflow: hidden;
    }

    .archivo-card:last-child {
        margin-bottom: 0 !important;
    }

    .archivo-header {
        padding: 14px 16px;
        background: #f8f9fa;
        border-bottom: 1px solid #e4e7ec;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .archivo-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: white;
        border: 1px solid #e4e7ec;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .archivo-preview {
        background: #f1f3f5;
    }

    .pdf-viewer {
        display: block;
        width: 100%;
        height: 650px;
        border: 0;
        background: white;
    }

    .imagen-preview {
        display: block;
        width: auto;
        max-width: 100%;
        max-height: 700px;
        margin: auto;
        padding: 20px;
        object-fit: contain;
    }

    .avatar-persona {
        width: 70px;
        height: 70px;
        margin: auto;
        border-radius: 50%;
        background: #eef2ff;
        color: #5651A0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
    }

    .dato-sidebar {
        padding: 12px 0;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
    }

    .dato-sidebar span {
        color: #6c757d;
    }

    @media(max-width: 768px) {

        .archivo-header {
            flex-direction: column;
            align-items: stretch;
        }

        .archivo-header > .d-flex:last-child {
            width: 100%;
        }

        .archivo-header .btn {
            flex: 1;
        }

        .pdf-viewer {
            height: 500px;
        }
    }

    @media print {

        .no-print {
            display: none !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .archivo-preview {
            display: none;
        }
    }
</style>

@endsection