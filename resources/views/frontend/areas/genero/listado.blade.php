@extends('frontend.layouts.front')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center text-white" 
             style="background:#5651A0; border-radius:8px 8px 0 0;">
            
            <h5 class="mb-0">
                <i class="bi bi-journal-text me-2"></i> Listado de Legajos: Área Género
            </h5>

            <a href="{{ route('genero.create') }}" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-plus-lg"></i> Nuevo Legajo
            </a>
        </div>

        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table align-middle table-hover bg-white rounded shadow-sm overflow-hidden">
                    
                    <thead style="background:#ecebfa;">
                        <tr>
                            <th class="ps-3">Persona / DNI</th>
                            <th>Género Autop.</th>
                            <th>Ubicación</th>
                            <th>Situación</th>
                            <th>Estudios</th>
                            <th width="150" class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($legajos as $legajo)
                        <tr>
                            <td class="ps-3">
                                <div class="fw-bold" style="color: #5651A0;">
                                    {{ $legajo->persona->apellido }}, {{ $legajo->persona->nombre }}
                                </div>
                                <small class="text-muted">DNI: {{ $legajo->persona->dni }}</small>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3" style="background: #e9ecef; color: #5651A0;">
                                    {{ $legajo->genero ?? 'No especifica' }}
                                </span>
                            </td>
                            <td>
                                <div class="small">
                                    <i class="bi bi-geo-alt text-danger"></i> 
                                    {{ $legajo->localidad->nombre ?? 'S/D' }}, {{ $legajo->provincia->nombre ?? '' }}
                                </div>
                                <div class="text-muted small">{{ $legajo->barrio->nombre ?? '' }}</div>
                            </td>
                            <td>
                                <div class="small"><strong>Est. Civil:</strong> {{ $legajo->estadoCivil->nombre ?? '-' }}</div>
                                <div class="small"><strong>Trabaja:</strong> {{ $legajo->trabaja ? 'Sí' : 'No' }}</div>
                            </td>
                            <td>
                                <span class="small text-truncate d-inline-block" style="max-width: 150px;">
                                    {{ $legajo->nivelEstudio->nombre ?? 'Sin datos' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm">
                                    <a href="{{ route('genero.edit', $legajo->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('genero.destroy', $legajo->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Borrar legajo?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No hay legajos cargados actualmente.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Pulido visual para las celdas */
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
</style>
@endsection