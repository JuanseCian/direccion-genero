@extends('frontend.layouts.front')

@section('title','Nuevo Caso - Masculinidades')

@section('content')
{{-- Agrega esto al inicio o final de tu sección de contenido --}}
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

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-badge me-2"></i>1. Identificación del Agresor y Responsables</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Agresor <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select name="persona_id" id="select-agresor" class="form-select @error('persona_id') is-invalid @enderror" required>
                                <option value="">Seleccione al hombre...</option>
                                @foreach($agresores as $agresor)
                                    <option value="{{ $agresor->id }}">{{ $agresor->apellido }}, {{ $agresor->nombre }} (DNI: {{ $agresor->dni }})</option>
                                @endforeach
                            </select>
                        </div>
                        @error('persona_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary">Profesional a Cargo</label>
                        <select name="encargado_id" class="form-select border-primary-subtle">
                            <option value="">Seleccione encargado...</option>
                            @foreach($encargados as $encargado)
                                <option value="{{ $encargado->id }}">{{ $encargado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi- journal-text me-2"></i>2. Contexto del Caso</h5>
            </div>
            <div class="card-body bg-light-subtle">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Derivación</label>
                        <select name="derivacion_id" class="form-select" required>
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
                        <label class="form-label fw-bold text-secondary">¿Debe realizar el dispositivo?</label>
                        <select name="debe_dispositivo" id="debeDispositivo" class="form-select border-info">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>

                    <div class="col-md-4" id="camposDispositivo" style="display:none;">
                        <label class="form-label fw-bold">Asistencia al dispositivo</label>
                        <select name="asistencia_dispositivo" class="form-select bg-info-subtle">
                            <option value="">Seleccione...</option>
                            <option value="regular text-success">Regular</option>
                            <option value="irregular text-warning">Irregular</option>
                            <option value="abandono text-danger">Abandonó</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-secondary">Reincidencia (Cant. veces)</label>
                        <input type="number" name="reincidencia" class="form-control" value="0" min="0">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="form-label fw-bold text-secondary text-uppercase small">Comportamientos y Condiciones</label>
                        <div class="row g-2 p-3 rounded border bg-white shadow-sm">
                            <div class="col-md-3 border-end text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="trabaja" value="1">
                                    <label class="form-check-label fw-bold">¿Trabaja?</label>
                                </div>
                            </div>
                            <div class="col-md-3 border-end text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="consumo" value="1" id="consumoSwitch">
                                    <label class="form-check-label fw-bold text-warning">¿Consumo?</label>
                                </div>
                            </div>
                            <div class="col-md-3 border-end text-center" id="terapiaContainer" style="display: none;">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="terapia" value="1" id="terapiaSwitch">
                                    <label class="form-check-label fw-bold text-success">¿En Terapia?</label>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
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

        <div class="card shadow-sm border-0 mb-4 border-start border-4 border-danger">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-danger"><i class="bi bi-shield-exclamation me-2"></i>4. Información de la Víctima</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Víctima</label>
                        <select name="victima_id" class="form-select @error('victima_id') is-invalid @enderror" required>
                            <option value="">Seleccione persona...</option>
                            @foreach($victimas as $victima)
                                <option value="{{ $victima->id }}">{{ $victima->apellido }}, {{ $victima->nombre }} ({{ $victima->dni }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small">Hijos en común</label>
                        <input type="number" name="hijos_en_comun" class="form-control" value="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small">Situación Sanitaria</label>
                        <select name="situacion_sanitaria_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($situacionSanitaria as $ss)
                                <option value="{{ $ss->id }}">{{ $ss->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <div class="row align-items-center bg-light p-3 rounded">
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="relacion_actual" value="1" id="relacionActualSwitch">
                                    <label class="form-check-label fw-bold">¿Vínculo actual con la víctima?</label>
                                </div>
                            </div>
                            <div class="col-md-8" id="tipoRelacionContainer" style="display:none;">
                                <input type="text" name="descripcion_relacion" class="form-control" placeholder="Describa el tipo de relación (Ej: Conviviente, Pareja...)">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-gavel me-2"></i>Medidas Cautelares Vigentes</label>
                        <div class="row p-3 border rounded bg-white">
                            @foreach($medidasCautelares as $medida)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="medida_id[]" value="{{ $medida->id }}" id="m{{ $medida->id }}">
                                        <label class="form-check-label small" for="m{{ $medida->id }}">{{ $medida->nombre }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <div class="col-12">
                        <label class="form-label fw-bold"><i class="bi bi-paperclip"></i> Adjuntar Certificados o Documentación</label>
                        <input type="file" name="certificado" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="form-text text-muted small italic">Sube archivos PDF o Imágenes que respalden el caso.</div>
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
    .card { border-radius: 12px; transition: 0.3s; }
    .form-label { font-size: 0.9rem; }
    .form-control:focus, .form-select:focus { border-color: #5651A0; box-shadow: 0 0 0 0.2rem rgba(86, 81, 160, 0.25); }
    .bg-light-subtle { background-color: #f8f9fa; }
    .border-primary-subtle { border-color: #5651a055 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const consumo = document.getElementById('consumoSwitch');
    const terapiaContainer = document.getElementById('terapiaContainer');

    function toggleTerapia() {
        if (consumo.checked) {
            terapiaContainer.style.display = 'block';
        } else {
            terapiaContainer.style.display = 'none';
            document.getElementById('terapiaSwitch').checked = false;
        }
    }

    // Ejecutar al cargar
    toggleTerapia();

    // Ejecutar al cambiar
    consumo.addEventListener('change', toggleTerapia);
});
</script>
<script>
let index = 0;

function agregarFamiliar() {

    const container = document.getElementById('grupoFamiliarContainer');

    const html = `
        <div class="card p-3 mt-3 border">
            <div class="row g-2">

                <div class="col-md-3">
                    <input type="text" name="grupo[${index}][nombre]" 
                           class="form-control" placeholder="Nombre">
                </div>

                <div class="col-md-3">
                    <input type="text" name="grupo[${index}][apellido]" 
                           class="form-control" placeholder="Apellido">
                </div>

                <div class="col-md-3">
                    <input type="text" name="grupo[${index}][telefono]" 
                           class="form-control" placeholder="Teléfono">
                </div>

                <div class="col-md-2">
                    <select name="grupo[${index}][vinculo]" class="form-select">
                        <option value="">Vínculo</option>
                        <option value="padre">Padre</option>
                        <option value="madre">Madre</option>
                        <option value="hermano">Hermano</option>
                        <option value="hijo">Hijo</option>
                        <option value="hija">Hija</option>
                    </select>
                </div>

                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.card').remove()">
                        X
                    </button>
                </div>

            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);

    index++;
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const switchRelacion = document.getElementById('relacionActualSwitch');
    const tipoContainer = document.getElementById('tipoRelacionContainer');
    const tipoInput = document.querySelector('input[name="descripcion_relacion"]');

    function toggleRelacion() {
        if (switchRelacion.checked) {
            tipoContainer.style.display = 'block';
        } else {
            tipoContainer.style.display = 'none';
            tipoInput.value = '';
        }
    }

    toggleRelacion();
    switchRelacion.addEventListener('change', toggleRelacion);

});
</script>

<script>

function toggleDispositivo() {

    let valor = document.getElementById('debeDispositivo').value;
    let bloque = document.getElementById('camposDispositivo');

    if (valor == 1) {
        bloque.style.display = 'flex';
    } else {
        bloque.style.display = 'none';
    }
}

document.getElementById('debeDispositivo').addEventListener('change', toggleDispositivo);

window.addEventListener('load', toggleDispositivo);

$(document).ready(function() {
    $('#select-agresor').select2({
        theme: 'bootstrap-5', // Para que mantenga la estética de tu formulario
        width: '100%',
        placeholder: 'Escriba DNI, Nombre o Apellido...',
        language: {
            noResults: function() {
                return "No se encontraron coincidencias";
            }
        }
    });
});

</script>


@endsection