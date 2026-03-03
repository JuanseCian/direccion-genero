@extends('frontend.layouts.front')

@section('title','Editar Caso - Masculinidades')

@section('content')
<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-pencil-square"></i>
            Editar Caso #{{ $caso->id }}
        </h2>
        <a href="{{ route('masculinidades.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('masculinidades.update', $caso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">

            {{-- AGRESOR --}}
            <h3>Información Agresor</h3>

            <div class="col-md-6">
                <label class="form-label fw-bold">Agresor</label>
                <select name="persona_id" class="form-select" required>
                    @foreach($agresores as $agresor)
                        <option value="{{ $agresor->id }}"
                            {{ $caso->persona_id == $agresor->id ? 'selected' : '' }}>
                            {{ $agresor->apellido }}, {{ $agresor->nombre }} ({{ $agresor->dni }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Encargado/a</label>
                <select name="encargado_id" class="form-select">
                    <option value="">Seleccione...</option>
                    @foreach($encargados as $encargado)
                        <option value="{{ $encargado->id }}"
                            {{ $caso->encargado_id == $encargado->id ? 'selected' : '' }}>
                            {{ $encargado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Derivación</label>
                <select name="derivacion_id" class="form-select">
                    @foreach($derivaciones as $d)
                        <option value="{{ $d->id }}"
                            {{ $caso->derivacion_id == $d->id ? 'selected' : '' }}>
                            {{ $d->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Situación Habitacional</label>
                <select name="situacion_habitacional_id" class="form-select">
                    <option value="">Seleccione...</option>
                    @foreach($situacionesHabitacionales as $sh)
                        <option value="{{ $sh->id }}"
                            {{ $caso->situacion_habitacional_id == $sh->id ? 'selected' : '' }}>
                            {{ $sh->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Espacio Grupal</label>
                <select name="espacio_grupal_id" class="form-select">
                    <option value="">Seleccione...</option>
                    @foreach($espaciosGrupales as $espacio)
                        <option value="{{ $espacio->id }}"
                            {{ $caso->espacio_grupal_id == $espacio->id ? 'selected' : '' }}>
                            {{ $espacio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- VIOLENCIA --}}
            <div class="col-md-12">
                <label class="form-label fw-bold">Violencia ejercida</label>
                <div class="row">
                    @foreach($tipoViolencia as $tipo)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="tipo_violencia_id[]"
                                       value="{{ $tipo->id }}"
                                       {{ $caso->tiposViolencia->contains($tipo->id) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $tipo->nombre }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Reincidencia</label>
                <input type="number" name="reincidencia" class="form-control"
                       value="{{ $caso->reincidencia }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Asistencia al dispositivo</label>
                <input type="number" name="asistencia_dispositivo"
                       class="form-control"
                       value="{{ $caso->asistencia_dispositivo }}">
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Situación Judicial</label>
                <textarea name="situacion_judicial"
                          class="form-control"
                          rows="2">{{ $caso->situacion_judicial }}</textarea>
            </div>

            {{-- CHECKS --}}
            <div class="col-md-12 mt-3">
                <div class="card bg-light p-3 border-0">
                    <div class="row">
                        @foreach(['trabaja','consumo','desobediencia','terapia'] as $campo)
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="{{ $campo }}"
                                       value="1"
                                       {{ $caso->$campo ? 'checked' : '' }}>
                                <label class="form-check-label text-capitalize">
                                    {{ $campo }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- RELACIÓN ACTUAL --}}
            <hr class="my-4">

            <div class="col-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="relacion_actual"
                           value="1"
                           id="relacionActualSwitch"
                           {{ $caso->relacion_actual ? 'checked' : '' }}>
                    <label class="form-check-label">
                        ¿Tienen relación actualmente?
                    </label>
                </div>
            </div>

            <div class="col-md-4"
                 id="tipoRelacionContainer"
                 style="{{ $caso->relacion_actual ? '' : 'display:none;' }}">
                <label class="form-label">Descripción de la relación</label>
                <input type="text"
                       name="descripcion_relacion"
                       class="form-control"
                       value="{{ $caso->descripcion_relacion }}">
            </div>

            {{-- MEDIDAS --}}
            <div class="col-md-12">
                <label class="form-label fw-bold">Medidas Cautelares</label>
                <div class="row">
                    @foreach($medidasCautelares as $medida)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="medida_id[]"
                                       value="{{ $medida->id }}"
                                       {{ $caso->medidas->contains($medida->id) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $medida->nombre }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- OBSERVACIONES --}}
            <div class="col-md-12">
                <label class="form-label fw-bold">Observaciones</label>
                <textarea name="observaciones"
                          class="form-control"
                          rows="3">{{ $caso->observaciones }}</textarea>
            </div>

        </div>

        <div class="text-end mt-4">
            <button type="submit"
                    class="btn text-white px-5 shadow-sm"
                    style="background: #5651A0;">
                Actualizar Caso
            </button>
        </div>
    </form>
</div>
@endsection