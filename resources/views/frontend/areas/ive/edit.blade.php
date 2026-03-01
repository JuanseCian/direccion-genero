@extends('frontend.layouts.front')

@section('title','Editar Atención IVE')

@section('content')
<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-pencil-square"></i> Editar Legajo IVE: {{ $caso->persona->apellido }}, {{ $caso->persona->nombre }}
        </h2>
        <a href="{{ route('frontend.areas.ive.listado') }}" class="btn btn-light border-0">
            <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <form action="{{ route('frontend.areas.ive.update', $caso->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-3">
            {{-- SECCIÓN: Identificación (Lectura o Cambio) --}}
            <div class="col-12">
                <div class="p-3 rounded" style="background: #ecebfa; color: #5651A0;">
                    <label class="fw-bold mb-2">Persona Vinculada</label>
                    <select name="persona_id" class="form-select border-0 shadow-sm" required>
                        @foreach($personas as $persona)
                            <option value="{{ $persona->id }}" {{ $caso->persona_id == $persona->id ? 'selected' : '' }}>
                                {{ $persona->nombre }} {{ $persona->apellido }} (DNI: {{ $persona->dni }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- SECCIÓN: Datos Médicos --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">Fecha de Última Menstruación (FUM)</label>
                <input type="date" name="fum" class="form-control border-0 shadow-sm" value="{{ $caso->fum }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Semanas (ECO)</label>
                <input type="number" name="eco_semanas" class="form-control border-0 shadow-sm" value="{{ $caso->eco_semanas }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold text-success">Fecha de Alta / Cierre</label>
                <input type="date" name="alta" class="form-control border-0 shadow-sm border-start border-success border-3" value="{{ $caso->alta }}">
                <small class="text-muted">Completar solo al finalizar el acompañamiento.</small>
            </div>

            {{-- SECCIÓN: Antecedentes y Social --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">Cantidad de Hijos</label>
                <input type="number" name="cantidad_hijos" class="form-control border-0 shadow-sm" value="{{ $caso->cantidad_hijos }}">
            </div>

            <div class="col-md-4 mt-auto">
                <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input" type="checkbox" name="obra_social" value="1" id="os" {{ $caso->obra_social ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="os">¿Posee Obra Social?</label>
                </div>
            </div>

            <div class="col-md-4 mt-auto">
                <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input" type="checkbox" name="interrupcion_previa" value="1" id="ip" {{ $caso->interrupcion_previa ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="ip">Interrupción Previa</label>
                </div>
            </div>
            <div class="mb-3">
                <label>Encargado</label>
                <select name="encargado_id" class="form-control">
                    <option value="">Seleccionar Encargado</option>

                    @foreach($encargados as $encargado)
                    <option value="{{ $encargado->id }}"
                        {{ $legajo->encargado_id == $encargado->id ? 'selected' : '' }}>
                        {{ $encargado->apellido }} {{ $encargado->nombre }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="col-12 mt-4 text-end">
                <hr style="opacity: 0.1;">
                <button type="submit" class="btn text-white px-5 py-2 shadow-sm" style="background: #5651A0;">
                    <i class="bi bi-check-circle"></i> Actualizar Cambios
                </button>
            </div>
        </div>
    </form>
</div>
@endsection