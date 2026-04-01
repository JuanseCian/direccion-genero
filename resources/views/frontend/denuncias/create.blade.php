@extends('frontend.layouts.front')

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-sm border-0">

        <div class="card-header text-white" style="background:#5651A0;">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i> Nueva Denuncia
            </h5>
        </div>

        <div class="card-body bg-light">

            <form method="POST" action="{{ route('denuncias.store') }}">
                @csrf

                <div class="row">

                    {{-- FECHA --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>

                    {{-- ATENDIÓ --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Atendió (Nombre)</label>
                        <input type="text" name="atendio_nombre" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Atendió (Apellido)</label>
                        <input type="text" name="atendio_apellido" class="form-control">
                    </div>

                </div>

                <hr>

                {{-- DENUNCIANTE --}}
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="denunciante_nombre" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="denunciante_apellido" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Barrio</label>
                        <input type="text" name="barrio" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>

                </div>

                <hr>

                {{-- AGRESOR --}}
                <div class="mb-3">
                    <label class="form-label">Agresor (Nombre y Apellido)</label>
                    <input type="text" name="agresor" class="form-control">
                </div>

                {{-- TIPO VIOLENCIA --}}
                <div class="mb-3">
                    <label class="form-label">Tipo de Violencia</label>
                    <input type="text" name="tipo_violencia" class="form-control">
                </div>

                {{-- OBSERVACIONES --}}
                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" rows="4" class="form-control"></textarea>
                </div>

                <button class="btn btn-success">
                    <i class="bi bi-save"></i> Guardar
                </button>

                <a href="{{ route('denuncias.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </form>

        </div>
    </div>

</div>
@endsection