@extends('frontend.layouts.front')

@section('title','Editar Intervención - IVE')

@section('content')

<div class="container-fluid py-4">

    {{-- CABECERA --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-0" style="color:#5651A0;">
                <i class="bi bi-pencil-square"></i>
                Editar Intervención
            </h2>

            <p class="text-muted">
                Caso: 
                <strong>
                    {{ $intervencion->caso->persona->apellido }},
                    {{ $intervencion->caso->persona->nombre }}
                </strong>
            </p>
        </div>

        <a href="{{ route('frontend.areas.ive.edit',$intervencion->ive_caso_id) }}"
           class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i>
            Volver al Caso
        </a>

    </div>


    <form method="POST"
          action="{{ route('frontend.areas.ive.intervenciones.update',$intervencion->id) }}">

        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0 text-primary">
                    <i class="bi bi-pencil"></i>
                    Modificar Intervención
                </h5>

            </div>


            <div class="card-body">

                <div class="row g-3">

                    {{-- FECHA --}}
                    <div class="col-md-4">

                        <label class="form-label fw-bold">
                            Fecha de intervención
                        </label>

                        <input type="date"
                               name="fecha_intervencion"
                               class="form-control shadow-sm"
                               value="{{ $intervencion->fecha_intervencion }}"
                               required>

                    </div>


                    {{-- TIPO --}}
                    <div class="col-md-4">

                        <label class="form-label fw-bold">
                            Tipo de intervención
                        </label>

                        <select name="tipo_intervencion_id"
                                class="form-select shadow-sm"
                                required>

                            @foreach($tiposIntervencion as $tipo)

                                <option value="{{ $tipo->id }}"
                                    {{ $intervencion->tipo_intervencion_id == $tipo->id ? 'selected' : '' }}>

                                    {{ $tipo->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- PROFESIONAL --}}
                    <div class="col-md-4">

                        <label class="form-label fw-bold">
                            Profesional
                        </label>

                        <select name="encargado_id"
                                class="form-select shadow-sm"
                                required>

                            @foreach($encargados as $encargado)

                                <option value="{{ $encargado->id }}"
                                {{ $intervencion->encargado_id == $encargado->id ? 'selected' : '' }}>

                                    {{ $encargado->apellido }}
                                    {{ $encargado->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- DETALLE --}}
                    <div class="col-md-12">

                        <label class="form-label fw-bold">
                            Detalle
                        </label>

                        <textarea name="detalle" rows="4" class="form-control shadow-sm">{{ $intervencion->detalle }}</textarea>

                    </div>

                </div>

            </div>


            <div class="card-footer bg-white text-end">

                <button class="btn text-white px-4 shadow-sm"
                        style="background:#5651A0;">

                    <i class="bi bi-save"></i>
                    Actualizar Intervención

                </button>

            </div>

        </div>

    </form>

</div>

@endsection