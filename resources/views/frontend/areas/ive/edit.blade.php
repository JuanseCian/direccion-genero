@extends('frontend.layouts.front')

@section('title', 'Editar Atención IVE')

@section('content')

{{-- Select2 --}}
<link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
/>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
/>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<div class="container-fluid py-4">

    {{-- ============================================================
        ENCABEZADO
    ============================================================ --}}
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">

        <div>

            <h2 class="fw-bold mb-1" style="color: #5651A0;">

                <i class="bi bi-pencil-square me-2"></i>
                Editar Atención IVE

            </h2>

            <p class="text-muted mb-0">

                Actualizando registro de:

                <strong>
                    {{ $caso->persona->apellido ?? '' }},
                    {{ $caso->persona->nombre ?? '' }}
                </strong>

                @if($caso->persona?->dni)
                    · DNI {{ $caso->persona->dni }}
                @endif

            </p>

        </div>


        <a
            href="{{ route('frontend.areas.ive.listado') }}"
            class="btn btn-outline-secondary shadow-sm"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Volver al listado
        </a>

    </div>


    {{-- ============================================================
        MENSAJES
    ============================================================ --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger shadow-sm border-0">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                No se pudo actualizar el registro

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- ============================================================
        FORMULARIO
    ============================================================ --}}
    <form
        action="{{ route('frontend.areas.ive.update', $caso->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- ========================================================
            1. IDENTIFICACIÓN
        ======================================================== --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 text-primary">

                    <i class="bi bi-person-badge me-2"></i>

                    1. Identificación de la Persona

                </h5>

            </div>


            <div class="card-body">

                {{-- ALERTA GÉNERO --}}
                <div
                    id="alerta-vinculacion-genero"
                    class="alert alert-warning border-0 shadow-sm mb-4
                        {{ $existeEnGenero ? '' : 'd-none' }}"
                >

                    <div class="d-flex align-items-center">

                        <i class="bi bi-person-exclamation me-3 fs-3"></i>

                        <div>

                            <strong>
                                Atención: Caso en Género Detectado
                            </strong>

                            <br>

                            Esta persona posee un registro activo en la
                            <strong>Dirección de Género</strong>.

                            Se recomienda abordaje integral.

                        </div>

                    </div>

                </div>


                <div class="row g-3">

                    {{-- PERSONA --}}
                    <div class="col-md-8">

                        <label class="form-label fw-bold text-secondary">

                            Persona

                        </label>

                        <select
                            name="persona_id"
                            id="persona_id_ive"
                            class="form-select"
                            required
                        >

                            @foreach($personas as $persona)

                                <option
                                    value="{{ $persona->id }}"

                                    {{ old(
                                        'persona_id',
                                        $caso->persona_id
                                    ) == $persona->id ? 'selected' : '' }}

                                    data-vinculada="{{
                                        (
                                            $persona->id == $caso->persona_id
                                            &&
                                            $existeEnGenero
                                        )
                                        ? 'true'
                                        : 'false'
                                    }}"
                                >

                                    {{ $persona->apellido }},
                                    {{ $persona->nombre }}

                                    @if($persona->dni)
                                        (DNI {{ $persona->dni }})
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">
                            Solo se listan personas de sexo femenino.
                        </small>

                    </div>


                    {{-- ENCARGADO --}}
                    <div class="col-md-4">

                        <label class="form-label fw-bold text-secondary">

                            Profesional Encargado

                        </label>

                        <select
                            name="encargado_id"
                            class="form-select border-primary-subtle shadow-sm"
                            required
                        >

                            <option value="">
                                Seleccione encargado...
                            </option>

                            @foreach($encargados as $encargado)

                                <option
                                    value="{{ $encargado->id }}"

                                    {{ old(
                                        'encargado_id',
                                        $caso->encargado_id
                                    ) == $encargado->id ? 'selected' : '' }}
                                >

                                    {{ $encargado->apellido }}
                                    {{ $encargado->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

        </div>



        {{-- ========================================================
            2. DATOS MÉDICOS Y SOCIALES
        ======================================================== --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 text-primary">

                    <i class="bi bi-activity me-2"></i>

                    2. Datos Médicos y Antecedentes

                </h5>

            </div>


            <div class="card-body bg-light-subtle">

                <div class="row g-3">

                    {{-- FUM --}}
                    <div class="col-md-3">

                        <label class="form-label fw-bold">

                            Fecha Última Menstruación (FUM)

                        </label>

                        <input
                            type="date"
                            name="fum"
                            value="{{ old('fum', $caso->fum) }}"
                            class="form-control shadow-sm"
                        >

                    </div>


                    {{-- ECO --}}
                    <div class="col-md-3">

                        <label class="form-label fw-bold">

                            Semanas (ECO)

                        </label>

                        <input
                            type="number"
                            name="eco_semanas"
                            value="{{ old('eco_semanas', $caso->eco_semanas) }}"
                            class="form-control shadow-sm"
                            min="0"
                        >

                    </div>


                    {{-- SEMANAS GESTACIÓN --}}
                    <div class="col-md-3">

                        <label class="form-label fw-bold">

                            Semanas de Gestación

                        </label>

                        <input
                            type="number"
                            name="semanas_gestacion"
                            value="{{ old(
                                'semanas_gestacion',
                                $caso->semanas_gestacion
                            ) }}"
                            class="form-control shadow-sm"
                            placeholder="Semanas"
                            min="0"
                        >

                    </div>


                    {{-- HIJOS --}}
                    <div class="col-md-3">

                        <label class="form-label fw-bold">

                            Cantidad de Hijos

                        </label>

                        <input
                            type="number"
                            name="cantidad_hijos"
                            value="{{ old(
                                'cantidad_hijos',
                                $caso->cantidad_hijos ?? 0
                            ) }}"
                            class="form-control shadow-sm"
                            min="0"
                        >

                    </div>


                    {{-- ESTADO CIVIL --}}
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            Estado Civil

                        </label>

                        <select
                            name="estado_civil_id"
                            class="form-select shadow-sm"
                        >

                            <option value="">
                                Seleccione...
                            </option>

                            @foreach($estadosCiviles as $estado)

                                <option
                                    value="{{ $estado->id }}"

                                    {{ old(
                                        'estado_civil_id',
                                        $caso->estado_civil_id
                                    ) == $estado->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $estado->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- MÉTODO --}}
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            Método de Interrupción

                        </label>

                        <select
                            name="metodo_interrupcion_id"
                            class="form-select shadow-sm"
                        >

                            <option value="">
                                Seleccione...
                            </option>

                            @foreach($metodos as $metodo)

                                <option
                                    value="{{ $metodo->id }}"

                                    {{ old(
                                        'metodo_interrupcion_id',
                                        $caso->metodo_interrupcion_id
                                    ) == $metodo->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $metodo->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- ALTA --}}
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            Fecha de Alta

                        </label>

                        <input
                            type="date"
                            name="alta"
                            value="{{ old('alta', $caso->alta) }}"
                            class="form-control shadow-sm"
                        >

                    </div>



                    {{-- OBRA SOCIAL --}}
                    <div class="col-md-4">

                        <div class="switch-card">

                            <div class="form-check form-switch mb-0">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="obra_social"
                                    value="1"
                                    id="obra_social"

                                    {{ old(
                                        'obra_social',
                                        $caso->obra_social
                                    ) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-bold"
                                    for="obra_social"
                                >

                                    ¿Posee Obra Social?

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- INTERRUPCIÓN PREVIA --}}
                    <div class="col-md-4">

                        <div class="switch-card">

                            <div class="form-check form-switch mb-0">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="interrupcion_previa"
                                    value="1"
                                    id="interrupcion_previa"

                                    {{ old(
                                        'interrupcion_previa',
                                        $caso->interrupcion_previa
                                    ) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-bold"
                                    for="interrupcion_previa"
                                >

                                    Interrupción Previa

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- VIOLENCIA PREVIA --}}
                    <div class="col-md-4">

                        <div class="switch-card">

                            <div class="form-check form-switch mb-0">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="violencia_previa"
                                    value="1"
                                    id="violencia_previa"

                                    {{ old(
                                        'violencia_previa',
                                        $caso->violencia_previa
                                    ) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-bold text-danger"
                                    for="violencia_previa"
                                >

                                    ¿Vivió violencia previa?

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- TIPOS DE VIOLENCIA --}}
                    <div
                        class="col-md-12 mt-3"
                        id="violencia-container"
                        style="{{
                            old(
                                'violencia_previa',
                                $caso->violencia_previa
                            )
                                ? ''
                                : 'display:none;'
                        }}"
                    >

                        <div class="p-3 border rounded bg-white shadow-sm">

                            <label class="form-label fw-bold mb-3 text-danger">

                                <i class="bi bi-exclamation-triangle me-1"></i>

                                Tipos de Violencia Detectada

                            </label>


                            @php

                                $tiposSeleccionados = old(
                                    'tipos_violencia',
                                    $caso->tiposViolencia
                                        ->pluck('id')
                                        ->toArray()
                                );

                            @endphp


                            <div class="d-flex flex-wrap gap-2">

                                @foreach($tiposViolencia as $tipo)

                                    <input
                                        type="checkbox"
                                        class="btn-check"
                                        name="tipos_violencia[]"
                                        value="{{ $tipo->id }}"
                                        id="violencia_{{ $tipo->id }}"
                                        autocomplete="off"

                                        {{ in_array(
                                            $tipo->id,
                                            $tiposSeleccionados
                                        ) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="violencia-chip"
                                        for="violencia_{{ $tipo->id }}"
                                    >

                                        {{ $tipo->nombre }}

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>



                    {{-- CUD --}}
                    @if($caso->persona && $caso->persona->cud)

                        <div class="col-md-12 mt-4">

                            <div class="alert cud-alert shadow-sm mb-0">

                                <div>

                                    <strong class="text-primary">

                                        <i class="bi bi-person-wheelchair me-2"></i>

                                        CUD Detectado

                                    </strong>

                                    <div class="small mt-1">

                                        <strong>N°:</strong>

                                        {{ $caso->persona->cud->numero_cud ?? '—' }}

                                        <span class="mx-2">
                                            |
                                        </span>

                                        <strong>Vencimiento:</strong>

                                        {{ $caso->persona->cud->fecha_vencimiento
                                            ? \Carbon\Carbon::parse(
                                                $caso->persona->cud->fecha_vencimiento
                                            )->format('d/m/Y')
                                            : '—'
                                        }}

                                    </div>

                                </div>

                                <span class="badge bg-primary">
                                    Vigente
                                </span>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>



        {{-- ========================================================
            3. MEDICACIÓN
        ======================================================== --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">

                <h5 class="mb-0 text-primary">

                    <i class="bi bi-capsule me-2"></i>

                    3. Medicación Administrada

                </h5>


                <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    id="add-medicacion"
                >

                    <i class="bi bi-plus-circle me-1"></i>

                    Agregar Medicación

                </button>

            </div>


            <div class="card-body">

                <div id="medicaciones-container">

                    @forelse($caso->medicaciones as $index => $med)

                        <div class="row g-2 mb-2 medicacion-item">

                            <div class="col-md-6">

                                <input
                                    type="text"
                                    name="medicaciones[{{ $index }}][nombre]"
                                    value="{{ old(
                                        "medicaciones.$index.nombre",
                                        $med->nombre
                                    ) }}"
                                    class="form-control"
                                    placeholder="Nombre de la medicación"
                                >

                            </div>


                            <div class="col-md-4">

                                <input
                                    type="text"
                                    name="medicaciones[{{ $index }}][numero_lote]"
                                    value="{{ old(
                                        "medicaciones.$index.numero_lote",
                                        $med->numero_lote
                                    ) }}"
                                    class="form-control"
                                    placeholder="Número de lote"
                                >

                            </div>


                            <div class="col-md-2">

                                <button
                                    type="button"
                                    class="btn btn-outline-danger w-100 remove-medicacion"
                                >

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </div>

                    @empty

                        <div class="row g-2 mb-2 medicacion-item">

                            <div class="col-md-6">

                                <input
                                    type="text"
                                    name="medicaciones[0][nombre]"
                                    class="form-control"
                                    placeholder="Nombre de la medicación"
                                >

                            </div>


                            <div class="col-md-4">

                                <input
                                    type="text"
                                    name="medicaciones[0][numero_lote]"
                                    class="form-control"
                                    placeholder="Número de lote"
                                >

                            </div>


                            <div class="col-md-2">

                                <button
                                    type="button"
                                    class="btn btn-outline-danger w-100 remove-medicacion"
                                >

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>



        {{-- ========================================================
            4. RED DE CONTENCIÓN
        ======================================================== --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 text-primary">

                    <i class="bi bi-heart-pulse me-2"></i>

                    4. Red de Contención

                </h5>

            </div>


            <div class="card-body">

                @php

                    $redesSeleccionadas = old(
                        'redes_contencion',
                        $caso->redesContencion
                            ->pluck('id')
                            ->toArray()
                    );

                @endphp


                <div class="d-flex flex-wrap gap-2">

                    @foreach($redes as $red)

                        <input
                            type="checkbox"
                            class="btn-check"
                            name="redes_contencion[]"
                            value="{{ $red->id }}"
                            id="red_{{ $red->id }}"
                            autocomplete="off"

                            {{ in_array(
                                $red->id,
                                $redesSeleccionadas
                            ) ? 'checked' : '' }}
                        >

                        <label
                            class="red-chip"
                            for="red_{{ $red->id }}"
                        >

                            {{ $red->nombre }}

                        </label>

                    @endforeach

                </div>

            </div>

        </div>



        {{-- ========================================================
            5. HISTORIAL DE INTERVENCIONES
        ======================================================== --}}
        <div
            class="card shadow-sm border-0 mb-4 border-start border-4"
            style="border-color:#198754!important;"
        >

            <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 py-3">

                <h5 class="mb-0 text-success fw-bold">

                    <i class="bi bi-clock-history me-2"></i>

                    5. Historial de Intervenciones

                </h5>


                <a
                    href="{{ route(
                        'ive.intervenciones.create',
                        $caso->id
                    ) }}"
                    class="btn btn-sm btn-success px-3 shadow-sm"
                >

                    <i class="bi bi-plus-circle me-1"></i>

                    Nueva Intervención

                </a>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr class="small text-uppercase">

                                <th style="width: 12%;">
                                    Fecha
                                </th>

                                <th style="width: 17%;">
                                    Tipo
                                </th>

                                <th style="width: 18%;">
                                    Profesional
                                </th>

                                <th style="width: 28%;">
                                    Detalle
                                </th>

                                <th style="width: 12%;" class="text-center">
                                    Archivos
                                </th>

                                <th style="width: 13%;" class="text-end">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody class="small">

                            @forelse($caso->intervenciones as $intervencion)

                                <tr>

                                    {{-- FECHA --}}
                                    <td class="fw-bold">

                                        {{ $intervencion->fecha_intervencion
                                            ? \Carbon\Carbon::parse(
                                                $intervencion->fecha_intervencion
                                            )->format('d/m/Y')
                                            : 'S/D'
                                        }}

                                    </td>


                                    {{-- TIPO --}}
                                    <td>

                                        {{ $intervencion->tipo->nombre
                                            ?? 'S/D'
                                        }}

                                    </td>


                                    {{-- PROFESIONAL --}}
                                    <td>

                                        @if($intervencion->encargado)

                                            {{ $intervencion->encargado->apellido }},
                                            {{ $intervencion->encargado->nombre }}

                                        @else

                                            <span class="text-muted">
                                                Sin asignar
                                            </span>

                                        @endif

                                    </td>


                                    {{-- DETALLE --}}
                                    <td>

                                        {{ \Illuminate\Support\Str::limit(
                                            $intervencion->detalle,
                                            80
                                        ) }}

                                    </td>


                                    {{-- ARCHIVOS --}}
                                    <td class="text-center">

                                        @if($intervencion->adjuntos->isNotEmpty())

                                            <span class="badge archivo-badge">

                                                <i class="bi bi-paperclip me-1"></i>

                                                {{ $intervencion->adjuntos->count() }}

                                                {{ $intervencion->adjuntos->count() === 1
                                                    ? 'archivo'
                                                    : 'archivos'
                                                }}

                                            </span>

                                        @else

                                            <span class="text-muted small">

                                                Sin archivos

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACCIONES --}}
                                    <td class="text-end">

                                        <div class="btn-group">

                                            {{-- VER --}}
                                            <a
                                                href="{{ route(
                                                    'ive.intervenciones.show',
                                                    [
                                                        'caso' => $caso->id,
                                                        'intervencion' => $intervencion->id
                                                    ]
                                                ) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Visualizar intervención"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- EDITAR --}}
                                            <a
                                                href="{{ route(
                                                    'ive.intervenciones.edit',
                                                    [
                                                        'id' => $intervencion->id
                                                    ]
                                                ) }}"
                                                class="btn btn-sm btn-outline-secondary"
                                                title="Editar intervención"
                                            >

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="text-center text-muted py-5"
                                    >

                                        <i class="bi bi-journal-x fs-2 d-block mb-2 opacity-50"></i>

                                        No hay intervenciones registradas en este caso.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>



        {{-- ========================================================
            BOTÓN ACTUALIZAR
        ======================================================== --}}
        <div class="card shadow-sm border-0">

            <div class="card-body bg-light text-end py-3">

                <button
                    type="submit"
                    class="btn btn-lg text-white px-5 shadow-sm"
                    style="background: #5651A0;"
                >

                    <i class="bi bi-save-fill me-2"></i>

                    ACTUALIZAR REGISTRO IVE

                </button>

            </div>

        </div>

    </form>

</div>



{{-- ================================================================
    ESTILOS
================================================================ --}}
<style>

    .card {
        border-radius: 14px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 1px solid #edf0f4;
    }


    .form-control,
    .form-select {
        border-color: #dee2e6;
        border-radius: 9px;
    }

    .form-control:focus,
    .form-select:focus {

        border-color: #5651A0;

        box-shadow:
            0 0 0 .2rem
            rgba(86, 81, 160, .15);

    }


    .switch-card {

        display: flex;
        align-items: center;

        min-height: 58px;

        padding: 15px;

        border: 1px solid #e6e9ed;

        border-radius: 10px;

        background: white;

        box-shadow:
            0 2px 8px
            rgba(15, 23, 42, .04);

    }


    .violencia-chip,
    .red-chip {

        display: inline-block;

        padding: 8px 16px;

        border-radius: 50px;

        border: 1px solid #dee2e6;

        background-color: #f8f9fa;

        cursor: pointer;

        transition: all .2s ease;

        font-size: .9rem;

        font-weight: 500;

    }


    .violencia-chip:hover,
    .red-chip:hover {

        transform: translateY(-1px);

        box-shadow:
            0 3px 8px
            rgba(0, 0, 0, .08);

    }


    .btn-check:checked + .violencia-chip {

        background-color: #dc3545;

        color: white;

        border-color: #dc3545;

    }


    .btn-check:checked + .red-chip {

        background-color: #5651A0;

        color: white;

        border-color: #5651A0;

    }


    .medicacion-item {

        padding: 10px;

        border: 1px solid #edf0f4;

        border-radius: 10px;

        background: #f8f9fa;

    }


    .cud-alert {

        display: flex;

        justify-content: space-between;

        align-items: center;

        background: #f0f7ff;

        border: 1px solid #d9eaff;

        border-left: 5px solid #0d6efd;

    }


    .archivo-badge {

        padding: 7px 10px;

        color: #157347;

        background: #d1e7dd;

        border: 1px solid #a3cfbb;

        border-radius: 50px;

        font-weight: 600;

    }


    .table > :not(caption) > * > * {

        padding-top: .9rem;

        padding-bottom: .9rem;

    }


    @media(max-width: 767px) {

        .table {

            min-width: 850px;

        }

    }

