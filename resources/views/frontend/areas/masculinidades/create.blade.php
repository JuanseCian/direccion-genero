@extends('frontend.layouts.front')

@section('title','Nuevo Caso - Masculinidades')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0" style="color: #5651A0;">
                <i class="bi bi-person-plus-fill"></i> Registro de Nuevo Caso
            </h2>
            <p class="text-muted">Módulo de Masculinidades - Registro de Agresores</p>
        </div>
        <a href="{{ route('masculinidades.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <form action="{{ route('masculinidades.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 1. IDENTIFICACIÓN --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-badge me-2"></i>1. Identificación del Agresor y Responsables</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Agresor <span class="text-danger">*</span></label>
                        <select name="persona_id" id="select-agresor" class="form-select @error('persona_id') is-invalid @enderror" required>
                            <option value="">Seleccione al hombre...</option>
                            @foreach($agresores as $agresor)
                                <option value="{{ $agresor->id }}">{{ $agresor->apellido }}, {{ $agresor->nombre }} (DNI: {{ $agresor->dni }})</option>
                            @endforeach
                        </select>
                        @error('persona_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Profesional a Cargo</label>
                        <select name="encargado_id" class="form-select border-primary-subtle select2-init">
                            <option value="">Seleccione encargado...</option>
                            @foreach($encargados as $encargado)
                                <option value="{{ $encargado->id }}" 
                                    {{ (isset($caso) && $caso->encargado_id == $encargado->id) ? 'selected' : '' }}>
                                    {{ $encargado->apellido }}, {{ $encargado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. CONTEXTO --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-journal-text me-2"></i>2. Contexto del Caso</h5>
            </div>
            <div class="card-body bg-light-subtle">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Derivación</label>
                        <select name="derivacion_id" class="form-select" >
                            <option value="">Seleccione...</option>
                            @foreach($derivaciones as $d)
                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Situación Habitacional</label>
                        <select name="situacion_habitacional_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($situacionesHabitacionales as $sh)
                                <option value="{{ $sh->id }}">{{ $sh->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Espacio Grupal</label>
                        <select name="espacio_grupal_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($espacioGrupal as $esp)
                                <option value="{{ $esp->id }}">{{ $esp->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 my-3">
                        <div class="p-3 border rounded bg-white">
                            <label class="form-label fw-bold text-danger"><i class="bi bi-exclamation-triangle"></i> Tipos de Violencia Ejercida</label>
                            <div class="row">
                                @foreach($tipoViolencia as $tipo)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tipo_violencia_id[]" value="{{ $tipo->id }}" id="v{{ $tipo->id }}">
                                            <label class="form-check-label" for="v{{ $tipo->id }}">{{ $tipo->nombre }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-secondary">Reincidencia (Cant. veces)</label>
                        <input type="number" name="reincidencia" class="form-control" value="0" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nivel de Estudio</label>
                        <select name="nivel_estudio_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Estado Civil</label>
                        <select name="estado_civil_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($estadosCiviles as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Medidas Cautelares</label>

                        <select name="medida_id[]" class="form-select" multiple>
                            @foreach($medidasCautelares as $medida)
                                <option value="{{ $medida->id }}">
                                    {{ $medida->nombre }}
                                </option>
                            @endforeach
                        </select>

                        <small class="text-muted">Puede seleccionar varias</small>
                    </div>
                                        {{-- COMPORTAMIENTOS Y CONDICIONES --}}
                    <div class="col-md-12 mt-3">
                        <label class="form-label fw-bold text-secondary text-uppercase small">Comportamientos y Condiciones</label>
                        <div class="row g-2 p-3 rounded border bg-white shadow-sm">
                            
                            <div class="col-md-4 border-end">
                                <div class="text-center">
                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input" type="checkbox" name="trabaja" value="1" id="trabajaSwitch">
                                        <label class="form-check-label fw-bold">¿Trabaja?</label>
                                    </div>
                                </div>
                                <div id="detalleTrabajoContainer" class="mt-2 px-2" style="display: none;">
                                    <input type="text" name="detalle_trabajo" class="form-control form-control-sm" placeholder="¿Dónde o de qué trabaja?">
                                </div>
                            </div>

                            <div class="col-md-4 border-end text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="consumo" value="1">
                                    <label class="form-check-label fw-bold text-warning">¿Consumo?</label>
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="terapia" value="1">
                                    <label class="form-check-label fw-bold text-success">¿En Terapia?</label>
                                </div>
                            </div>

                            <div class="col-12 border-top mt-2 pt-2 text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="desobediencia" value="1">
                                    <label class="form-check-label fw-bold text-danger">¿Desobediencia?</label>
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
                    <p class="text-muted small text-center italic py-2">No hay integrantes registrados en este formulario.</p>
                </div>
            </div>
        </div>

        {{-- OBSERVACIONES Y CIERRE --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Situación Judicial (Resumen)</label>
                        <textarea name="situacion_judicial" class="form-control" rows="3" placeholder="Detalles de la causa..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Observaciones Adicionales</label>
                        <textarea name="observaciones" class="form-control" rows="3"></textarea>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer bg-light text-end py-3">
                <button type="submit" class="btn btn-lg text-white px-5 shadow-sm" style="background: #5651A0;">
                    <i class="bi bi-save-fill me-2"></i> FINALIZAR Y GUARDAR CASO
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .card { border-radius: 12px; }
    .form-control:focus, .form-select:focus { border-color: #5651A0; box-shadow: 0 0 0 0.2rem rgba(86, 81, 160, 0.25); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Lógica Trabaja
    const trabajaSwitch = document.getElementById('trabajaSwitch');
    const detalleTrabajoContainer = document.getElementById('detalleTrabajoContainer');

    function toggleTrabajo() {
        if (trabajaSwitch.checked) {
            detalleTrabajoContainer.style.display = 'block';
        } else {
            detalleTrabajoContainer.style.display = 'none';
            detalleTrabajoContainer.querySelector('input').value = ''; 
        }
    }
    trabajaSwitch.addEventListener('change', toggleTrabajo);

    // Lógica Dispositivo
    const debeDispositivo = document.getElementById('debeDispositivo');
    const camposDispositivo = document.getElementById('camposDispositivo');

    function toggleDispositivo() {
        camposDispositivo.style.display = (debeDispositivo.value == "1") ? 'block' : 'none';
    }
    debeDispositivo.addEventListener('change', toggleDispositivo);

    // Select2
    $('#select-agresor').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Escriba DNI, Nombre o Apellido...'
    });
});

// Lógica Grupo Familiar
let index = 0;
function agregarFamiliar() {
    const container = document.getElementById('grupoFamiliarContainer');
    if(index === 0) container.innerHTML = ''; // Limpiar mensaje de vacío

    const html = `
        <div class="card p-3 mt-3 border shadow-sm">
            <div class="row g-2">
                <div class="col-md-2"><input type="text" name="grupo[${index}][nombre]" class="form-control" placeholder="Nombre"></div>
                <div class="col-md-2"><input type="text" name="grupo[${index}][apellido]" class="form-control" placeholder="Apellido"></div>
                <div class="col-md-2"><input type="text" name="grupo[${index}][dni]" class="form-control" placeholder="DNI"></div>
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
$('select[name="medida_id[]"]').select2({
    theme: 'bootstrap-5',
    placeholder: "Seleccione medidas",
});

$('.select2-init').select2({
    theme: 'bootstrap-5',
    width: '100%',
    placeholder: 'Seleccione encargado...'
});
</script>
@endsection