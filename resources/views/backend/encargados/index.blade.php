@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-header d-flex justify-content-between align-items-center text-white" 
             style="background: #5651A0; border-radius: 12px 12px 0 0; padding: 1rem 1.5rem;">
            
            <h5 class="mb-0 d-flex align-items-center">
                <i class="bi bi-person-badge-fill me-2"></i> 
                Gestión de Encargados
            </h5>

            <a href="{{ route('backend.encargados.create') }}" class="btn btn-light btn-sm fw-bold shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Encargado
            </a>
        </div>

        <div class="card-body bg-white p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f8f9fa; border-bottom: 2px solid #ecebfa;">
                        <tr>
                            <th class="ps-4 text-muted text-uppercase small fw-bold">Nombre Completo</th>
                            <th class="text-muted text-uppercase small fw-bold">Áreas Asignadas</th>
                            <th width="200" class="text-center text-muted text-uppercase small fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($encargados as $encargado)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3 text-white d-flex align-items-center justify-content-center shadow-sm" 
                                             style="width: 35px; height: 35px; background: #9d99d3; border-radius: 50%; font-size: 0.8rem;">
                                            {{ substr($encargado->nombre, 0, 1) }}{{ substr($encargado->apellido, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block text-dark">{{ $encargado->apellido }}, {{ $encargado->nombre }}</span>
                                            <small class="text-muted">ID: #{{ str_pad($encargado->id, 4, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($encargado->areas as $area)
                                            <span class="badge rounded-pill px-3 py-2 shadow-sm" 
                                                  style="background: #ecebfa; color: #5651A0; border: 1px solid #dcd9f5; font-weight: 600;">
                                                <i class="bi bi-tag-fill me-1" style="font-size: 0.7rem;"></i>
                                                {{ $area->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('backend.encargados.edit', $encargado->id) }}" 
                                           class="btn btn-outline-primary btn-sm border-0 px-3" 
                                           title="Editar encargado">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form method="POST" action="{{ route('backend.encargados.destroy', $encargado->id) }}" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm border-0 px-3 btn-delete" 
                                                    title="Eliminar encargado">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="bi bi-info-circle d-block mb-2 fs-3"></i>
                                    No hay encargados registrados actualmente.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white border-0 py-3 text-muted small">
            <i class="bi bi-info-circle me-1"></i> Total de encargados: <strong>{{ $encargados->count() }}</strong>
        </div>
    </div>
</div>

{{-- Script para confirmación de borrado (opcional pero recomendado) --}}
@push('scripts')
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('¿Estás seguro de que deseas eliminar este encargado?')) {
                this.closest('form').submit();
            }
        });
    });
</script>
@endpush
@endsection