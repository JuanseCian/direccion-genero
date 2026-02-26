@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header text-white"
    style="background:#5651A0">

        <h5 class="mb-0">
            Nuevo Barrio
        </h5>

    </div>


    <div class="card-body">

        <form method="POST"
        action="{{ route('barrios.store') }}">

        @csrf


        <div class="mb-3">

            <label>Nombre</label>

            <input type="text"
            name="nombre"
            class="form-control"
            required>

        </div>


        <div class="mb-3">

            <label>Localidad</label>

            <select name="localidad_id" class="form-control" required>

                @foreach($localidades as $localidad)

                    <option value="{{ $localidad->id }}">
                        {{ $localidad->nombre }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="mb-3">

            <label>Zona</label>

            <select name="zona_barrio_id"
            class="form-control"
            required>

                <option value="">
                    Seleccionar zona
                </option>

                @foreach($zonas as $zona)

                <option value="{{ $zona->id }}">
                    {{ $zona->nombre }}
                </option>

                @endforeach

            </select>

        </div>


        <button class="btn btn-primary">
            Guardar
        </button>

        <a href="{{ route('barrios.index') }}"
        class="btn btn-secondary">

            Volver

        </a>

        </form>

    </div>

</div>

@endsection