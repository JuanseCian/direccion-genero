@extends('frontend.layouts.front')

@section('title', 'Editar Legajo de Género')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container-fluid py-4">

    {{-- ENCABEZADO ESTILO CREATE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0" style="color: #5651A0;">
                <i class="bi bi-pencil-square"></i> Editar Legajo: {{ $legajo->persona->apellido }}, {{ $legajo->persona->nombre }}
            </h2>
            <p class="text-muted">DNI {{ $legajo->persona->dni }} - Módulo de Género</p>
        </div>

        <div>
            <button type="button" class="btn btn-info btn-sm text-white shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#modalIntervenciones">
                <i class="bi bi-chat-right-text"></i> Intervenciones
            </button>
            <a href="{{ route('genero.index') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </div>

    {{-- ALERTA IVE ESTILO CREATE --}}
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

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trabaja" class="form-label fw-bold">¿Trabaja actualmente?</label>
                            <select name="trabaja" id="trabaja" class="form-select shadow-sm border-secondary-subtle">
                                <option value="" selected disabled>Seleccione...</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3"></div>

                        <div class="col-md-6 mb-3">
                            <label for="participa_organizacion" class="form-label fw-bold">¿Participa en organización social?</label>
                            <select name="participa_organizacion" id="participa_organizacion" class="form-select shadow-sm border-secondary-subtle" onchange="toggleOrganizacion()">
                                <option value="" selected disabled>Seleccione...</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="detalle_organizacion" class="form-label fw-bold">Detalle de la organización</label>
                            <input type="text" name="detalle_organizacion" id="detalle_organizacion" class="form-control shadow-sm border-secondary-subtle" placeholder="Nombre de la organización" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. AGRESORES VINCULADOS (Lógica original, diseño adaptado) --}}
        <div class="card shadow-sm border-0 mb-4 border-start border-4" style="border-color:#dc3545!important;">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-danger">
                    <i class="bi bi-person-exclamation me-2"></i>3. Agresores Vinculados
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
        {{-- 4. GRUPO CONVIVIENTE (PENÚLTIMA SECCIÓN) --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-house-heart me-2"></i>4. Grupo Conviviente</h5>
                <button type="button" class="btn btn-sm btn-primary px-3 shadow-sm" onclick="agregarFamiliar()">
                    <i class="bi bi-plus-circle me-1"></i> Añadir Integrante
                </button>
            </div>
            <div class="card-body">
                <div id="grupoFamiliarContainer">
                    <p id="msgVacio" class="text-muted small text-center italic py-2">No hay integrantes registrados para este legajo.</p>
                </div>
            </div>
        </div>

        {{-- 5. RESPONSABLE Y CIERRE --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-check me-2"></i>5. Responsable y Cierre</h5>
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
        // Inicializar Select2 en los desplegables comunes
        $('.select2-init').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });
    });

    // --- LOGICA ORIGINAL DE AGRESORES MANTENIDA INTACTA ---
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
        detalle.classList.remove('bg-light'); // Para que visualmente se note activo
    } else {
        detalle.disabled = true;
        detalle.value = "";
        detalle.classList.add('bg-light'); // Color grisáceo cuando está desactivado
    }
}
</script>

@endsection