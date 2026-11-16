@extends('frontend.layouts.front')

@section('title', 'Listado de Casos IVE')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 text-white" 
            style="background:#5651A0; border-radius:8px 8px 0 0;">

            <h5 class="mb-0">
                <i class="bi bi-journal-text me-2"></i> Listado de Casos: Área IVE
            </h5>

            <div class="d-flex align-items-center gap-2">

                {{-- BUSCADOR --}}
                <form action="{{ route('frontend.areas.ive.listado') }}" 
                    method="GET" 
                    class="d-flex">

                    <input type="text"
                        name="buscar"
                        class="form-control form-control-sm"
                        placeholder="Nombre, apellido o DNI (con o sin coma)..."
                        value="{{ request('buscar') }}">

                    <button class="btn btn-light btn-sm ms-2">
                        <i class="bi bi-search"></i>
                    </button>

                </form>

                {{-- NUEVO CASO --}}
                <a href="{{ route('frontend.areas.ive.create') }}" 
                class="btn btn-light btn-sm shadow-sm">
                    <i class="bi bi-plus-lg"></i> Nueva Atención
                </a>

            </div>
        </div>

        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table align-middle table-hover bg-white rounded shadow-sm overflow-hidden">
                    
                    <thead style="background:#ecebfa;">
                        <tr>
                            <th class="ps-3">Persona / DNI</th>
                            <th>Datos Obstétricos (FUM/ECO)</th>
                            <th>Situación Social</th>
                            <th>Antecedentes</th>
                            <th>Estado / Alta</th>
                            <th width="150" class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($casos as $caso)
                        <tr>
                            {{-- Persona / DNI --}}
                            <td class="ps-3">
                                <div class="fw-bold" style="color: #5651A0;">
                                    {{ $caso->persona->apellido }}, {{ $caso->persona->nombre }}
                                </div>
                                <small class="text-muted">DNI: {{ $caso->persona->dni }}</small>
                            </td>

                            {{-- Datos Obstétricos --}}
                            <td>
                                <div class="small"><strong>FUM:</strong> {{ $caso->fum ? \Carbon\Carbon::parse($caso->fum)->format('d/m/Y') : 'S/D' }}</div>
                                <div class="small"><strong>Semanas (ECO):</strong> {{ $caso->eco_semanas ?? '-' }}</div>
                            </td>

                            {{-- Situación Social --}}
                            <td>
                                <div class="small"><strong>Hijos:</strong> {{ $caso->cantidad_hijos }}</div>
                                <div>
                                    @if($caso->obra_social)
                                        <span class="badge bg-success-soft text-success small" style="background: #e8f5e9;">Con Obra Social</span>
                                    @else
                                        <span class="badge bg-secondary-soft text-secondary small" style="background: #f5f5f5;">Sin Cobertura</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Antecedentes --}}
                            <td>
                                <div class="small text-muted">
                                    Int. Previa: 
                                    <span class="{{ $caso->interrupcion_previa ? 'text-danger fw-bold' : 'text-success' }}">
                                        {{ $caso->interrupcion_previa ? 'Sí' : 'No' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Estado / Alta --}}
                            <td>
                                @if($caso->alta)
                                    <span class="badge rounded-pill px-3" style="background: #e9ecef; color: #198754;">
                                        Finalizado ({{ \Carbon\Carbon::parse($caso->alta)->format('d/m/Y') }})
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3" style="background: #fff3cd; color: #856404;">
                                        En Seguimiento
                                    </span>
                                @endif
                            </td>

                            {{-- Acciones --}}
                            <td class="text-center">
    <div class="btn-group shadow-sm">

        {{-- Editar --}}
        <a href="{{ route('frontend.areas.ive.edit', $caso->id) }}" 
           class="btn btn-sm btn-outline-primary" 
           title="Editar">
            <i class="bi bi-pencil"></i>
        </a>

        {{-- Descargar Word --}}
        <a href="{{ route('ive.descargar', $caso->id) }}" 
           class="btn btn-sm btn-outline-success" 
           title="Descargar Word">
            <i class="bi bi-file-earmark-word"></i>
        </a>

        {{-- Eliminar --}}
        <form action="{{ route('frontend.areas.ive.destroy', $caso->id) }}" 
            method="POST" 
            id="delete-form-{{ $caso->id }}" 
            class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="motivo_eliminacion" id="motivo-{{ $caso->id }}">
            
            <button type="button" 
                    class="btn btn-sm btn-outline-danger" 
                    onclick="confirmarEliminacion({{ $caso->id }}, '{{ $caso->persona->nombre }} {{ $caso->persona->apellido }}')">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No hay casos de IVE registrados actualmente.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $casos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{ route('frontend.areas.ive.index') }}" class="btn btn-light btn-sm shadow-sm">
    <i class="bi bi-arrow-left"></i> Volver al Panel
</a>

<style>
    .table thead th {
        font-weight: 600;
        color: #5651A0;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 15px 10px;
    }
    .table tbody td {
        border-bottom: 1px solid #f2f2f2;
        padding: 12px 10px;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9ff !important;
    }
    .bg-success-soft { color: #2e7d32; }

    .text-truncate-custom {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
function confirmarEliminacion(id, nombrePersona) {
    Swal.fire({
        title: '¿Confirmar eliminación?',
        text: "Estás por eliminar el caso de: " + nombrePersona,
        icon: 'warning',
        input: 'textarea',
        inputPlaceholder: 'Escribe aquí el motivo de la eliminación...',
        inputAttributes: {
            'aria-label': 'Escribe aquí el motivo de la eliminación'
        },
        showCancelButton: true,
        confirmButtonColor: '#5651A0', // El color violeta de tu cabecera
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="bi bi-check-circle"></i> Confirmar y Eliminar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || value.trim().length < 10) {
                return 'Es obligatorio ingresar un motivo descriptivo (mínimo 10 caracteres).'
            }
        },
        background: '#f8f9fa',
        customClass: {
            title: 'fw-bold',
            confirmButton: 'btn btn-primary shadow-sm',
            cancelButton: 'btn btn-secondary shadow-sm'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Asignamos el motivo al input oculto
            document.getElementById('motivo-' + id).value = result.value;
            // Enviamos el formulario
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection
