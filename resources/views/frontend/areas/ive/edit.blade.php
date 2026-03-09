@extends('frontend.layouts.front')

@section('title','Editar Atención IVE')

@section('content')
{{-- Assets de Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0" style="color: #5651A0;">
                <i class="bi bi-pencil-square"></i> Editar Atención IVE
            </h2>
            <p class="text-muted">Actualizando registro de: <strong>{{ $caso->persona->apellido }}, {{ $caso->persona->nombre }}</strong></p>
        </div>
        <a href="{{ route('frontend.areas.ive.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <form action="{{ route('frontend.areas.ive.update', $caso->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- 1. IDENTIFICACIÓN Y ALERTA --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-badge me-2"></i>1. Identificación de la Persona</h5>
            </div>
            <div class="card-body">
                {{-- Alerta de Género (Basada en la variable $existeEnGenero del controlador) --}}
                <div id="alerta-vinculacion-genero" class="alert alert-warning border-0 shadow-sm mb-4 {{ $existeEnGenero ? '' : 'd-none' }} animate__animated animate__fadeIn">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-exclamation me-3 fs-3"></i>
                        <div>
                            <strong>Atención: Caso en Género Detectado</strong><br>
                            Esta persona posee un registro activo en la <strong>Dirección de Género</strong>. Se recomienda abordaje integral.
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold text-secondary">Persona (Solo Femenino)</label>
                        <select name="persona_id" id="persona_id_ive" class="form-select" required>
                            @foreach($personas as $persona)
                                <option value="{{ $persona->id }}" 
                                    {{ $caso->persona_id == $persona->id ? 'selected' : '' }}
                                    data-vinculada="{{ ($persona->id == $caso->persona_id && $existeEnGenero) ? 'true' : 'false' }}">
                                    {{ $persona->apellido }}, {{ $persona->nombre }} (DNI {{ $persona->dni }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted italic">Solo se listan personas de sexo femenino según protocolo.</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-secondary">Profesional Encargado</label>
                        <select name="encargado_id" class="form-select border-primary-subtle shadow-sm">
                            <option value="">Seleccione encargado...</option>
                            @foreach($encargados as $encargado)
                                <option value="{{ $encargado->id }}" {{ $caso->encargado_id == $encargado->id ? 'selected' : '' }}>
                                    {{ $encargado->apellido }} {{ $encargado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. DATOS MÉDICOS Y SOCIALES --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-activity me-2"></i>2. Datos Médicos y Antecedentes</h5>
            </div>
            <div class="card-body bg-light-subtle">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Fecha Última Menstruación (FUM)</label>
                        <input type="date" name="fum" value="{{ $caso->fum }}" class="form-control border-0 shadow-sm">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Semanas (ECO)</label>
                        <input type="number" name="eco_semanas" value="{{ $caso->eco_semanas }}" class="form-control border-0 shadow-sm">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Cantidad de Hijos</label>
                        <input type="number" name="cantidad_hijos" value="{{ $caso->cantidad_hijos ?? 0 }}" class="form-control border-0 shadow-sm">
                    </div>
                    <div class="col-md-3 mt-auto">
                        <div class="form-check form-switch p-2 bg-white rounded shadow-sm border text-center">
                            <input class="form-check-input ms-0 me-2" type="checkbox" name="obra_social" value="1" id="os" {{ $caso->obra_social ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="os">¿Posee Obra Social?</label>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="form-check form-switch p-3 bg-white rounded shadow-sm border h-100">
                            <input class="form-check-input mx-1" type="checkbox" name="interrupcion_previa" value="1" id="ip" {{ $caso->interrupcion_previa ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="ip">Interrupción Previa</label>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="form-check form-switch p-3 bg-white rounded shadow-sm border h-100">
                            <input class="form-check-input mx-1 text-danger" type="checkbox" name="violencia_previa" value="1" id="violencia_previa" {{ $caso->violencia_previa ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-danger" for="violencia_previa">¿Vivió violencia previa?</label>
                        </div>
                    </div>

                    {{-- Tipos de Violencia (Condicional) --}}
                    <div class="col-md-12 mt-3" id="violencia-container" style="{{ $caso->violencia_previa ? '' : 'display: none;' }}">
                        <div class="p-3 border rounded bg-white shadow-sm">
                            <label class="form-label fw-bold mb-3 text-danger"><i class="bi bi-exclamation-triangle"></i> Tipos de Violencia Detectada</label>
                            <div class="d-flex flex-wrap gap-2">
                                @php $tiposSeleccionados = $caso->tiposViolencia->pluck('id')->toArray(); @endphp
                                @foreach($tiposViolencia as $tipo)
                                    <input type="checkbox" class="btn-check" name="tipos_violencia[]" value="{{ $tipo->id }}" id="violencia_{{ $tipo->id }}" autocomplete="off" {{ in_array($tipo->id, $tiposSeleccionados) ? 'checked' : '' }}>
                                    <label class="violencia-chip" for="violencia_{{ $tipo->id }}">{{ $tipo->nombre }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. MEDICACIÓN --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-capsule me-2"></i>3. Medicación Administrada</h5>
                <button type="button" class="btn btn-sm btn-primary" id="add-medicacion">
                    <i class="bi bi-plus-circle"></i> Agregar Medicación
                </button>
            </div>
            <div class="card-body">
                <div id="medicaciones-container">
                    @forelse($caso->medicaciones as $index => $med)
                        <div class="row g-2 mb-2 medicacion-item bg-light p-2 rounded">
                            <div class="col-md-6">
                                <input type="text" name="medicaciones[{{ $index }}][nombre]" value="{{ $med->nombre }}" class="form-control border-0 shadow-sm" placeholder="Nombre de la medicación">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="medicaciones[{{ $index }}][numero_lote]" value="{{ $med->numero_lote }}" class="form-control border-0 shadow-sm" placeholder="Número de lote">
                            </div>
                            <div class="col-md-2 text-end">
                                <button type="button" class="btn btn-outline-danger w-100 remove-medicacion"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    @empty
                        <div class="row g-2 mb-2 medicacion-item bg-light p-2 rounded">
                            <div class="col-md-6"><input type="text" name="medicaciones[0][nombre]" class="form-control border-0 shadow-sm" placeholder="Nombre"></div>
                            <div class="col-md-4"><input type="text" name="medicaciones[0][numero_lote]" class="form-control border-0 shadow-sm" placeholder="Lote"></div>
                            <div class="col-md-2 text-end"><button type="button" class="btn btn-outline-danger w-100 remove-medicacion"><i class="bi bi-trash"></i></button></div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- 4. RED DE CONTENCIÓN --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary"><i class="bi bi-heart-pulse me-2"></i>4. Red de Contención y Cierre</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary mb-3">¿Con qué redes cuenta la persona?</label>
                    <div class="d-flex flex-wrap gap-2">
                        @php $redesSeleccionadas = $caso->redesContencion->pluck('id')->toArray(); @endphp
                        @foreach($redes as $red)
                            <input type="checkbox" class="btn-check" name="redes_contencion[]" value="{{ $red->id }}" id="red_{{ $red->id }}" autocomplete="off" {{ in_array($red->id, $redesSeleccionadas) ? 'checked' : '' }}>
                            <label class="red-chip" for="red_{{ $red->id }}">{{ $red->nombre }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light text-end py-3">
                <button type="submit" class="btn btn-lg text-white px-5 shadow-sm" style="background: #5651A0;">
                    <i class="bi bi-save-fill me-2"></i> ACTUALIZAR REGISTRO IVE
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .card { border-radius: 12px; }
    .form-control:focus, .form-select:focus { border-color: #5651A0; box-shadow: 0 0 0 0.2rem rgba(86, 81, 160, 0.25); }
    .violencia-chip, .red-chip {
        display: inline-block; padding: 8px 16px; border-radius: 50px; border: 1px solid #dee2e6;
        background-color: #f8f9fa; cursor: pointer; transition: all 0.2s; font-size: 0.9rem; font-weight: 500;
    }
    .btn-check:checked + .violencia-chip { background-color: #dc3545; color: white; border-color: #dc3545; }
    .btn-check:checked + .red-chip { background-color: #5651A0; color: white; border-color: #5651A0; }
    .violencia-chip:hover, .red-chip:hover { background-color: #e9ecef; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select2
    $('#persona_id_ive').select2({ theme: 'bootstrap-5', width: '100%' });

    // Lógica mostrar/ocultar violencia
    const checkboxViolencia = document.querySelector('input[name="violencia_previa"]');
    const containerViolencia = document.getElementById('violencia-container');
    checkboxViolencia.addEventListener('change', function() {
        this.checked ? $(containerViolencia).fadeIn() : $(containerViolencia).fadeOut();
    });

    // Lógica dinámica de Medicaciones
    let medIndex = {{ $caso->medicaciones->count() > 0 ? $caso->medicaciones->count() : 1 }};
    document.getElementById('add-medicacion').addEventListener('click', function () {
        const container = document.getElementById('medicaciones-container');
        const html = `
            <div class="row g-2 mb-2 medicacion-item animate__animated animate__fadeIn bg-light p-2 rounded">
                <div class="col-md-6"><input type="text" name="medicaciones[${medIndex}][nombre]" class="form-control border-0 shadow-sm" placeholder="Nombre"></div>
                <div class="col-md-4"><input type="text" name="medicaciones[${medIndex}][numero_lote]" class="form-control border-0 shadow-sm" placeholder="Lote"></div>
                <div class="col-md-2 text-end"><button type="button" class="btn btn-outline-danger w-100 remove-medicacion"><i class="bi bi-trash"></i></button></div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        medIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-medicacion')) {
            const items = document.querySelectorAll('.medicacion-item');
            if(items.length > 1) e.target.closest('.medicacion-item').remove();
        }
    });
});
</script>
@endsection