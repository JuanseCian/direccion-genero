@extends('frontend.layouts.front')

@section('content')
<div class="container-fluid py-4">

    <form method="POST" action="{{ route('denuncias.update',$denuncia->id) }}">
        @csrf
        @method('PUT')

        {{-- DATOS GENERALES --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-secondary">Datos Generales</h6>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Fecha</label>
                        <input type="date" name="fecha" value="{{ $denuncia->fecha }}" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Atendido por</label>
                        <input type="text" name="atendido_por" value="{{ $denuncia->atendido_por }}" class="form-control text-uppercase">
                    </div>

                </div>
            </div>
        </div>

        {{-- DENUNCIANTE --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-secondary">Denunciante</h6>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Nombre</label>
                        <input type="text" name="denunciante" value="{{ $denuncia->denunciante }}" class="form-control text-uppercase">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>DNI</label>
                        <input type="text" name="dni" value="{{ $denuncia->dni }}" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Edad</label>
                        <input type="number" name="edad" min="0" max="120" value="{{ $denuncia->edad }}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" value="{{ $denuncia->telefono }}" class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Dirección</label>
                        <input type="text" name="direccion" value="{{ $denuncia->direccion }}" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Barrio</label>
                        <input type="text" name="barrio" value="{{ $denuncia->barrio }}" class="form-control">
                    </div>

                </div>

            </div>
        </div>

        {{-- HECHO --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-secondary">Hecho</h6>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label>Agresor</label>
                    <input type="text" name="agresor" value="{{ $denuncia->agresor }}" class="form-control text-uppercase">
                </div>

                <div class="mb-3">
                    <label>Tipo de Violencia</label>
                    <input type="text" name="tipo_violencia" value="{{ $denuncia->tipo_violencia }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tipo de Amenaza</label>
                    <input type="text" name="tipo_amenaza" value="{{ $denuncia->tipo_amenaza }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control">{{ $denuncia->observaciones }}</textarea>
                </div>

            </div>
        </div>

        <button class="btn btn-success">
            Guardar cambios
        </button>

        <a href="{{ route('denuncias.index') }}" class="btn btn-secondary">
            Volver
        </a>

    </form>

</div>
@endsection
