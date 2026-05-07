@extends('frontend.layouts.front')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        {{-- HEADER CON EL COLOR INSTITUCIONAL --}}
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 text-white" 
            style="background:#5651A0; border-radius:8px 8px 0 0;">
            
            <h5 class="mb-0">
                <i class="bi bi-people-fill me-2"></i> Listado de casos: Masculinidades
            </h5>

            <div class="d-flex align-items-center gap-2">

                {{-- BUSCADOR --}}
                <form action="{{ route('masculinidades.listado') }}" 
                    method="GET" 
                    class="d-flex">

                    <input type="text"
                        name="buscar"
                        class="form-control form-control-sm"
                        placeholder="Buscar por nombre, apellido o DNI..."
                        value="{{ request('buscar') }}">

                    <button class="btn btn-light btn-sm ms-2">
                        <i class="bi bi-search"></i>
                    </button>

                </form>

                {{-- NUEVO CASO --}}
                <a href="{{ route('masculinidades.create') }}" 
                class="btn btn-light btn-sm shadow-sm">
                    <i class="bi bi-plus-lg"></i> Nuevo Caso
                </a>

            </div>
        </div>

        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table align-middle table-hover bg-white rounded shadow-sm overflow-hidden">
                    
                    <thead style="background:#ecebfa;">
                        <tr>
                            <th class="ps-3">Persona / DNI</th>
                            <th>Derivación</th>
                            <th>Hijos</th>
                            <th>Comportamiento</th>
                            <th>Estado</th>
                            <th width="150" class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($casos as $caso)
                        <tr>
                            <td class="ps-3">
                                <div class="fw-bold" style="color: #5651A0;">
                                    {{ $caso->persona->apellido }}, {{ $caso->persona->nombre }}
                                </div>
                                <small class="text-muted">DNI: {{ $caso->persona->dni }}</small>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3" style="background: #e9ecef; color: #5651A0;">
                                    {{ $caso->derivacion->nombre ?? 'S/D' }}
                                </span>
                            </td>
                            <td>
                                <div class="small">
                                    <i class="bi bi-person-hearts text-primary"></i> 
                                    <strong>Hijos:</strong> {{ $caso->hijos_en_comun ?? 0 }}
                                </div>
                            </td>
                            <td>
                                {{-- INDICADORES RÁPIDOS BASADOS EN TU SQL --}}
                                <div class="d-flex gap-1">
                                    @if($caso->desobediencia)
                                        <span class="badge bg-danger" title="Desobediencia">D</span>
                                    @endif
                                    @if($caso->consumo)
                                        <span class="badge bg-warning text-dark" title="Consumo">C</span>
                                    @endif
                                    @if($caso->reincidencia)
                                        <span class="badge bg-dark" title="Reincidente">R</span>
                                    @endif
                                    @if($caso->trabaja)
                                        <span class="badge bg-success" title="Trabaja">T</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @switch($caso->asistencia_dispositivo)

                                    @case(1)
                                        <span class="badge bg-success px-3 py-2">
                                            Regular
                                        </span>
                                    @break

                                    @case(2)
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            Irregular
                                        </span>
                                    @break

                                    @case(3)
                                        <span class="badge bg-danger px-3 py-2">
                                            Abandonó
                                        </span>
                                    @break

                                    @case(4)
                                        <span class="badge bg-primary px-3 py-2">
                                            Finalizado
                                        </span>
                                    @break

                                    @default
                                        <span class="badge bg-secondary px-3 py-2">
                                            Sin datos
                                        </span>

                                @endswitch
                           

                                <div class="small text-muted">
                                    <strong>Encargado:</strong> {{ $caso->encargado->nombre ?? 'No asignado' }}
                                </div>
                            </td>
                             <td class="text-center">
                                <div class="btn-group shadow-sm">

                                    <a href="{{ route('masculinidades.edit', $caso->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="{{ route('masculinidades.descargar', $caso->id) }}" 
                                       class="btn btn-sm btn-outline-success"
                                       title="Descargar Word">
                                        <i class="bi bi-file-earmark-word"></i>
                                    </a>

                                    <form action="{{ route('masculinidades.destroy', $caso->id) }}" 
                                        method="POST" 
                                        id="delete-form-{{ $caso->id }}" 
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        {{-- Este input recibirá el motivo desde el JS --}}
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
                                <i class="bi bi-info-circle me-1"></i> No hay Casos de masculinidades cargados.
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

<div class="ms-4">
    <a href="{{ route('masculinidades.index') }}" class="btn btn-light btn-sm shadow-sm border">
        <i class="bi bi-arrow-left"></i> Volver al Panel
    </a>
</div>

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
    .badge {
        font-size: 0.7rem;
    }
</style>

<script>
function confirmarEliminacion(id, nombrePersona) {
    Swal.fire({
        title: '¿Confirmar eliminación?',
        text: "Estás por enviar a la papelera el caso de: " + nombrePersona,
        icon: 'warning',
        input: 'textarea',
        inputPlaceholder: 'Escribe aquí el motivo de la eliminación...',
        inputAttributes: {
            'aria-label': 'Escribe aquí el motivo de la eliminación'
        },
        showCancelButton: true,
        confirmButtonColor: '#5651A0', 
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
            // Asignamos el motivo al input oculto que creamos en el form
            document.getElementById('motivo-' + id).value = result.value;
            // Enviamos el formulario correspondiente
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection