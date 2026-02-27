@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header text-white" 
         style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0">
            <i class="bi bi-layers"></i> Nueva Zona de Barrio
        </h5>
    </div>

    <div class="card-body bg-light">

        <form method="POST" action="{{ route('zonas.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nombre de la Zona</label>
                <input type="text" 
                       name="nombre" 
                       class="form-control border-0 shadow-sm" 
                       placeholder="Ej: Zona Norte, Centro, etc." 
                       value="{{ old('nombre') }}"
                       required>
                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 border-top pt-3 text-end">
                <a href="{{ route('zonas.index') }}" class="btn btn-outline-secondary px-4 me-2">
                    Cancelar
                </a>
                <button type="submit" class="btn text-white px-4" style="background:#5651A0;">
                    <i class="bi bi-save"></i> Guardar Zona
                </button>
            </div>

        </form>

    </div>

</div>

@endsection