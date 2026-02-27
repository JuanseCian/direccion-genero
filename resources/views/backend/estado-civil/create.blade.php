@extends('backend.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header text-white" style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Agregar Nuevo Estado Civil</h5>
    </div>

    <div class="card-body bg-light p-4">
        <form action="{{ route('backend.estado-civil.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Nombre del Estado Civil</label>
                <input type="text" name="nombre" id="nombre" 
                       class="form-control @error('nombre') is-invalid @enderror" 
                       placeholder="Ej: Soltero/a, Casado/a..." required autofocus>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('backend.estado-civil.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn text-white" style="background:#5651A0;">
                    <i class="bi bi-save"></i> Guardar Registro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection