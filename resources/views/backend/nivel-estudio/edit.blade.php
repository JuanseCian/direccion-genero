@extends('backend.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header text-white" style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i>Editar Nivel de Estudio
        </h5>
    </div>

    <div class="card-body bg-light p-4">
        <form action="{{ route('backend.nivel-estudio.update', $nivelEstudio->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nombre" class="form-label fw-bold" style="color: #5651A0;">
                    Nombre del Nivel
                </label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       class="form-control @error('nombre') is-invalid @enderror" 
                       value="{{ old('nombre', $nivelEstudio->nombre) }}" 
                       required>
                
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="alert alert-info border-0 shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                <div>
                    Tenga en cuenta que modificar este nombre afectará a todos los legajos que tengan asignado este nivel de estudio.
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('backend.nivel-estudio.index') }}" class="btn btn-outline-secondary px-4">
                    Cancelar
                </a>
                <button type="submit" class="btn text-white px-4 shadow-sm" style="background:#5651A0;">
                    <i class="bi bi-check-lg me-1"></i> Actualizar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection