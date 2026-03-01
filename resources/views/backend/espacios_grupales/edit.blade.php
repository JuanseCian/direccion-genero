@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header text-white"
    style="background:#5651A0">

        <h5 class="mb-0">
            Editar Espacio Grupal: {{ $espacio->nombre }}
        </h5>

    </div>

    <div class="card-body">

        <form method="POST"
        action="{{ route('espacios-grupales.update', $espacio->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Nombre</label>

            <input type="text"
            name="nombre"
            class="form-control"
            value="{{ $espacio->nombre }}"
            required>

        </div>

        <button class="btn btn-primary">
            Actualizar
        </button>

        <a href="{{ route('espacios-grupales.index') }}"
        class="btn btn-secondary">
            Volver
        </a>

        </form>

    </div>

</div>

@endsection