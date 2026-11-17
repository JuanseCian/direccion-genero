@extends('frontend.layouts.front')

@section('title', 'Editar Legajo de Género')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container-fluid py-4">

    {{-- ENCABEZADO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0" style="color: #5651A0;">
                <i class="bi bi-pencil-square"></i> Editar Legajo: {{ $legajo->persona->apellido }}, {{ $legajo->persona->nombre }}
            </h2>
            <p class="text-muted">DNI {{ $legajo->persona->dni }} - Módulo de Género</p>
        </div>

        <div>
            {{-- Los botones de intervención se movieron a la Sección 7 --}}
            <a href="{{ route('genero.index') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </div>

    {{-- ALERTA IVE --}}
    @if(isset($existeEnIve) && $existeEnIve)
        <div class="alert alert-warning border-0 shadow-sm mb-4 animate__animated animate__fadeIn">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-exclamation me-3 fs-3 text-warning"></i>
                <div>
                    <strong>Atención: Vinculación de Áreas</strong><br>
                    Esta persona cuenta con un registro activo en <strong>Área IVE</strong>.
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('genero.update', $legajo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="persona_id" value="{{ $legajo->persona_id }}">

        {{-- 1. IDENTIFICACIÓN Y UBICACIÓN --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-badge me-2"></i>1. Identificación y Ubicación</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold text-secondary">Persona</label>
                        <input type="text" class="form-control bg-light" value="{{ $legajo->persona->apellido }}, {{ $legajo->persona->nombre }} (DNI {{ $legajo->persona->dni }})" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-secondary">Género autopercibido</label>
                        <input type="text" name="genero" class="form-control" value="{{ old('genero', $legajo->genero) }}" placeholder="Ej: Mujer Trans, No binario">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Provincia</label>
                        <select name="provincia_id" class="form-select select2-init">
                            <option value="">Seleccione...</option>
                            @foreach($provincias as $provincia)
                                <option value="{{ $provincia->id }}" {{ $legajo->provincia_id == $provincia->id ? 'selected' : '' }}>
                                    {{ $provincia->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Localidad</label>
                        <select name="localidad_id" class="form-select select2-init">
                            @foreach($localidades as $loc)
                                <option value="{{ $loc->id }}" {{ $legajo->localidad_id == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Barrio</label>
                        <select name="barrio_id" class="form-select select2-init">
                            <option value="">Seleccione...</option>
                            @foreach($barrios as $barrio)
                                <option value="{{ $barrio->id }}" {{ $legajo->barrio_id == $barrio->id ? 'selected' : '' }}>
                                    {{ $barrio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. SITUACIÓN SOCIO-EDUCATIVA --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-info-circle me-2"></i>2. Situación Socio-Educativa</h5>
            </div>
            <div class="card-body bg-light-subtle">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Estado Civil</label>
                        <select name="estado_civil_id" class="form-select select2-init">
                            @foreach($estados_civiles as $estado)
                                <option value="{{ $estado->id }}" {{ $legajo->estado_civil_id == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nivel de Estudio</label>
                        <select name="nivel_estudio_id" class="form-select select2-init">
                            @foreach($niveles_estudio as $nivel)
                                <option value="{{ $nivel->id }}" {{ $legajo->nivel_estudio_id == $nivel->id ? 'selected' : '' }}>
                                    {{ $nivel->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="trabaja" class="form-label fw-bold">¿Trabaja actualmente?</label>
                        <select name="trabaja" id="trabaja" class="form-select shadow-sm border-secondary-subtle">
                            <option value="1" {{ $legajo->trabaja == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ $legajo->trabaja == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="participa_organizacion" class="form-label fw-bold">¿Participa en organización social?</label>
                        <select name="organizacion_social" id="participa_organizacion" class="form-select shadow-sm border-secondary-subtle" onchange="toggleOrganizacion()">
                            <option value="1" {{ $legajo->organizacion_social == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ $legajo->organizacion_social == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="detalle_organizacion" class="form-label fw-bold">Detalle de la organización</label>
                        <input type="text" name="organizacion_social_detalle" id="detalle_organizacion" class="form-control shadow-sm border-secondary-subtle" placeholder="Nombre de la organización" value="{{ $legajo->organizacion_social_detalle }}" disabled>
                    </div>
                </div>
            </div>
            {{-- CUD --}}
            @if($legajo->persona->cud)

            <div class="col-md-12 mt-3">
                <div class="alert border shadow-sm" style="background:#f0f7ff;border-left:4px solid #0d6efd;">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        
                        <div>
                            <strong class="text-primary">
                                <i class="bi bi-person-wheelchair me-2"></i>
                                Certificado Único de Discapacidad (CUD)
                            </strong>

                            <div class="small mt-1">
                                <strong>N°:</strong> {{ $legajo->persona->cud->numero_cud ?? '—' }} <br>

                                <strong>Emisión:</strong>
                                {{ $legajo->persona->cud->fecha_emision ? \Carbon\Carbon::parse($legajo->persona->cud->fecha_emision)->format('d/m/Y') : '—' }}

                                <br>

                                <strong>Vencimiento:</strong>
                                {{ $legajo->persona->cud->fecha_vencimiento ? \Carbon\Carbon::parse($legajo->persona->cud->fecha_vencimiento)->format('d/m/Y') : '—' }}
                            </div>
                        </div>

                        <span class="badge bg-primary">
                            Persona con CUD
                        </span>

                    </div>

                </div>
            </div>

            @endif
        </div>

        {{-- 3. VIVIENDA Y SERVICIOS --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-house-door me-2"></i>3. Vivienda y Servicios</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Situación Habitacional</label>
                        <select name="situacion_habitacional_id" class="form-select select2-init">
                            <option value="">Seleccione...</option>
                            @foreach($situacionesHabitacionales as $sh)
                                <option value="{{ $sh->id }}" {{ $legajo->situacion_habitacional_id == $sh->id ? 'selected' : '' }}>
                                    {{ $sh->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold d-block mb-3">Servicios disponibles en la vivienda</label>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="servicios_luz" id="servicios_luz" value="1" {{ $legajo->servicios_luz ? 'checked' : '' }}>
                                <label class="form-check-label" for="servicios_luz">Luz</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="servicios_gas_natural" id="servicios_gas_natural" value="1" {{ $legajo->servicios_gas_natural ? 'checked' : '' }}>
                                <label class="form-check-label" for="servicios_gas_natural">Gas Natural</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="servicios_agua_potable" id="servicios_agua_potable" value="1" {{ $legajo->servicios_agua_potable ? 'checked' : '' }}>
                                <label class="form-check-label" for="servicios_agua_potable">Agua</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="servicios_cable" id="servicios_cable" value="1" {{ $legajo->servicios_cable ? 'checked' : '' }}>
                                <label class="form-check-label" for="servicios_cable">Cable</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="servicios_internet" id="servicios_internet" value="1" {{ $legajo->servicios_internet ? 'checked' : '' }}>
                                <label class="form-check-label" for="servicios_internet">Internet</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. ANTECEDENTES Y VIOLENCIA --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-shield-exclamation me-2"></i>4. Antecedentes y Violencia</h5>
            </div>
            <div class="card-body bg-light-subtle">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo de violencia principal</label>
                        <select name="tipo_violencia_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($tipos_violencia as $tv)
                                <option value="{{ $tv->id }}" {{ $legajo->tipo_violencia_id == $tv->id ? 'selected' : '' }}>
                                    {{ $tv->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Medida Cautelar</label>
                        <select name="medida_cautelar_id" class="form-select">
                            <option value="">Ninguna</option>
                            @foreach($medida as $m)
                                <option value="{{ $m->id }}" {{ $legajo->medida_cautelar_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Botón Antipánico (Número)</label>
                        <input type="text" name="boton_panico_numero" class="form-control" value="{{ $legajo->boton_panico_numero }}" placeholder="Dejar vacío si no posee">
                    </div>

                    <div class="col-md-3 mt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="denuncio_antes" id="denuncio_antes" value="1" {{ $legajo->denuncio_antes ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="denuncio_antes">¿Denunció antes?</label>
                        </div>
                    </div>

                    <div class="col-md-5 mt-4">
                        <input type="text" name="denuncio_antes_detalle" class="form-control form-control-sm" placeholder="Detalle de denuncias previas..." value="{{ $legajo->denuncio_antes_detalle }}">
                    </div>

                    <div class="col-md-4 mt-4">
                        <label class="form-label fw-bold small mb-1">Fecha última denuncia</label>
                        <input type="date" name="fecha_ultima_denuncia" class="form-control form-control-sm" value="{{ $legajo->fecha_ultima_denuncia }}">
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="amenaza_con_arma" id="amenaza_con_arma" value="1" {{ $legajo->amenaza_con_arma ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-danger" for="amenaza_con_arma">¿Hubo amenaza con arma?</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nivel de Gravedad</label>

                        <select name="nivel_gravedad" class="form-control">

                        <option value="3">Alto</option>
                        <option value="2">Medio</option>
                        <option value="1">Bajo</option>

                        </select>
                        </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo de arma</label>
                        <input type="text"
                            name="amenaza_tipo_arma"
                            class="form-control"
                            value="{{ $legajo->amenaza_tipo_arma }}"
                            placeholder="Fuego, blanca...">
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. AGRESORES VINCULADOS --}}
        <div class="card shadow-sm border-0 mb-4 border-start border-4" style="border-color:#dc3545!important;">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-danger">
                    <i class="bi bi-person-exclamation me-2"></i>5. Agresores Vinculados
                </h5>
                <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgresores">
                    <i class="bi bi-plus-circle"></i> Vincular Agresor
                </button>
            </div>

            <div class="card-body">
                <div id="lista-agresores" class="row g-3">
                    @foreach($legajo->agresores as $agresor)
                        <div class="col-md-6" id="agresor-item-{{ $agresor->id }}">
                            <div class="card border-danger border-opacity-25 shadow-sm p-2 d-flex flex-row align-items-center justify-content-between bg-light">
                                <div class="small d-flex align-items-center">
                                    <a href="{{ route('masculinidades.edit', $agresor->id) }}" class="text-decoration-none fw-bold text-danger me-2" target="_blank">
                                        <span>#{{ $agresor->id }}</span> - {{ $agresor->persona->apellido }}, {{ $agresor->persona->nombre }}
                                        <i class="bi bi-box-arrow-up-right ms-1" style="font-size:.75rem;"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-light border p-1 text-info shadow-sm" onclick="abrirInfoVinculo({{ $agresor->id }}, '{{ $agresor->persona->apellido }}, {{ $agresor->persona->nombre }}')">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </button>

                                    <input type="hidden" name="agresores[{{ $agresor->id }}][hijos_en_comun]" id="hijos_{{ $agresor->id }}" value="{{ $agresor->pivot->hijos_en_comun ?? 0 }}">
                                    <input type="hidden" name="agresores[{{ $agresor->id }}][relacion_actual]" id="relacion_{{ $agresor->id }}" value="{{ $agresor->pivot->relacion_actual ?? 0 }}">
                                    <input type="hidden" name="agresores[{{ $agresor->id }}][descripcion_relacion]" id="desc_{{ $agresor->id }}" value="{{ $agresor->pivot->descripcion_relacion ?? '' }}">
                                </div>

                                <button type="button" class="btn btn-link text-secondary p-0 ms-2" onclick="quitarAgresor({{ $agresor->id }})">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 6. GRUPO CONVIVIENTE --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-house-heart me-2"></i>6. Grupo Conviviente</h5>
                <button type="button" class="btn btn-sm btn-primary px-3 shadow-sm" onclick="agregarFamiliar()">
                    <i class="bi bi-plus-circle me-1"></i> Añadir Integrante
                </button>
            </div>
            <div class="card-body">
                <div id="grupoFamiliarContainer">
                    <p id="msgVacio" class="text-muted small text-center py-2" style="font-style: italic;">No hay integrantes registrados para este legajo.</p>
                </div>
            </div>
        </div>

        {{-- 7. INTERVENCIONES --}}
         <div class="card shadow-sm border-0 mb-4 border-start border-4" style="border-color:#198754!important;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 text-success fw-bold">
            <i class="bi bi-clock-history me-2"></i>5. Historial de Intervenciones
        </h5>
        <a href="{{ route('genero.intervenciones.create', $legajo->id) }}" class="btn btn-sm btn-success px-3 shadow-sm">
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

                @forelse($legajo->intervenciones as $intervencion)
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

                        <td class="align-middle">
                        @if($intervencion->adjuntos->isNotEmpty())
                            <div class="d-flex flex-column gap-2">
                                @foreach($intervencion->adjuntos as $adjunto)
                                    <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('adjuntos.descargar', $adjunto->id) }}"
                                            class="btn btn-sm btn-outline-success"
                                            title="Descargar {{ $adjunto->nombre_original }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            <span class="small text-muted text-truncate"
                                                style="max-width: 150px;"
                                                title="{{ $adjunto->nombre_original }}">
                                                {{ $adjunto->nombre_original }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="badge bg-light text-muted border fw-normal">
                                    Sin archivo
                                </span>
                            @endif
                        </td>
                        <td class="text-end align-middle">
                            <a href="{{ route('genero.intervenciones.show', [
                                    'caso' => $intervencion->caso_id,
                                    'intervencion' => $intervencion->id,
                                ]) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-outline-primary"
                            title="Visualizar intervención">

                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('genero.intervenciones.edit', $intervencion->id) }}"
                                class="btn btn-sm btn-outline-secondary shadow-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button"
                                class="btn btn-sm btn-outline-danger shadow-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEliminarIntervencion"
                                data-action="{{ route('genero.intervenciones.destroy', $intervencion->id) }}"
                                title="Eliminar intervención">
                                <i class="bi bi-trash"></i>
                            </button>

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

        {{-- 8. DENUNCIAS VINCULADAS POR DNI --}}
        @include('frontend.areas.partials.denuncias', [
            'denuncias' => $denuncias,
        ])

        {{-- 8. RESPONSABLE Y CIERRE --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-check me-2"></i>8. Responsable y Cierre</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Profesional a Cargo</label>
                        <select name="encargado_id" class="form-select border-primary-subtle select2-init">
                            <option value="">Seleccione encargado...</option>
                            @foreach($encargados as $encargado)
                                <option value="{{ $encargado->id }}" {{ $legajo->encargado_id == $encargado->id ? 'selected' : '' }}>
                                    {{ $encargado->apellido }}, {{ $encargado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Observaciones Adicionales</label>
                        <textarea name="observaciones" class="form-control" rows="2" placeholder="Notas importantes...">{{ $legajo->observaciones }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-light text-end py-3">
                <button type="submit" class="btn btn-lg text-white px-5 shadow-sm" style="background: #5651A0;">
                    <i class="bi bi-save-fill me-2"></i> ACTUALIZAR LEGAJO
                </button>
            </div>
        </div>

    </form>
</div>

@include('frontend.areas.partials.modal-eliminar-intervencion')

{{-- MODAL BUSCAR AGRESORES --}}
<div class="modal fade" id="modalAgresores" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background:#dc3545;">
                <h5 class="modal-title">
                    <i class="bi bi-search me-2"></i> Vincular Legajo Masculinidades
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body bg-light">
                <div class="input-group mb-3 shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="busquedaAgresor" class="form-control border-0" placeholder="Buscar por nombre o DNI">
                </div>

                <div class="table-responsive bg-white rounded shadow-sm border" style="max-height:400px;">
                    <table class="table table-hover mb-0 text-sm">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>Legajo</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaResultadosAgresores">
                            @foreach($casosMasculinidades as $casoM)
                                <tr class="fila-agresor">
                                    <td class="fw-bold text-danger">#{{ $casoM->id }}</td>
                                    <td>{{ $casoM->persona->apellido }}, {{ $casoM->persona->nombre }}</td>
                                    <td>{{ $casoM->persona->dni }}</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="agregarAgresor({{ $casoM->id }}, '{{ $casoM->persona->apellido }}, {{ $casoM->persona->nombre }}')">
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

{{-- MODAL INFO VÍNCULO --}}
<div class="modal fade" id="modalInfoVinculo">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background:#17a2b8;">
                <h5 class="modal-title">
                    <i class="bi bi-diagram-3 me-2"></i> Detalles del vínculo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="fw-bold mb-3 text-secondary" id="infoVinculoNombre"></p>
                <input type="hidden" id="infoVinculoId">

                <div class="mb-3">
                    <label class="form-label fw-bold small">Hijos en común</label>
                    <input type="number" id="infoHijos" class="form-control" value="0">
                </div>

                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="infoRelacion">
                    <label class="form-check-label fw-bold small">¿Tienen relación actualmente?</label>
                </div>

                <div class="mb-3" id="infoDescContainer" style="display:none;">
                    <label class="form-label fw-bold small">Descripción relación</label>
                    <input type="text" id="infoDesc" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-info text-white btn-sm px-4" onclick="guardarInfoVinculo()">Guardar</button>
            </div>
        </div>
    </div>
</div>

{{-- ESTILOS UNIFICADOS --}}
<style>
    .card { border-radius: 12px; }
    .form-control:focus, .form-select:focus { 
        border-color: #5651A0; 
        box-shadow: 0 0 0 0.2rem rgba(86, 81, 160, 0.25); 
    }
</style>

{{-- SCRIPTS --}}
<script>
    $(document).ready(function() {
        // Inicializar Select2
        $('.select2-init').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });
        
        // Disparar validación visual de la organización social al cargar la página
        toggleOrganizacion();
    });

    // --- LÓGICA DE AGRESORES ---
    const urlBaseMasculinidades = "{{ route('masculinidades.edit', ':id') }}";

    function agregarAgresor(id, nombre) {
        if(document.getElementById('agresor-item-' + id)) {
            alert('Este agresor ya está vinculado');
            return;
        }

        const url = urlBaseMasculinidades.replace(':id', id);
        const lista = document.getElementById('lista-agresores');

        const html = `
            <div class="col-md-6" id="agresor-item-${id}">
                <div class="card border-danger border-opacity-25 shadow-sm p-2 d-flex flex-row align-items-center justify-content-between bg-light">
                    <div class="small d-flex align-items-center">
                        <a href="${url}" class="text-decoration-none fw-bold text-danger me-2" target="_blank">
                            <span>#${id}</span> - ${nombre}
                        </a>
                        <button type="button" class="btn btn-sm btn-light border p-1 text-info shadow-sm" onclick="abrirInfoVinculo(${id}, '${nombre}')">
                            <i class="bi bi-info-circle-fill"></i>
                        </button>
                        <input type="hidden" name="agresores[${id}][hijos_en_comun]" id="hijos_${id}" value="0">
                        <input type="hidden" name="agresores[${id}][relacion_actual]" id="relacion_${id}" value="0">
                        <input type="hidden" name="agresores[${id}][descripcion_relacion]" id="desc_${id}" value="">
                    </div>
                    <button type="button" class="btn btn-link text-secondary p-0 ms-2" onclick="quitarAgresor(${id})">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
        `;

        lista.insertAdjacentHTML('beforeend', html);
        bootstrap.Modal.getInstance(document.getElementById('modalAgresores')).hide();
        setTimeout(() => abrirInfoVinculo(id, nombre), 400);
    }

    function quitarAgresor(id) {
        document.getElementById('agresor-item-' + id)?.remove();
    }

    document.getElementById('busquedaAgresor').addEventListener('keyup', function() {
        let filtro = this.value.toLowerCase();
        document.querySelectorAll('.fila-agresor').forEach(fila => {
            fila.style.display = fila.innerText.toLowerCase().includes(filtro) ? '' : 'none';
        });
    });

    document.getElementById('infoRelacion').addEventListener('change', function() {
        document.getElementById('infoDescContainer').style.display = this.checked ? 'block' : 'none';
    });

    function abrirInfoVinculo(id, nombre) {
        document.getElementById('infoVinculoId').value = id;
        document.getElementById('infoVinculoNombre').innerText = "Expediente Masculinidades: " + nombre;
        document.getElementById('infoHijos').value = document.getElementById('hijos_' + id).value || 0;

        let relacion = document.getElementById('relacion_' + id).value === "1";
        document.getElementById('infoRelacion').checked = relacion;
        document.getElementById('infoDesc').value = document.getElementById('desc_' + id).value || '';
        document.getElementById('infoDescContainer').style.display = relacion ? 'block' : 'none';

        new bootstrap.Modal(document.getElementById('modalInfoVinculo')).show();
    }

    function guardarInfoVinculo() {
        let id = document.getElementById('infoVinculoId').value;
        document.getElementById('hijos_' + id).value = document.getElementById('infoHijos').value;
        document.getElementById('relacion_' + id).value = document.getElementById('infoRelacion').checked ? "1" : "0";
        document.getElementById('desc_' + id).value = document.getElementById('infoDesc').value;

        bootstrap.Modal.getInstance(document.getElementById('modalInfoVinculo')).hide();
    }
</script>

<script>
function toggleOrganizacion() {
    const participa = document.getElementById('participa_organizacion').value;
    const detalle = document.getElementById('detalle_organizacion');
    
    if (participa === "1") {
        detalle.disabled = false;
        detalle.classList.remove('bg-light');
    } else {
        detalle.disabled = true;
        // Solo vaciamos si no tenía un valor previo cargado y lo estamos desactivando manualmente
        if(!detalle.defaultValue || participa === "0") {
             detalle.value = "";
        }
        detalle.classList.add('bg-light');
    }
}

// Contamos cuántos familiares ya existen para que el nuevo empiece después de esos
let index = {{ $legajo->grupoConviviente->count() }}; 

function agregarFamiliar(datos = null) {
    const container = document.getElementById('grupoFamiliarContainer');
    const msgVacio = document.getElementById('msgVacio');
    if(msgVacio) msgVacio.remove();

    // Si es un familiar nuevo, los campos vienen vacíos
    const nombre = datos ? datos.nombre : '';
    const apellido = datos ? datos.apellido : '';
    const dni = datos ? (datos.dni || '') : '';
    const telefono = datos ? (datos.telefono || '') : '';
    const vinculo = datos ? (datos.vinculo || '').toLowerCase() : '';

    const html = `
        <div class="card p-3 mt-3 border shadow-sm">
            <div class="row g-2 align-items-center">
                <div class="col-md-2">
                    <input type="text" name="grupo[${index}][nombre]" value="${nombre}" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="grupo[${index}][apellido]" value="${apellido}" class="form-control" placeholder="Apellido" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="grupo[${index}][dni]" value="${dni}" class="form-control" placeholder="DNI">
                </div>
                <div class="col-md-2">
                    <input type="text" name="grupo[${index}][telefono]" value="${telefono}" class="form-control" placeholder="Teléfono">
                </div>
                <div class="col-md-3">
                    <select name="grupo[${index}][vinculo]" class="form-select" required>
                        <option value="">Vínculo</option>
                        <option value="padre" ${vinculo === 'padre' ? 'selected' : ''}>Padre</option>
                        <option value="madre" ${vinculo === 'madre' ? 'selected' : ''}>Madre</option>
                        <option value="hijo/a" ${vinculo === 'hijo/a' ? 'selected' : ''}>Hijo/a</option>
                        <option value="hermano/a" ${vinculo === 'hermano/a' ? 'selected' : ''}>Hermano/a</option>
                        <option value="pareja" ${vinculo === 'pareja' ? 'selected' : ''}>Pareja</option>
                        <option value="otro" ${vinculo === 'otro' ? 'selected' : ''}>Otro</option>
                    </select>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-outline-danger btn-sm border-0" onclick="this.closest('.card').remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', html);
    index++; // Incrementamos para el siguient
}

</script>

@foreach($legajo->grupoConviviente as $familiar)
    <script>
        agregarFamiliar({
            nombre: "{{ $familiar->nombre }}",
            apellido: "{{ $familiar->apellido }}",
            dni: "{{ $familiar->dni }}",
            telefono: "{{ $familiar->telefono }}",
            vinculo: "{{ $familiar->vinculo }}"
        });
    </script>
@endforeach

<script>
    $(document).ready(function() {
        // Inicializar Select2
        $('.select2-init').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });
        
        // MOVER MODALES AL BODY PARA EVITAR QUE SE ROMPAN
        $('#modalAgresores, #modalInfoVinculo').appendTo('body');
    });
</script>

@endsection
