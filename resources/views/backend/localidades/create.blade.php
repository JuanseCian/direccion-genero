@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header text-white" 
         style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0">
            <i class="bi bi-geo-alt"></i> Nueva Localidad
        </h5>
    </div>

    <div class="card-body bg-light">

        <form method="POST" action="{{ route('localidades.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nombre de la Localidad</label>
                <input type="text" 
                       name="nombre" 
                       class="form-control border-0 shadow-sm" 
                       placeholder="Ej: San Nicolás de los Arroyos" 
                       required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold text-secondary">Código Postal</label>
                    <input type="text" 
                           name="codigo_postal" 
                           class="form-control border-0 shadow-sm" 
                           placeholder="Ej: 2900" 
                           required>
                </div>

                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold text-secondary">Provincia</label>
                    <select name="provincia_id" class="form-select border-0 shadow-sm" required>
                        <option value="" selected disabled>Seleccione una provincia...</option>
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}">
                                {{ $provincia->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4 border-top pt-3 text-end">
                <a href="{{ route('localidades.index') }}" class="btn btn-outline-secondary px-4 me-2">
                    Cancelar
                </a>
                <button type="submit" class="btn text-white px-4" style="background:#5651A0;">
                    <i class="bi bi-save"></i> Guardar Localidad
                </button>
            </div>

        </form>

    </div>

</div>

@endsection