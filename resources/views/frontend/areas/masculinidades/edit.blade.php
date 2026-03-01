@extends('frontend.layouts.front')

@section('title','Editar Legajo - Masculinidades')

@section('content')
<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-pencil-square"></i>
            Editar Legajo #{{ $caso->id }}
        </h2>
        <a href="{{ route('masculinidades.listado') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <form action="{{ route('masculinidades.update', $caso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            {{-- PERSONA (Solo lectura o selección) --}}
            <div class="col-md-6">
                <label class="form-label fw-bold">Persona</label>
                <select name="persona_id" class="form-select" required>
                    @foreach($personas as $persona)
                        <option value="{{ $persona->id }}" {{ $caso->persona_id == $persona->id ? 'selected' : '' }}>
                            {{ $persona->apellido }}, {{ $persona->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Encargado/a</label>
                <select name="encargado_id" class="form-select">
                    @foreach($encargados as $e)
                        <option value="{{ $e->id }}" {{ $caso->encargado_id == $e->id ? 'selected' : '' }}>
                            {{ $e->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr class="my-4">

            {{-- CAMPOS DEL SQL --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">Hijos en Común</label>
                <input type="number" name="hijos_en_comun" class="form-control" value="{{ $caso->hijos_en_comun }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Derivación</label>
                <select name="derivacion_id" class="form-select">
                    @foreach($derivaciones as $d)
                        <option value="{{ $d->id }}" {{ $caso->derivacion_id == $d->id ? 'selected' : '' }}>
                            {{ $d->nombre ?? 'Opción '.$d->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Situación Judicial</label>
                <textarea name="situacion_judicial" class="form-control" rows="2">{{ $caso->situacion_judicial }}</textarea>
            </div>

            {{-- SWITCHES DE ESTADO --}}
            <div class="col-md-12 mt-3">
                <div class="card bg-light p-3 border-0">
                    <div class="row">
                        @php $campos = ['trabaja', 'consumo', 'desobediencia', 'reincidencia', 'terapia']; @endphp
                        @foreach($campos as $campo)
                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="{{ $campo }}" value="1" {{ $caso->$campo ? 'checked' : '' }}>
                                <label class="form-check-label text-capitalize">{{ $campo }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="3">{{ $caso->observaciones }}</textarea>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn text-white px-5 shadow-sm" style="background: #5651A0;">
                <i class="bi bi-check-lg"></i> Actualizar Legajo
            </button>
        </div>
    </form>
</div>
@endsection