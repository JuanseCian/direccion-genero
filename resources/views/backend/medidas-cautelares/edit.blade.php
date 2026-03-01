@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header text-white"
    style="background:#5651A0">

        <h5 class="mb-0">
            Editar Medida Cautelar: {{ $medida->nombre }}
        </h5>

    </div>

    <div class="card-body">

        <form method="POST"
        action="{{ route('medidas-cautelares.update', $medida->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label class="fw-bold mb-1">Nombre</label>

            <input type="text"
            name="nombre"
            class="form-control"
            value="{{ $medida->nombre }}"
            required>

        </div>

        <button class="btn btn-primary">
            <i class="bi bi-check-lg"></i> Actualizar
        </button>

        <a href="{{ route('medidas-cautelares.index') }}"
        class="btn btn-secondary">
            Volver
        </a>

        </form>

    </div>

</div>

@endsection