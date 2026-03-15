@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-2 py-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white" style="background:#5651A0; border-radius:8px 8px 0 0;">
                    <h5 class="mb-0">
                        <i class="bi bi-mortarboard-fill me-2"></i>Nuevo Nivel de Estudio
                    </h5>
                </div>

                <div class="card-body bg-light p-3 p-md-4">
                    <form action="{{ route('backend.nivel-estudio.store') }}" method="POST" class="bg-white p-3 p-md-4 rounded shadow-sm border">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold small text-uppercase" style="color: #5651A0;">
                                Descripción del Nivel
                            </label>
                            <input type="text" 
                                   name="nombre" 
                                   id="nombre" 
                                   class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                                   placeholder="Ej: Secundario Completo..." 
                                   value="{{ old('nombre') }}"
                                   required 
                                   autofocus>
                            
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text mt-2 small">
                                Use nombres claros y descriptivos para el sistema.
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                            <a href="{{ route('backend.nivel-estudio.index') }}" class="btn btn-outline-secondary px-4 order-last order-sm-first">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn text-white px-4 shadow-sm" style="background:#5651A0;">
                                <i class="bi bi-save me-1"></i> Guardar Nivel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection