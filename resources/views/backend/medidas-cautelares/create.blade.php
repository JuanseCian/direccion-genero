@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header text-white"
    style="background:#5651A0">

        <h5 class="mb-0">
            Nueva Medida Cautelar
        </h5>

    </div>

    <div class="card-body">

        <form method="POST"
        action="{{ route('medidas-cautelares.store') }}">

        @csrf

        <div class="mb-3">

            <label class="fw-bold mb-1">Nombre</label>

            <input type="text"
            name="nombre"
            class="form-control"
            placeholder="Ingrese el nombre (ej: Perímetros, Botón de pánico)"
            required>

        </div>

        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Guardar
        </button>

        <a href="{{ route('medidas-cautelares.index') }}"
        class="btn btn-secondary">
            Volver
        </a>

        </form>

    </div>

</div>

@endsection