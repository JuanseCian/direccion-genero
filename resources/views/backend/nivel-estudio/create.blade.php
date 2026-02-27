@extends('backend.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header text-white" style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0">
            <i class="bi bi-mortarboard-fill me-2"></i>Nuevo Nivel de Estudio
        </h5>
    </div>

    <div class="card-body bg-light p-4">
        <form action="{{ route('backend.nivel-estudio.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
            @csrf
            
            <div class="mb-4">
                <label for="nombre" class="form-label fw-bold" style="color: #5651A0;">
                    Descripción del Nivel
                </label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       class="form-control @error('nombre') is-invalid @enderror" 
                       placeholder="Ej: Secundario Completo, Universitario en curso..." 
                       value="{{ old('nombre') }}"
                       required 
                       autofocus>
                
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text mt-2">
                    Asegúrese de que el nombre sea claro y descriptivo.
                </div>
            </div>

            <hr class="my-4 text-muted">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('backend.nivel-estudio.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn text-white px-4 shadow-sm" style="background:#5651A0;">
                    <i class="bi bi-save me-1"></i> Guardar Nivel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection