@extends('frontend.layouts.front')

@section('title','Nuevo Legajo - Masculinidades')

@section('content')
<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-person-plus-fill"></i>
            Nuevo Legajo de Masculinidades
        </h2>
        <a href="{{ route('masculinidades.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('masculinidades.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            {{-- DATOS FILTRADOS POR SEXO MASCULINO --}}
            <div class="col-md-6">
                <label class="form-label fw-bold">Persona (Solo Masculinos)</label>
                <select name="persona_id" class="form-select @error('persona_id') is-invalid @enderror" required>
                    <option value="">Seleccione una persona...</option>
                    @foreach($personas as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->apellido }}, {{ $persona->nombre }} ({{ $persona->dni }})</option>
                    @endforeach
                </select>
                @error('persona_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Encargado/a</label>
                <select name="encargado_id" class="form-select">
                    <option value="">Seleccione encargado...</option>
                    @foreach($encargados as $encargado)
                        <option value="{{ $encargado->id }}">{{ $encargado->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <hr class="my-4">

            {{-- CAMPOS ESPECÍFICOS DEL SQL --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">Derivación</label>
                <select name="derivacion_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($derivaciones as $d)
                        <option value="{{ $d->id }}">{{ $d->nombre ?? 'Opción '.$d->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Situación Habitacional</label>
                <select name="situacion_habitacional_id" class="form-select">
                    <option value="">Seleccione...</option>
                    @foreach($situacionesHabitacionales as $sh)
                        <option value="{{ $sh->id }}">{{ $sh->nombre ?? 'Opción '.$sh->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Hijos en común</label>
                <input type="number" name="hijos_en_comun" class="form-control" value="0">
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Situación Judicial</label>
                <textarea name="situacion_judicial" class="form-control" rows="2" placeholder="Describa el estado de la causa..."></textarea>
            </div>

            {{-- CHECKBOXES DE COMPORTAMIENTO --}}
            <div class="col-md-12 mt-3">
                <div class="card bg-light p-3 border-0">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="trabaja" value="1">
                                <label class="form-check-label">¿Trabaja?</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="consumo" value="1">
                                <label class="form-check-label">¿Consumo?</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="desobediencia" value="1">
                                <label class="form-check-label">¿Desobediencia?</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="terapia" value="1">
                                <label class="form-check-label">¿Terapia?</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn text-white px-5 shadow-sm" style="background: #5651A0;">
                <i class="bi bi-save"></i> Guardar Legajo
            </button>
        </div>
    </form>
</div>
@endsection