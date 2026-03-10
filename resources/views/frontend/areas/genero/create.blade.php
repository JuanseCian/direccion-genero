@extends('frontend.layouts.front')

@section('title', 'Nuevo Legajo de Género')

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
                <i class="bi bi-file-earmark-plus-fill"></i> Nuevo Legajo: Área Género
            </h2>
            <p class="text-muted">Módulo de Género - Registro y Seguimiento</p>
        </div>
        <a href="{{ route('genero.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <form action="{{ route('genero.store') }}" method="POST">
        @csrf

        {{-- Alerta IVE --}}
        <div id="alerta-vinculacion" class="alert alert-warning border-0 shadow-sm mb-4 d-none animate__animated animate__fadeIn">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-exclamation me-3 fs-3"></i>
                <div>
                    <strong>Atención: Legajo en IVE Detectado</strong><br>
                    Esta persona ya posee un registro activo en la <strong>Dirección de IVE</strong>.
                </div>
            </div>
        </div>

        {{-- 1. IDENTIFICACIÓN Y UBICACIÓN --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-badge me-2"></i>1. Identificación y Ubicación</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label class="form-label fw-bold text-secondary">Persona <span class="text-danger">*</span></label>
                        <select name="persona_id" id="persona_id" class="form-select @error('persona_id') is-invalid @enderror" required>
                            <option value="">Seleccione una persona...</option>
                            @foreach($personas as $persona)
                                <option value="{{ $persona->id }}"
                                    data-provincia="{{ $persona->provincia_id }}"
                                    data-localidad="{{ $persona->localidad_id }}"
                                    data-barrio="{{ $persona->barrio_id }}"
                                    data-nivel="{{ $persona->nivel_estudio_id }}"
                                    data-trabaja="{{ $persona->trabaja }}"
                                    data-vinculada="{{ in_array($persona->id, $idsIve) ? 'true' : 'false' }}">
                                    {{ $persona->apellido }}, {{ $persona->nombre }} (DNI {{ $persona->dni }})
                                    {{ in_array($persona->id, $idsIve) ? ' ⚠️' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('personas.create') }}" target="_blank" class="btn btn-primary w-100">
                            <i class="bi bi-plus-lg"></i> Nueva persona
                        </a>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="genero" class="form-label fw-bold text-secondary">Género autopercibido</label>
                        <input type="text" name="genero" id="genero" class="form-control" placeholder="Ej: Mujer Trans, No binario">
                    </div>
                    <div class="col-md-8"></div> {{-- Espaciador para mantener el grid ordenado --}}

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Provincia</label>
                        <select name="provincia_id" id="provincia_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($provincias as $provincia)
                                <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Localidad</label>
                        <select name="localidad_id" id="localidad_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Barrio</label>
                        <select name="barrio_id" id="barrio_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($barrios as $barrio)
                                <option value="{{ $barrio->id }}">{{ $barrio->nombre }}</option>
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
                        <select name="estado_civil_id" id="estado_civil_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($estados_civiles as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nivel de Estudio</label>
                        <select name="nivel_estudio_id" id="nivel_estudio_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($niveles_estudio as $nivel)
                                <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-secondary">¿Trabaja actualmente?</label>
                        <select name="trabaja" id="trabaja" class="form-select border-primary-subtle">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>

                    <div class="col-md-12 my-3">
                        <div class="p-3 border rounded bg-white shadow-sm">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary">¿Participa en organización social?</label>
                                    <select name="organizacion_social" id="organizacion_social" class="form-select border-info">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-bold text-secondary">Detalle de la organización</label>
                                    <input type="text" name="organizacion_social_detalle" class="form-control" placeholder="Nombre de la institución o agrupación">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. SITUACIÓN HABITACIONAL Y SERVICIOS --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-house-door me-2"></i>3. Situación Habitacional y Servicios</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Situación Habitacional</label>
                        <select name="situacion_habitacional_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($situacionesHabitacionales as $sh)
                                <option value="{{ $sh->id }}">{{ $sh->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold d-block">Servicios Básicos</label>
                        <div class="d-flex flex-wrap gap-3 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="servicios_luz" value="1" id="srv_luz">
                                <label class="form-check-label" for="srv_luz">Luz</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="servicios_cable" value="1" id="srv_cable">
                                <label class="form-check-label" for="srv_cable">Cable</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="servicios_gas_natural" value="1" id="srv_gas">
                                <label class="form-check-label" for="srv_gas">Gas Natural</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="servicios_agua_potable" value="1" id="srv_agua">
                                <label class="form-check-label" for="srv_agua">Agua potable</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="servicios_internet" value="1" id="srv_int">
                                <label class="form-check-label" for="srv_int">Internet</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. GRUPO CONVIVIENTE --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-people me-2"></i>4. Grupo Conviviente</h5>
                <button type="button" class="btn btn-sm btn-primary" onclick="agregarFamiliar()">
                    <i class="bi bi-plus-circle"></i> Añadir Integrante
                </button>
            </div>
            <div class="card-body">
                <div id="grupoFamiliarContainer">
                    <p id="msgVacio" class="text-muted small text-center fst-italic py-2">No hay integrantes registrados en este formulario.</p>
                </div>
            </div>
        </div>

        {{-- 5. DATOS DEL AGRESOR --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-danger"><i class="bi bi-person-x me-2"></i>5. Datos del Agresor</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-md-9">
                        <label class="form-label fw-bold">Buscar Agresor</label>
                        <select name="agresor_id" id="agresor_select" class="form-select">
                            <option value="">Seleccione agresor...</option>
                            @foreach($agresores as $agresor)
                                <option value="{{ $agresor->id }}"
                                    data-dni="{{ $agresor->dni }}"
                                    data-telefono="{{ $agresor->telefono }}"
                                    data-domicilio="{{ $agresor->domicilio }}"
                                    data-casos="0" {{-- Aquí deberás traer el conteo real si lo tienes --}}
                                    {{ old('agresor_id') == $agresor->id ? 'selected' : '' }}>
                                    {{ $agresor->apellido }} {{ $agresor->nombre }} - DNI {{ $agresor->dni }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('personas.create') }}" class="btn btn-outline-danger w-100" target="_blank">
                            <i class="bi bi-plus-lg"></i> Nuevo agresor
                        </a>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label class="text-muted small fw-bold">DNI</label>
                        <input type="text" id="agresor_dni" class="form-control bg-light" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="text-muted small fw-bold">Teléfono</label>
                        <input type="text" id="agresor_tel" class="form-control bg-light" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="text-muted small fw-bold">Domicilio</label>
                        <input type="text" id="agresor_dom" class="form-control bg-light" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="text-muted small fw-bold">Casos previos</label>
                        <input type="text" id="agresor_casos" class="form-control bg-light" readonly>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Trabajo del agresor</label>
                        <input type="text" name="agresor_trabajo" class="form-control" placeholder="Lugar de trabajo u oficio">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="debe_asistir_masculinidades" value="1" class="form-check-input border-danger" id="masculinidades">
                            <label class="form-check-label fw-bold text-danger" for="masculinidades">
                                Debe asistir a curso de masculinidades
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 6. ANTECEDENTES Y VIOLENCIA --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-warning text-darken"><i class="bi bi-shield-exclamation me-2"></i>6. Antecedentes y Violencia</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-3">
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" name="denuncio_antes" value="1" id="denuncio">
                            <label class="form-check-label fw-bold" for="denuncio">¿Denunció antes?</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label class="form-label fw-bold">Detalle de denuncias anteriores</label>
                        <input type="text" name="denuncio_antes_detalle" class="form-control" placeholder="Especificar juzgado, fechas o detalles relevantes">
                    </div>
                </div>

                <hr class="text-muted my-4">

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Medida Cautelar</label>
                        <select name="medida_cautelar_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($medida as $med)
                                <option value="{{ $med->id }}">{{ $med->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo de violencia</label>
                        <select name="tipo_violencia_id" id="tipo_violencia_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach($tipos_violencia as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha última denuncia</label>
                        <input type="date" name="fecha_ultima_denuncia" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <div class="form-check mt-4">
                            <input type="checkbox" class="form-check-input" name="amenaza_con_arma" value="1" id="arma">
                            <label class="form-check-label fw-bold text-danger" for="arma">¿Amenaza con arma?</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo de arma</label>
                        <input type="text" name="amenaza_tipo_arma" class="form-control" placeholder="Fuego, blanca...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Número botón de pánico</label>
                        <input type="text" name="boton_panico_numero" class="form-control" placeholder="N° de dispositivo">
                    </div>
                </div>
            </div>
        </div>

        {{-- 7. RESPONSABLE Y OBSERVACIONES --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-check me-2"></i>7. Responsable y Cierre</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-secondary">Profesional a Cargo</label>
                        <select name="encargado_id" class="form-select border-primary-subtle" required>
                            <option value="">Seleccione encargado...</option>
                            @foreach($encargados as $encargado)
                                <option value="{{ $encargado->id }}">{{ $encargado->apellido }} {{ $encargado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold text-secondary">Observaciones Adicionales</label>
                        <textarea name="observaciones" class="form-control" rows="2" placeholder="Notas importantes sobre el caso..."></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light p-4">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-lg text-white px-5 shadow-sm" style="background: #5651A0;">
                        <i class="bi bi-save-fill me-2"></i> GUARDAR LEGAJO
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .card { border-radius: 12px; }
    .form-control:focus, .form-select:focus { 
        border-color: #5651A0; 
        box-shadow: 0 0 0 0.2rem rgba(86, 81, 160, 0.25); 
    }
    .text-darken { color: #d97706 !important; }
</style>

<script>
$(document).ready(function() {
    // Inicializar Select2
    $('#persona_id, #agresor_select').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Escriba para buscar...'
    });

    // Lógica de autocompletado y alerta IVE
    $('#persona_id').on('change', function() {
        const selectedOption = $(this).find(':selected')[0];
        const alerta = document.getElementById('alerta-vinculacion');

        if (selectedOption && selectedOption.value) {
            if (selectedOption.dataset.vinculada === 'true') {
                alerta.classList.remove('d-none');
            } else {
                alerta.classList.add('d-none');
            }

            $('#provincia_id').val(selectedOption.dataset.provincia || '').trigger('change');
            $('#localidad_id').val(selectedOption.dataset.localidad || '').trigger('change');
            $('#barrio_id').val(selectedOption.dataset.barrio || '').trigger('change');
            $('#nivel_estudio_id').val(selectedOption.dataset.nivel || '').trigger('change');
            $('#trabaja').val(selectedOption.dataset.trabaja ?? 0);
        }
    });

    // Autocompletar datos del Agresor
    $('#agresor_select').on('change', function() {
        const selectedOption = $(this).find(':selected')[0];
        if(selectedOption && selectedOption.value) {
            $('#agresor_dni').val(selectedOption.dataset.dni || '');
            $('#agresor_tel').val(selectedOption.dataset.telefono || '');
            $('#agresor_dom').val(selectedOption.dataset.domicilio || '');
            $('#agresor_casos').val(selectedOption.dataset.casos || '0');
        } else {
            $('#agresor_dni, #agresor_tel, #agresor_dom, #agresor_casos').val('');
        }
    });
});

// Lógica Grupo Familiar
let index = 0;
function agregarFamiliar() {
    const container = document.getElementById('grupoFamiliarContainer');
    const msgVacio = document.getElementById('msgVacio');
    if(msgVacio) msgVacio.remove();

    const html = `
        <div class="card p-3 mt-3 border shadow-sm animate__animated animate__fadeInUp">
            <div class="row g-2 align-items-center">
                <div class="col-md-3"><input type="text" name="grupo[${index}][nombre]" class="form-control" placeholder="Nombre" required></div>
                <div class="col-md-3"><input type="text" name="grupo[${index}][apellido]" class="form-control" placeholder="Apellido" required></div>
                <div class="col-md-3"><input type="text" name="grupo[${index}][telefono]" class="form-control" placeholder="Teléfono"></div>
                <div class="col-md-2">
                    <select name="grupo[${index}][vinculo]" class="form-select" required>
                        <option value="">Vínculo</option>
                        <option value="padre">Padre</option>
                        <option value="madre">Madre</option>
                        <option value="hijo/a">Hijo/a</option>
                        <option value="hermano/a">Hermano/a</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-outline-danger btn-sm border-0" onclick="this.closest('.card').remove()">
                        <i class="bi bi-trash fs-5"></i>
                    </button>
                </div>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', html);
    index++;
}
</script>
@endsection