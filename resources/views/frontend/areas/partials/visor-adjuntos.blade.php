<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white px-4 py-3">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="fw-bold mb-0 text-primary">
                <i class="bi bi-paperclip me-2"></i>
                Documentación adjunta
            </h5>

            @if($adjuntos->isNotEmpty())
                <span class="badge bg-primary-subtle text-primary">
                    {{ $adjuntos->count() }}
                    {{ $adjuntos->count() === 1 ? 'archivo' : 'archivos' }}
                </span>
            @endif

        </div>

    </div>

    <div class="card-body p-4">

        @forelse($adjuntos as $adjunto)

            @php
                $mime = strtolower($adjunto->tipo_mime ?? '');

                $esPdf = str_contains($mime, 'pdf');

                $esImagen = str_starts_with(
                    $mime,
                    'image/'
                );

                $urlVisualizacion = route(
                    $rutaVisualizacion,
                    ['id' => $adjunto->id]
                );
            @endphp

            <div class="visor-adjunto mb-4">

                <div class="visor-adjunto-header">

                    <div class="d-flex align-items-center gap-3 overflow-hidden">

                        <div class="visor-adjunto-icono">

                            @if($esPdf)
                                <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                            @elseif($esImagen)
                                <i class="bi bi-file-earmark-image-fill text-primary"></i>
                            @else
                                <i class="bi bi-file-earmark-fill text-secondary"></i>
                            @endif

                        </div>

                        <div class="overflow-hidden">

                            <div class="fw-bold text-truncate"
                                 title="{{ $adjunto->nombre_original }}">
                                {{ $adjunto->nombre_original }}
                            </div>

                            <small class="text-muted">

                                {{ $adjunto->tipo_mime ?? 'Tipo desconocido' }}

                                @if($adjunto->tamaño)
                                    ·
                                    {{ number_format(
                                        $adjunto->tamaño / 1024,
                                        1
                                    ) }} KB
                                @endif

                            </small>

                        </div>

                    </div>

                    <div class="d-flex gap-2">

                        <a href="{{ $urlVisualizacion }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-sm btn-outline-primary">

                            <i class="bi bi-box-arrow-up-right me-1"></i>
                            Abrir
                        </a>

                        <a href="{{ route(
                                'adjuntos.descargar',
                                ['id' => $adjunto->id]
                            ) }}"
                           class="btn btn-sm btn-outline-success">

                            <i class="bi bi-download me-1"></i>
                            Descargar
                        </a>

                    </div>

                </div>

                <div class="visor-adjunto-contenido">

                    @if($esPdf)

                        <iframe
                            src="{{ $urlVisualizacion }}"
                            class="visor-adjunto-pdf"
                            title="{{ $adjunto->nombre_original }}">
                        </iframe>

                    @elseif($esImagen)

                        <a href="{{ $urlVisualizacion }}"
                           target="_blank"
                           rel="noopener noreferrer">

                            <img
                                src="{{ $urlVisualizacion }}"
                                alt="{{ $adjunto->nombre_original }}"
                                class="visor-adjunto-imagen">

                        </a>

                    @else

                        <div class="text-center text-muted py-5">

                            <i class="bi bi-file-earmark-arrow-down fs-1"></i>

                            <p class="mt-3 mb-0">
                                Este archivo no puede visualizarse directamente.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        @empty

            <div class="text-center text-muted py-5">

                <i class="bi bi-folder-x fs-1 d-block mb-3"></i>

                <h6 class="fw-bold">
                    Sin documentación adjunta
                </h6>

                <p class="mb-0">
                    Esta intervención no tiene archivos cargados.
                </p>

            </div>

        @endforelse

    </div>

</div>

@once
    <style>
        .visor-adjunto {
            overflow: hidden;
            border: 1px solid #e4e7ec;
            border-radius: 14px;
            background: #fff;
        }

        .visor-adjunto:last-child {
            margin-bottom: 0 !important;
        }

        .visor-adjunto-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 16px;
            background: #f8f9fb;
            border-bottom: 1px solid #e4e7ec;
        }

        .visor-adjunto-icono {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e4e7ec;
            border-radius: 10px;
            background: white;
            font-size: 1.4rem;
        }

        .visor-adjunto-contenido {
            min-height: 200px;
            background: #f2f4f7;
        }

        .visor-adjunto-pdf {
            display: block;
            width: 100%;
            height: 650px;
            border: 0;
            background: white;
        }

        .visor-adjunto-imagen {
            display: block;
            width: auto;
            max-width: 100%;
            max-height: 700px;
            margin: 0 auto;
            padding: 18px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .visor-adjunto-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .visor-adjunto-header > .d-flex:last-child {
                width: 100%;
            }

            .visor-adjunto-header > .d-flex:last-child .btn {
                flex: 1;
            }

            .visor-adjunto-pdf {
                height: 500px;
            }
        }
    </style>
@endonce    