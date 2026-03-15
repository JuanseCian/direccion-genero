@extends('backend.layouts.app')

@section('content')
<div class="container py-2 py-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card shadow-sm border-0">
                <div class="card-header text-white" style="background:#5651A0; border-radius:8px 8px 0 0;">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Editar Estado Civil</h5>
                </div>

                <div class="card-body bg-light p-3 p-md-4">
                    <form action="{{ route('backend.estado-civil.update', $estadoCivil->id) }}" method="POST" class="bg-white p-3 p-md-4 rounded shadow-sm border">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold text-muted small text-uppercase">Nombre del Estado Civil</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre', $estadoCivil->nombre) }}" 
                                   placeholder="Ej: Soltero/a" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                            <a href="{{ route('backend.estado-civil.index') }}" class="btn btn-outline-secondary order-last order-sm-first">
                                Cancelar
                            </a>
                            <button type="submit" class="btn text-white px-4" style="background:#5651A0;">
                                <i class="bi bi-check-lg me-1"></i> Actualizar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection