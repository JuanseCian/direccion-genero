@extends('frontend.layouts.front')

@section('content')
<div class="container-fluid py-4">

    <form method="POST" action="{{ route('denuncias.store') }}">
        @csrf

        {{-- DATOS GENERALES --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-secondary">
                    <i class="bi bi-calendar-event me-2"></i> Datos Generales
                </h6>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Atendido por</label>
                        <input type="text" name="atendido_por" class="form-control">
                    </div>

                </div>

            </div>
        </div>

        {{-- DENUNCIANTE --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-secondary">
                    <i class="bi bi-person me-2"></i> Datos del Denunciante
                </h6>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="denunciante" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Barrio</label>
                        <input type="text" name="barrio" class="form-control">
                    </div>

                </div>

            </div>
        </div>

        {{-- HECHO --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-secondary">
                    <i class="bi bi-exclamation-circle me-2"></i> Datos del Hecho
                </h6>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Agresor</label>
                    <input type="text" name="agresor" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Violencia</label>
                    <input type="text" name="tipo_violencia" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" rows="4" class="form-control"></textarea>
                </div>

            </div>
        </div>

        {{-- BOTONES --}}
        <button class="btn btn-success px-4">
            <i class="bi bi-save"></i> Guardar
        </button>

        <a href="{{ route('denuncias.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>
@endsection