@extends('frontend.layouts.front')

@section('title','Editar Caso - Masculinidades')

@section('content')

<div class="container-fluid py-4">

    {{-- CABECERA --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0" style="color:#5651A0;">
                <i class="bi bi-pencil-square"></i> Editar Caso
            </h2>
            <p class="text-muted">
                {{ $caso->persona->apellido }}, {{ $caso->persona->nombre }}
            </p>
        </div>

        <div>
            <a href="{{ route('masculinidades.index') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <form action="{{ route('masculinidades.update', $caso->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- 1. IDENTIFICACIÓN --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary">
                    <i class="bi bi-person-badge me-2"></i>1. Identificación del Agresor y Responsables
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Agresor</label>
                        {{-- Se mantiene disabled para no cambiar la persona raíz del caso, pero se envía un hidden si es necesario --}}
                        <select class="form-select bg-light" disabled>
                            <option selected>{{ $caso->persona->apellido }}, {{ $caso->persona->nombre }} ({{ $caso->persona->dni }})</option>
                        </select>
                        <input type="hidden" name="persona_id" value="{{ $caso->persona_id }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Profesional a Cargo</label>
                        <select name="encargado_id" class="form-select border-primary-subtle select2-init">
                            <option value="">Seleccione...</option>
                            @foreach($encargados as $encargado)
                                <option value="{{ $encargado->id }}" {{ $caso->encargado_id == $encargado->id ? 'selected' : '' }}>
                                    {{ $encargado->apellido }}, {{ $encargado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($caso->persona && $caso->persona->cud)
                <div class="mt-3">
                    @php
                        $cud = $caso->persona->cud;
                        $vencido = $cud->fecha_vencimiento && \Carbon\Carbon::parse($cud->fecha_vencimiento)->isPast();
                    @endphp
                    <div class="alert d-flex justify-content-between align-items-center shadow-sm" style="background:#f0f7ff;border-left:5px solid #0d6efd;">
                        <div>
                            <strong class="text-primary"><i class="bi bi-person-wheelchair me-2"></i>CUD</strong>
                            <div class="small mt-1">
                                <strong>N°:</strong> {{ $cud->numero_cud ?? '—' }} | 
                                <strong>Vencimiento:</strong> {{ $cud->fecha_vencimiento ? \Carbon\Carbon::parse($cud->fecha_vencimiento)->format('d/m/Y') : '—' }}
                            </div>
                        </div>
                        <span class="badge {{ $vencido ? 'bg-danger' : 'bg-success' }} fs-6">
                            {{ $vencido ? 'CUD Vencido' : 'CUD Vigente' }}
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- 2. CONTEXTO --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 text-primary">
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>2. Contexto del Caso</h5>
            </div>
            <div class="card-body bg-light-subtle">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Derivación</label>
                        <select name="derivacion_id" class="form-select">
                            @foreach($derivaciones as $d)
                                <option value="{{ $d->id }}" {{ $caso->derivacion_id == $d->id ? 'selected' : '' }}>{{ $d->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Situación Habitacional</label>
                        <select name="situacion_habitacional_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($situacionesHabitacionales as $sh)
                                <option value="{{ $sh->id }}" {{ $caso->situacion_habitacional_id == $sh->id ? 'selected' : '' }}>{{ $sh->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Espacio Grupal</label>
                        <select name="espacio_grupal_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($espaciosGrupales as $espacio)
                                <option value="{{ $espacio->id }}" {{ $caso->espacio_grupal_id == $espacio->id ? 'selected' : '' }}>{{ $espacio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 my-3">
                        <div class="p-3 border rounded bg-white shadow-sm">
                            <label class="form-label fw-bold text-danger"><i class="bi bi-exclamation-triangle"></i> Tipos de Violencia Ejercida</label>
                            <div class="row">
                                @foreach($tipoViolencia as $tipo)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tipo_violencia_id[]" value="{{ $tipo->id }}" {{ $caso->tiposViolencia->contains($tipo->id) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $tipo->nombre }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Reincidencia</label>
                        <input type="number" name="reincidencia" class="form-control" value="{{ $caso->reincidencia }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">¿Debe realizar el dispositivo?</label>
                        <select name="debe_dispositivo" id="debeDispositivo" class="form-select">
                            <option value="1" {{ $caso->debe_dispositivo == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ $caso->debe_dispositivo == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div id="camposDispositivo" class="row col-md-12 mt-2" style="{{ $caso->debe_dispositivo == 1 ? '' : 'display:none;' }}">
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Asistencia al dispositivo</label>
                            <select name="asistencia_dispositivo" class="form-select">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ $caso->asistencia_dispositivo == 1 ? 'selected' : '' }}>Asistencia regular</option>
                                <option value="2" {{ $caso->asistencia_dispositivo == 2 ? 'selected' : '' }}>Asistencia irregular</option>
                                <option value="3" {{ $caso->asistencia_dispositivo == 3 ? 'selected' : '' }}>Abandonó</option>
                                <option value="4" {{ $caso->asistencia_dispositivo == 4 ? 'selected' : '' }}>Finalizado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Fecha de Finalización</label>
                            <input type="date" name="fecha_finalizacion" class="form-control" value="{{ $caso->fecha_finalizacion }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- COMPORTAMIENTOS (SWITCHES) --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row g-2 p-3 rounded border bg-white shadow-sm">
                    <div class="col-md-3 border-end">
                        <div class="form-check form-switch text-center">
                            <input class="form-check-input" type="checkbox" name="trabaja" value="1" id="trabajaSwitch" {{ $caso->trabaja ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold">¿Trabaja?</label>
                        </div>
                        <div id="detalleTrabajoContainer" class="mt-2" style="{{ $caso->trabaja ? '' : 'display:none;' }}">
                            <input type="text" name="detalle_trabajo" class="form-control form-control-sm" placeholder="¿Dónde?" value="{{ $caso->detalle_trabajo }}">
                        </div>
                    </div>
                    <div class="col-md-3 border-end text-center">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input" type="checkbox" name="consumo" value="1" {{ $caso->consumo ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-warning">¿Consumo?</label>
                        </div>
                    </div>
                    <div class="col-md-3 border-end text-center">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input" type="checkbox" name="terapia" value="1" {{ $caso->terapia ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-success">¿En Terapia?</label>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input" type="checkbox" name="desobediencia" value="1" {{ $caso->desobediencia ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-danger">¿Desobediencia?</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTÓN ACTUALIZAR --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-footer bg-white text-end py-3">
                <button type="submit" class="btn btn-lg text-white px-5 shadow-sm" style="background:#5651A0">
                    <i class="bi bi-save-fill me-2"></i> ACTUALIZAR CASO
                </button>
            </div>
        </div>

    </form>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Inicializar Select2 para el encargado
    $('.select2-init').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Seleccione profesional...'
    });

    // Toggle para campos de dispositivo
    $('#debeDispositivo').change(function() {
        if ($(this).val() == '1') {
            $('#camposDispositivo').fadeIn();
        } else {
            $('#camposDispositivo').hide();
        }
    });

    // Toggle para detalle de trabajo
    $('#trabajaSwitch').change(function() {
        if ($(this).is(':checked')) {
            $('#detalleTrabajoContainer').fadeIn();
        } else {
            $('#detalleTrabajoContainer').hide();
        }
    });
});
</script>
@endsection