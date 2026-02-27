@extends('backend.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header text-white" style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Provincia: {{ $provincia->nombre }}</h5>
    </div>
    <div class="card-body bg-light">
        <form method="POST" action="{{ route('provincias.update', $provincia->id) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nombre de la Provincia</label>
                <input type="text" name="nombre" class="form-control border-0 shadow-sm" value="{{ old('nombre', $provincia->nombre) }}" required>
            </div>
            <div class="mt-4 border-top pt-3 text-end">
                <a href="{{ route('provincias.index') }}" class="btn btn-outline-secondary px-4 me-2">Cancelar</a>
                <button type="submit" class="btn text-white px-4" style="background:#5651A0;">Actualizar Provincia</button>
            </div>
        </form>
    </div>
</div>
@endsection