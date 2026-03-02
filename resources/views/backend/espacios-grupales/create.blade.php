@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header text-white"
    style="background:#5651A0">

        <h5 class="mb-0">
            Nuevo Espacio Grupal
        </h5>

    </div>

    <div class="card-body">

        <form method="POST"
        action="{{ route('espacios-grupales.store') }}">

        @csrf

        <div class="mb-3">

            <label>Nombre</label>

            <input type="text"
            name="nombre"
            class="form-control"
            placeholder="Ingrese el nombre del espacio (ej: Club, Religión)"
            required>

        </div>

        <button class="btn btn-primary">
            Guardar
        </button>

        <a href="{{ route('espacios-grupales.index') }}"
        class="btn btn-secondary">
            Volver
        </a>

        </form>

    </div>

</div>

@endsection