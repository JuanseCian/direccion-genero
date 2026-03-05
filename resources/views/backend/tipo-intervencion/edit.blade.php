@extends('backend.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header text-white" style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Tipo de Intervención</h5>
    </div>

    <div class="card-body bg-light">
        <form action="{{ route('backend.tipo-intervencion.update', $tipo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Nombre del Tipo</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre', $tipo->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('backend.tipo-intervencion.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn text-white" style="background:#5651A0;">
                    <i class="bi bi-check-circle"></i> Actualizar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection