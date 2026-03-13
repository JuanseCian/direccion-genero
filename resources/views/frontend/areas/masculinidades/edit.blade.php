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
            {{-- Se eliminó el botón del Modal de Intervenciones --}}
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
                        <select name="persona_id" class="form-select" disabled>
                            @foreach($agresores as $agresor)
                                <option value="{{ $agresor->id }}" {{ $caso->persona_id == $agresor->id ? 'selected' : '' }}>
                                    {{ $agresor->apellido }}, {{ $agresor->nombre }} ({{ $agresor->dni }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Profesional a Cargo</label>
                            <select name="encargado_id" class="form-select border-primary-subtle select2-init">
                                <option value="">Seleccione...</option>
                                @foreach($encargados as $encargado)
                                    <option value="{{ $encargado->id }}" {{ (isset($caso) && $caso->encargado_id == $encargado->id) ? 'selected' : '' }}>
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
                        $vencido = $cud->fecha_vencimiento 
                                    && \Carbon\Carbon::parse($cud->fecha_vencimiento)->isPast();
                    @endphp

                    <div class="alert d-flex justify-content-between align-items-center shadow-sm"
                        style="background:#f0f7ff;border-left:5px solid #0d6efd;">

                        <div>

                            <strong class="text-primary">
                                <i class="bi bi-person-wheelchair me-2"></i>
                                Certificado Único de Discapacidad (CUD)
                            </strong>

                            <div class="small mt-1">

                                <strong>N°:</strong>
                                {{ $cud->numero_cud ?? '—' }}

                                <br>

                                <strong>Emisión:</strong>
                                {{ $cud->fecha_emision 
                                    ? \Carbon\Carbon::parse($cud->fecha_emision)->format('d/m/Y') 
                                    : '—' }}

                                <br>

                                <strong>Vencimiento:</strong>
                                {{ $cud->fecha_vencimiento 
                                    ? \Carbon\Carbon::parse($cud->fecha_vencimiento)->format('d/m/Y') 
                                    : '—' }}

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
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary">
                    <i class="bi bi-journal-text me-2"></i>2. Contexto del Caso
                </h5>
            </div>
            <div class="card-body bg-light-subtle">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Derivación</label>
                        <select name="derivacion_id" class="form-select">
                            @foreach($derivaciones as $d)
                                <option value="{{ $d->id }}" {{ $caso->derivacion_id == $d->id ? 'selected' : '' }}>
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
                                <option value="{{ $sh->id }}" {{ $caso->situacion_habitacional_id == $sh->id ? 'selected' : '' }}>
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
                                <option value="{{ $espacio->id }}" {{ $caso->espacio_grupal_id == $espacio->id ? 'selected' : '' }}>
                                    {{ $espacio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- VIOLENCIA --}}
                    <div class="col-md-12 my-3">
                        <div class="p-3 border rounded bg-white shadow-sm">
                            <label class="form-label fw-bold text-danger">
                                <i class="bi bi-exclamation-triangle"></i> Tipos de Violencia Ejercida
                            </label>
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

                    <div class="card shadow-sm border-0 mb-4 border-start border-info">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 text-info"><i class="bi bi-gear-fill me-2"></i>Estado del Dispositivo</h5>
                        </div>
                        @if($historial->count() > 0)
                        <div class="alert alert-warning border-0 shadow-sm mb-4">
                            <h6 class="fw-bold"><i class="bi bi-clock-history"></i> Historial de este Agresor:</h6>
                            <ul class="mb-0 small">
                                @foreach($historial as $h)
                                    <li>
                                        <strong>Caso #{{ $h->id }}:</strong> 
                                        Ingresó el {{ $h->created_at->format('d/m/Y') }} - 
                                        Estado: {{ $h->asistencia_dispositivo == 4 ? 'Finalizado' : ($h->asistencia_dispositivo == 3 ? 'Abandonó' : 'Otro') }}
                                        @if($h->fecha_finalizacion) (Cerrado el {{ \Carbon\Carbon::parse($h->fecha_finalizacion)->format('d/m/Y') }}) @endif
                                        <a href="{{ route('masculinidades.edit', $h->id) }}" class="ms-2 text-decoration-none">Ver antecedente</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="row g-3">
                                {{-- Pregunta principal --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary">¿Debe realizar el dispositivo?</label>
                                    <select name="debe_dispositivo" id="debeDispositivoEdit" class="form-select border-info">
                                        <option value="0" {{ $caso->debe_dispositivo == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $caso->debe_dispositivo == 1 ? 'selected' : '' }}>Sí</option>
                                    </select>
                                </div>

                                {{-- Campos condicionales (Solo si debe realizarlo) --}}
                                <div class="col-md-4" id="camposAsistencia" style="{{ $caso->debe_dispositivo == 1 ? '' : 'display:none;' }}">
                                    <label class="form-label fw-bold">Estado de Asistencia</label>
                                    <select name="asistencia_dispositivo" id="asistenciaSelect" class="form-select">
                                        <option value="1" {{ $caso->asistencia_dispositivo == 1 ? 'selected' : '' }}>Asistencia regular</option>
                                        <option value="2" {{ $caso->asistencia_dispositivo == 2 ? 'selected' : '' }}>Asistencia irregular</option>
                                        <option value="3" {{ $caso->asistencia_dispositivo == 3 ? 'selected' : '' }}>Abandonó</option>
                                        <option value="4" {{ $caso->asistencia_dispositivo == 4 ? 'selected' : '' }}>Finalizado</option>
                                    </select>
                                </div>

                                {{-- Fecha de Finalización (Solo si Abandonó o Finalizó) --}}
                                <div class="col-md-4" id="divFechaFin" style="{{ in_array($caso->asistencia_dispositivo, [3,4]) ? '' : 'display:none;' }}">
                                    <label class="form-label fw-bold text-danger">Fecha de Cierre/Finalización</label>
                                    <input type="date" name="fecha_finalizacion" class="form-control border-danger" 
                                        value="{{ $caso->fecha_finalizacion ? \Carbon\Carbon::parse($caso->fecha_finalizacion)->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                        
                    {{-- NIVEL DE ESTUDIO Y ESTADO CIVIL --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Nivel de Estudio</label>
                        <select name="nivel_estudio_id" class="form-select shadow-sm">
                            <option value="">Seleccione...</option>
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}" {{ $caso->nivel_estudio_id == $nivel->id ? 'selected' : '' }}>
                                    {{ $nivel->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Estado Civil</label>
                        <select name="estado_civil_id" class="form-select shadow-sm">
                            <option value="">Seleccione...</option>
                            @foreach($estadosCiviles as $estado)
                                <option value="{{ $estado->id }}" {{ $caso->estado_civil_id == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- MEDIDAS CAUTELARES --}}
                    <div class="col-12 mt-4">
                        <div class="p-4 border rounded bg-white shadow-sm border-start border-warning border-3">
                            <div class="row g-4">
                                
                                {{-- Medidas Aplicadas --}}
                                <div class="col-md-6 border-end">
                                    <label class="form-label fw-bold text-warning mb-3 fs-6">
                                        <i class="bi bi-shield-lock-fill me-2"></i> Medidas Cautelares Aplicadas
                                    </label>
                                    <div class="d-flex flex-column gap-2">
                                        @forelse($caso->medidas as $medida)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="medida_id[]" id="medida_ap_{{ $medida->id }}" value="{{ $medida->id }}" checked>
                                                <label class="form-check-label" for="medida_ap_{{ $medida->id }}">
                                                    {{ $medida->nombre }}
                                                </label>
                                            </div>
                                        @empty
                                            <span class="text-muted small fst-italic">Ninguna medida aplicada.</span>
                                        @endforelse
                                    </div>
                                </div>

                                {{-- Agregar Nuevas Medidas --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary mb-3 fs-6">
                                        <i class="bi bi-plus-circle me-2"></i> Agregar nuevas medidas
                                    </label>
                                    {{-- Le agregamos un scroll interno por si la lista de medidas es muy larga --}}
                                    <div class="d-flex flex-column gap-2" style="max-height: 180px; overflow-y: auto;">
                                        @foreach($medidasCautelares as $medida)
                                            @if(!$caso->medidas->contains($medida->id))
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="medida_id[]" id="medida_nu_{{ $medida->id }}" value="{{ $medida->id }}">
                                                    <label class="form-check-label" for="medida_nu_{{ $medida->id }}">
                                                        {{ $medida->nombre }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- COMPORTAMIENTOS Y CONDICIONES --}}
                    <div class="col-md-12 mt-3">
                        <label class="form-label fw-bold text-secondary text-uppercase small">
                            Comportamientos y Condiciones
                        </label>

                        <div class="row g-2 p-3 rounded border bg-white shadow-sm">

                            {{-- TRABAJA --}}
                            <div class="col-md-4 border-end">
                                <div class="text-center">
                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="trabaja"
                                            value="1"
                                            id="trabajaSwitch"
                                            {{ $caso->trabaja ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold">
                                            ¿Trabaja?
                                        </label>
                                    </div>
                                </div>

                                <div id="detalleTrabajoContainer"
                                    class="mt-2 px-2"
                                    style="{{ $caso->trabaja ? '' : 'display:none;' }}">

                                    <input type="text"
                                        name="detalle_trabajo"
                                        class="form-control form-control-sm"
                                        placeholder="¿Dónde o de qué trabaja?"
                                        value="{{ $caso->detalle_trabajo }}">
                                </div>
                            </div>

                            {{-- CONSUMO --}}
                            <div class="col-md-4 border-end text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="consumo"
                                        value="1"
                                        {{ $caso->consumo ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-warning">
                                        ¿Consumo?
                                    </label>
                                </div>
                            </div>

                            {{-- TERAPIA --}}
                            <div class="col-md-4 text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="terapia"
                                        value="1"
                                        {{ $caso->terapia ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-success">
                                        ¿En Terapia?
                                    </label>
                                </div>
                            </div>

                            {{-- DESOBEDIENCIA --}}
                            <div class="col-12 border-top mt-2 pt-2 text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="desobediencia"
                                        value="1"
                                        {{ $caso->desobediencia ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-danger">
                                        ¿Desobediencia?
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. GRUPO CONVIVIENTE --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-people me-2"></i>3. Grupo Conviviente</h5>
                <button type="button" class="btn btn-sm btn-primary" onclick="agregarFamiliar()">
                    <i class="bi bi-plus-circle"></i> Añadir Integrante
                </button>
            </div>
            <div class="card-body">
                <div id="grupoFamiliarContainer">

                    @if($caso->grupoFamiliar->count() == 0)
                    <p class="text-muted small text-center italic py-2">
                        No hay integrantes registrados en este formulario.
                    </p>
                    @endif

                    @foreach($caso->grupoFamiliar as $idx => $f)

                    <div class="card p-3 mt-3 border shadow-sm">
                        <div class="row g-2">

                            <div class="col-md-2">
                                <input type="text" name="grupo[{{$idx}}][nombre]"
                                class="form-control"
                                value="{{ $f->nombre }}"
                                placeholder="Nombre">
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="grupo[{{$idx}}][apellido]"
                                class="form-control"
                                value="{{ $f->apellido }}"
                                placeholder="Apellido">
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="grupo[{{$idx}}][dni]"
                                class="form-control"
                                value="{{ $f->dni }}"
                                placeholder="DNI">
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="grupo[{{$idx}}][telefono]"
                                class="form-control"
                                value="{{ $f->telefono }}"
                                placeholder="Teléfono">
                            </div>

                            <div class="col-md-2">
                                <select name="grupo[{{$idx}}][vinculo]" class="form-select">
                                    <option value="">Vínculo</option>
                                    <option value="padre" {{ $f->vinculo_actual=='padre'?'selected':'' }}>Padre</option>
                                    <option value="madre" {{ $f->vinculo_actual=='madre'?'selected':'' }}>Madre</option>
                                    <option value="hijo/a" {{ $f->vinculo_actual=='hijo/a'?'selected':'' }}>Hijo/a</option>
                                    <option value="hermano/a" {{ $f->vinculo_actual=='hermano/a'?'selected':'' }}>Hermano/a</option>
                                    <option value="otro" {{ $f->vinculo_actual=='otro'?'selected':'' }}>Otro</option>
                                </select>
                            </div>

                            <div class="col-md-1 text-end">
                                <button type="button"
                                class="btn btn-outline-danger btn-sm"
                                onclick="this.closest('.card').remove()">
                                <i class="bi bi-trash"></i>
                                </button>
                            </div>

                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>

        {{-- 4. VÍCTIMAS VINCULADAS --}}
        <div class="card shadow-sm border-0 mb-4 border-start border-4" style="border-color: #e83e8c !important;">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="color: #e83e8c;">
                    <i class="bi bi-person-heart me-2"></i>4. Víctimas Vinculadas
                </h5>
                <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#modalVictimas">
                    <i class="bi bi-plus-circle me-1"></i> Vincular Víctima
                </button>
            </div>
            <div class="card-body">
                <div id="lista-victimas" class="row g-3">
                    @foreach($caso->victimas as $victima)
                        <div class="col-md-6" id="victima-item-{{ $victima->id }}">
                            <div class="card border-danger border-opacity-25 shadow-sm p-2 d-flex flex-row align-items-center justify-content-between bg-light">
                                <div class="small d-flex align-items-center">
                                    <a href="{{ route('genero.edit', $victima->id) }}" class="text-decoration-none fw-bold text-danger me-2" target="_blank">
                                        <span>#{{ $victima->id }}</span> - {{ $victima->persona->apellido }}, {{ $victima->persona->nombre }}
                                        <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 0.75rem;"></i>
                                    </a>
                                    
                                    <button type="button" class="btn btn-sm btn-light border p-1 text-info shadow-sm" onclick="abrirInfoVinculo({{ $victima->id }}, '{{ $victima->persona->apellido }}, {{ $victima->persona->nombre }}')" title="Detalles del vínculo">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </button>

                                    <input type="hidden" name="victimas[{{ $victima->id }}][hijos_en_comun]" id="hijos_{{ $victima->id }}" value="{{ $victima->pivot->hijos_en_comun ?? 0 }}">
                                    <input type="hidden" name="victimas[{{ $victima->id }}][relacion_actual]" id="relacion_{{ $victima->id }}" value="{{ $victima->pivot->relacion_actual ?? 0 }}">
                                    <input type="hidden" name="victimas[{{ $victima->id }}][descripcion_relacion]" id="desc_{{ $victima->id }}" value="{{ $victima->pivot->descripcion_relacion ?? '' }}">
                                </div>
                                <button type="button" class="btn btn-link text-secondary p-0 ms-2" onclick="quitarVictima({{ $victima->id }})">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 5. INTERVENCIONES --}}
       <div class="card shadow-sm border-0 mb-4 border-start border-4" style="border-color:#198754!important;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 text-success fw-bold">
            <i class="bi bi-clock-history me-2"></i>5. Historial de Intervenciones
        </h5>
        <a href="{{ route('masculinidades.intervenciones.create', $caso->id) }}" class="btn btn-sm btn-success px-3 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Nueva Intervención
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr class="small text-uppercase">
                        <th style="width:15%">Fecha</th>
                        <th style="width:20%">Tipo</th>
                        <th style="width:20%">Profesional</th>
                        <th style="width:25%">Detalle</th>
                        <th style="width:10%">Archivo</th>
                        <th style="width:10%" class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody class="small">

                @forelse($caso->intervenciones as $intervencion)
                    <tr>

                        <td class="fw-bold align-middle">
                            {{ \Carbon\Carbon::parse($intervencion->fecha_intervencion)->format('d/m/Y') }}
                        </td>

                        <td class="align-middle">
                            {{ $intervencion->tipo->nombre ?? 'S/D' }}
                        </td>

                        <td class="align-middle">
                            {{ $intervencion->encargado->apellido }}, {{ $intervencion->encargado->nombre }}
                        </td>

                        <td class="align-middle">
                            {{ \Illuminate\Support\Str::limit($intervencion->detalle, 60) }}
                        </td>

                        <td class="align-middle text-center">

                            @if($intervencion->adjunto)
                                <a href="{{ route('adjuntos.descargar', $intervencion->adjunto->id) }}"
                                   class="btn btn-sm btn-outline-success"
                                   title="Descargar archivo">
                                    <i class="bi bi-download"></i>
                                </a>
                            @else
                                <span class="text-muted small">Sin archivo</span>
                            @endif

                        </td>

                        <td class="text-end align-middle">

                            <a href="{{ route('masculinidades.intervenciones.edit', $intervencion->id) }}"
                               class="btn btn-sm btn-outline-secondary shadow-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="6"
                            class="text-center text-muted py-4"
                            style="font-style: italic;">
                            No hay intervenciones registradas en este caso.
                        </td>
                    </tr>
                @endforelse

                </tbody>

            </table>
        </div>
    </div>
</div>

        {{-- 6. SITUACIÓN JUDICIAL Y OBSERVACIONES --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-file-earmark-text me-2"></i>6. Situación Judicial y Observaciones</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Situación Judicial</label>
                        <textarea name="situacion_judicial" class="form-control" rows="3">{{ $caso->situacion_judicial }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="3">{{ $caso->observaciones }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light text-end py-3">
                <button type="submit" class="btn btn-lg text-white px-5 shadow-sm" style="background:#5651A0">
                    <i class="bi bi-save-fill me-2"></i> ACTUALIZAR CASO
                </button>
            </div>
        </div>

    </form>
</div>

{{-- --- MODALES --- --}}

{{-- MODAL 1: BUSCAR VÍCTIMA --}}
<div class="modal fade" id="modalVictimas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #e83e8c;">
                <h5 class="modal-title"><i class="bi bi-search me-2"></i>Vincular Legajo de Género</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="input-group mb-3 shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="busquedaVictima" class="form-control border-0" placeholder="Buscar por nombre, apellido o DNI...">
                </div>
                <div class="table-responsive bg-white rounded shadow-sm border" style="max-height: 400px;">
                    <table class="table table-hover mb-0 text-sm">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>Legajo</th>
                                <th>Nombre Completo</th>
                                <th>DNI</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaResultadosVictimas">
                            @foreach($casosGenero as $casoG)
                            <tr class="fila-victima">
                                <td class="fw-bold text-danger">#{{ $casoG->id }}</td>
                                <td>{{ $casoG->persona->apellido }}, {{ $casoG->persona->nombre }}</td>
                                <td>{{ $casoG->persona->dni }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="agregarVictima({{ $casoG->id }}, '{{ $casoG->persona->apellido }}, {{ $casoG->persona->nombre }}')">
                                        <i class="bi bi-link-45deg"></i> Vincular
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL 2: DETALLES DEL VÍNCULO --}}
<div class="modal fade" id="modalInfoVinculo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #17a2b8;">
                <h5 class="modal-title"><i class="bi bi-diagram-3 me-2"></i>Detalles del Vínculo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="fw-bold mb-3 text-secondary" id="infoVinculoNombre"></p>
                <input type="hidden" id="infoVinculoId">
                <div class="mb-3">
                    <label class="form-label fw-bold small">Hijos en común</label>
                    <input type="number" id="infoHijos" class="form-control" value="0" min="0">
                </div>
                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="infoRelacion">
                    <label class="form-check-label fw-bold small">¿Tienen relación actualmente?</label>
                </div>
                <div class="mb-3" id="infoDescContainer" style="display: none;">
                    <label class="form-label fw-bold small">Descripción de la relación</label>
                    <input type="text" id="infoDesc" class="form-control" placeholder="Ej: Convivientes, Pareja...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info text-white btn-sm px-4" onclick="guardarInfoVinculo()">Guardar Datos</button>
            </div>
        </div>
    </div>
</div>

<style>
    .card { border-radius:12px; transition:0.3s; }
    .form-label { font-size:0.9rem; }
    .form-control:focus, .form-select:focus {
        border-color:#5651A0;
        box-shadow:0 0 0 0.2rem rgba(86,81,160,0.25);
    }
    .bg-light-subtle { background:#f8f9fa; }
    .border-primary-subtle { border-color:#5651a055 !important; }
</style>

{{-- --- SCRIPTS --- --}}
<script>
// 1. Lógica General (Dispositivo)
function toggleDispositivo(){
    let valor = document.getElementById('debeDispositivo').value;
    let bloque = document.getElementById('camposDispositivo');
    bloque.style.display = (valor == 1) ? 'flex' : 'none';
}
document.getElementById('debeDispositivo').addEventListener('change', toggleDispositivo);
window.addEventListener('load', toggleDispositivo);

// 2. Lógica Grupo Conviviente
let integranteIdx = {{ $caso->grupoFamiliar->count() }};
function agregarIntegrante() {
    const html = `
        <tr>
            <td><input type="text" name="grupo_conviviente[${integranteIdx}][nombre]" class="form-control form-control-sm"></td>
            <td><input type="number" name="grupo_conviviente[${integranteIdx}][edad]" class="form-control form-control-sm"></td>
            <td><input type="text" name="grupo_conviviente[${integranteIdx}][vinculo]" class="form-control form-control-sm"></td>
            <td class="text-center"><button type="button" class="btn btn-link text-danger p-0" onclick="eliminarFila(this)"><i class="bi bi-trash-fill"></i></button></td>
        </tr>`;
    document.getElementById('tabla-convivientes').insertAdjacentHTML('beforeend', html);
    integranteIdx++;
}
function eliminarFila(btn) {
    btn.closest('tr').remove();
}

// 3. Lógica Víctimas Vinculadas
const urlBaseGenero = "{{ route('genero.edit', ':id') }}";

function agregarVictima(id, nombre) {
    if (document.getElementById('victima-item-' + id)) {
        alert('Esta víctima ya está vinculada.');
        return;
    }
    
    const urlLegajo = urlBaseGenero.replace(':id', id);
    const lista = document.getElementById('lista-victimas');
    const html = `
        <div class="col-md-6" id="victima-item-${id}">
            <div class="card border-danger border-opacity-25 shadow-sm p-2 d-flex flex-row align-items-center justify-content-between bg-light">
                <div class="small d-flex align-items-center">
                    <a href="${urlLegajo}" class="text-decoration-none fw-bold text-danger me-2" target="_blank">
                        <span>#${id}</span> - ${nombre} <i class="bi bi-box-arrow-up-right ms-1"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-light border p-1 text-info" onclick="abrirInfoVinculo(${id}, '${nombre}')">
                        <i class="bi bi-info-circle-fill"></i>
                    </button>
                    <input type="hidden" name="victimas[${id}][hijos_en_comun]" id="hijos_${id}" value="0">
                    <input type="hidden" name="victimas[${id}][relacion_actual]" id="relacion_${id}" value="0">
                    <input type="hidden" name="victimas[${id}][descripcion_relacion]" id="desc_${id}" value="">
                </div>
                <button type="button" class="btn btn-link text-secondary p-0 ms-2" onclick="quitarVictima(${id})">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </div>
        </div>`;
    
    lista.insertAdjacentHTML('beforeend', html);
    bootstrap.Modal.getInstance(document.getElementById('modalVictimas')).hide();
    setTimeout(() => abrirInfoVinculo(id, nombre), 400); 
}

function quitarVictima(id) {
    document.getElementById('victima-item-' + id)?.remove();
}

// 4. Lógica Modal Info Vínculo
document.getElementById('infoRelacion').addEventListener('change', function() {
    document.getElementById('infoDescContainer').style.display = this.checked ? 'block' : 'none';
});

function abrirInfoVinculo(id, nombre) {
    document.getElementById('infoVinculoId').value = id;
    document.getElementById('infoVinculoNombre').innerText = "Expediente Género: " + nombre;
    document.getElementById('infoHijos').value = document.getElementById('hijos_' + id).value || 0;
    
    let tieneRelacion = document.getElementById('relacion_' + id).value === "1";
    document.getElementById('infoRelacion').checked = tieneRelacion;
    document.getElementById('infoDesc').value = document.getElementById('desc_' + id).value || '';
    document.getElementById('infoDescContainer').style.display = tieneRelacion ? 'block' : 'none';
    
    new bootstrap.Modal(document.getElementById('modalInfoVinculo')).show();
}

function guardarInfoVinculo() {
    let id = document.getElementById('infoVinculoId').value;
    document.getElementById('hijos_' + id).value = document.getElementById('infoHijos').value;
    document.getElementById('relacion_' + id).value = document.getElementById('infoRelacion').checked ? "1" : "0";
    document.getElementById('desc_' + id).value = document.getElementById('infoDesc').value;
    bootstrap.Modal.getInstance(document.getElementById('modalInfoVinculo')).hide();
}

// 5. Buscador Modal
document.getElementById('busquedaVictima')?.addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    document.querySelectorAll('#tablaResultadosVictimas .fila-victima').forEach(fila => {
        fila.style.display = fila.innerText.toLowerCase().includes(filtro) ? '' : 'none';
    });
});

let index = {{ $caso->grupoFamiliar ? $caso->grupoFamiliar->count() : 0 }};

function agregarFamiliar() {
    const container = document.getElementById('grupoFamiliarContainer');
    
    // Si es el primer integrante que agregamos manualmente y no había nada antes, limpiamos el mensaje
    if(index === 0) container.innerHTML = ''; 

    const html = `
        <div class="card p-3 mt-3 border shadow-sm">
            <div class="row g-2">
                <div class="col-md-3"><input type="text" name="grupo[${index}][nombre]" class="form-control" placeholder="Nombre"></div>
                <div class="col-md-3"><input type="text" name="grupo[${index}][apellido]" class="form-control" placeholder="Apellido"></div>
                <div class="col-md-3"><input type="text" name="grupo[${index}][telefono]" class="form-control" placeholder="Teléfono"></div>
                <div class="col-md-2">
                    <select name="grupo[${index}][vinculo]" class="form-select">
                        <option value="">Vínculo</option>
                        <option value="padre">Padre</option>
                        <option value="madre">Madre</option>
                        <option value="hijo/a">Hijo/a</option>
                        <option value="hermano/a">Hermano/a</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.card').remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', html);
    index++;
}

// Lógica Trabaja
const trabajaSwitch = document.getElementById('trabajaSwitch');
const detalleTrabajoContainer = document.getElementById('detalleTrabajoContainer');

function toggleTrabajo(){
    if(trabajaSwitch.checked){
        detalleTrabajoContainer.style.display = 'block';
    }else{
        detalleTrabajoContainer.style.display = 'none';
    }
}

trabajaSwitch?.addEventListener('change', toggleTrabajo);
window.addEventListener('load', toggleTrabajo);
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const debe = document.getElementById('debeDispositivoEdit');
    const camposAsistencia = document.getElementById('camposAsistencia');
    const asistencia = document.getElementById('asistenciaSelect');
    const divFechaFin = document.getElementById('divFechaFin');

    // Lógica para mostrar asistencia
    debe.addEventListener('change', function() {
        if(this.value == "1") {
            camposAsistencia.style.display = 'block';
        } else {
            camposAsistencia.style.display = 'none';
            divFechaFin.style.display = 'none';
        }
    });

    // Lógica para mostrar fecha de fin
    asistencia.addEventListener('change', function() {
        if(this.value == "3" || this.value == "4") {
            divFechaFin.style.display = 'block';
        } else {
            divFechaFin.style.display = 'none';
        }
    });
});
</script>

@endsection