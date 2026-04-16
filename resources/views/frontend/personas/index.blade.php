@extends('frontend.layouts.front')

@section('title','Personas')

@section('content')

<div class="container-fluid py-4">
    {{-- Encabezado Superior --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Registro de Personas</h2>
            <p class="text-muted small mb-0">Gestión de ciudadanos y sus intervenciones en áreas.</p>
        </div>
        <a href="{{ route('personas.create') }}" class="btn btn-primary px-4 shadow-sm d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Nueva Persona</span>
        </a>
    </div>

    {{-- Contenedor Principal --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="border-0 ps-4 py-3 text-uppercase small fw-bold">Persona</th>
                            <th class="border-0 py-3 text-uppercase small fw-bold">DNI</th>
                            <th class="border-0 py-3 text-uppercase small fw-bold">Contacto</th>
                            <th class="border-0 py-3 text-uppercase small fw-bold">Ubicación</th>
                            <th class="border-0 py-3 text-uppercase small fw-bold text-center">Áreas de Intervención</th>
                            <th class="border-0 py-3 text-uppercase small fw-bold text-center">Intervenciones externas</th>
                            <th class="border-0 pe-4 py-3 text-uppercase small fw-bold text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($personas as $p)
                        <tr>
                            {{-- Nombre y Apellido Combinados --}}
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: #e7f1ff;">
                                        <span class="fw-bold">{{ substr($p->nombre, 0, 1) }}{{ substr($p->apellido, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark text-capitalize">{{ $p->apellido }}, {{ $p->nombre }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- DNI con estilo --}}
                            <td class="text-secondary font-monospace">
                                {{ number_format((int) $p->dni, 0, '', '.') }}
                            </td>

                            {{-- Teléfono --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-phone-alt text-muted small"></i>
                                    <span class="text-secondary">{{ $p->telefono ?? '---' }}</span>
                                </div>
                            </td>

                            {{-- Barrio --}}
                            <td>
                                <span class="badge bg-light text-dark border fw-normal px-2 py-1">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    {{ $p->barrio->nombre ?? 'Sin definir' }}
                                </span>
                            </td>

                            {{-- Áreas (Badges estilizados) --}}
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    @php $tieneIntervencion = false; @endphp

                                    @if($p->casosIve->isNotEmpty())
                                        <a href="{{ route('frontend.areas.ive.edit', $p->casosIve->first()->id) }}" 
                                           class="badge text-white px-3 py-2 text-decoration-none shadow-sm" 
                                           style="background: linear-gradient(45deg, #28a745, #34ce57); border-radius: 50px;">
                                            IVE
                                        </a>
                                        @php $tieneIntervencion = true; @endphp
                                    @endif

                                    @if($p->casosGenero->isNotEmpty())
                                        <a href="{{ route('genero.edit', $p->casosGenero->first()->id) }}" 
                                           class="badge text-white px-3 py-2 text-decoration-none shadow-sm" 
                                           style="background: linear-gradient(45deg, #6f42c1, #8959e0); border-radius: 50px;">
                                            GÉNERO
                                        </a>
                                        @php $tieneIntervencion = true; @endphp
                                    @endif

                                    @if($p->casosMasculinidades->isNotEmpty())
                                        <a href="{{ route('masculinidades.edit', $p->casosMasculinidades->first()->id) }}" 
                                           class="badge text-white px-3 py-2 text-decoration-none shadow-sm" 
                                           style="background: linear-gradient(45deg, #00667b, #008ba8); border-radius: 50px;">
                                            MASCULINIDADES
                                        </a>
                                        @php $tieneIntervencion = true; @endphp
                                    @endif

                                    @if(!$tieneIntervencion)
                                        <span class="badge bg-light text-muted border-0 px-3 py-2" style="border-radius: 50px;">
                                            Ninguna
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="text-center">
                                @if($p->existe_en_entramados)
                                <a href="{{ env('ENTRAMADOS_URL') }}/legajo/{{ $p->entramados_id }}/edit"
                                    target="_blank"
                                    class="badge text-white px-3 py-2 text-decoration-none shadow-sm"
                                    style="background: linear-gradient(45deg, #0dcaf0, #31d2f2); border-radius: 50px;">
                                        <i class="fas fa-external-link-alt me-1"></i> Entramados
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted px-3 py-2">
                                        —
                                    </span>
                                @endif
                            </td>

                            {{-- Botón de Acción --}}
                            <td class="pe-4 text-end">
                                <a href="{{ route('personas.edit', $p->id) }}" 
                                   class="btn btn-outline-secondary btn-sm rounded-pill px-3 shadow-sm hover-primary">
                                    <i class="fas fa-eye me-1"></i> Gestionar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Paginación (Si tienes) --}}
        @if(method_exists($personas, 'links'))
        <div class="card-footer bg-white border-0 py-3">
            {{ $personas->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    /* Efecto suave para el botón de gestionar */
    .hover-primary:hover {
        background-color: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
    }
    /* Estilo para las filas de la tabla */
    .table tbody tr {
        transition: all 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        }
</style>

@endsection