</style>



{{-- ================================================================
    JAVASCRIPT
================================================================ --}}
<script>

document.addEventListener('DOMContentLoaded', function () {


    $('#persona_id_ive').select2({

        theme: 'bootstrap-5',

        width: '100%'

    });



    const violenciaCheckbox =
        document.getElementById('violencia_previa');

    const violenciaContainer =
        document.getElementById('violencia-container');


    if (
        violenciaCheckbox &&
        violenciaContainer
    ) {

        violenciaCheckbox.addEventListener(
            'change',
            function () {

                if (this.checked) {

                    $(violenciaContainer)
                        .stop(true, true)
                        .fadeIn();

                } else {

                    $(violenciaContainer)
                        .stop(true, true)
                        .fadeOut();

                }

            }
        );

    }



    let medIndex =
        {{ $caso->medicaciones->count() > 0
            ? $caso->medicaciones->count()
            : 1
        }};


    const botonAgregar =
        document.getElementById('add-medicacion');

    const contenedor =
        document.getElementById(
            'medicaciones-container'
        );


    if (
        botonAgregar &&
        contenedor
    ) {

        botonAgregar.addEventListener(
            'click',
            function () {

                const html = `

                    <div class="row g-2 mb-2 medicacion-item">

                        <div class="col-md-6">

                            <input
                                type="text"
                                name="medicaciones[${medIndex}][nombre]"
                                class="form-control"
                                placeholder="Nombre de la medicación"
                            >

                        </div>

                        <div class="col-md-4">

                            <input
                                type="text"
                                name="medicaciones[${medIndex}][numero_lote]"
                                class="form-control"
                                placeholder="Número de lote"
                            >

                        </div>

                        <div class="col-md-2">

                            <button
                                type="button"
                                class="btn btn-outline-danger w-100 remove-medicacion"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </div>

                `;


                contenedor.insertAdjacentHTML(
                    'beforeend',
                    html
                );


                medIndex++;

            }
        );

    }



    document.addEventListener(
        'click',
        function (event) {

            const boton =
                event.target.closest(
                    '.remove-medicacion'
                );


            if (!boton) {
                return;
            }


            const items =
                document.querySelectorAll(
                    '.medicacion-item'
                );


            if (items.length > 1) {

                boton
                    .closest('.medicacion-item')
                    .remove();

            } else {

                const item =
                    boton.closest(
                        '.medicacion-item'
                    );


                item
                    .querySelectorAll('input')
                    .forEach(function (input) {

                        input.value = '';

                    });

            }

        }
    );

});

</script>

@endsection