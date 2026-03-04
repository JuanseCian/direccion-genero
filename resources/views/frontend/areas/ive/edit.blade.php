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

            {{-- PERSONA --}}
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

            {{-- DATOS MÉDICOS --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">FUM</label>
                <input type="date" name="fum" class="form-control border-0 shadow-sm" value="{{ $caso->fum }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Semanas (ECO)</label>
                <input type="number" name="eco_semanas" class="form-control border-0 shadow-sm" value="{{ $caso->eco_semanas }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold text-success">Fecha Alta</label>
                <input type="date" name="alta" class="form-control border-start border-success border-3 shadow-sm" value="{{ $caso->alta }}">
            </div>

            {{-- SOCIALES --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">Cantidad de Hijos</label>
                <input type="number" name="cantidad_hijos" class="form-control border-0 shadow-sm" value="{{ $caso->cantidad_hijos }}">
            </div>

            <div class="col-md-4 mt-auto">
                <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input mx-1" type="checkbox" name="obra_social" value="1" {{ $caso->obra_social ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold">¿Posee Obra Social?</label>
                </div>
            </div>

            <div class="col-md-4 mt-auto">
                <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input mx-1"  type="checkbox" name="interrupcion_previa" value="1" {{ $caso->interrupcion_previa ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold">Interrupción Previa</label>
                </div>
            </div>

            {{-- VIOLENCIA PREVIA --}}
            <div class="col-md-4 mt-2">
                <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input mx-1" type="checkbox" id="violencia_previa" name="violencia_previa" value="1" {{ $caso->violencia_previa ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold text-danger">Violencia Previa</label>
                </div>
            </div>

            {{-- TIPOS DE VIOLENCIA --}}
            <div class="col-12 mt-3" id="violencia-container" style="display:none;">
                <label class="form-label fw-bold text-danger mb-2">Tipos de Violencia</label>

                <div class="d-flex flex-wrap gap-2">
                    @foreach($tiposViolencia as $tipo)
                        <input type="checkbox"
                               class="btn-check"
                               name="tipos_violencia[]"
                               value="{{ $tipo->id }}"
                               id="violencia_{{ $tipo->id }}"
                               autocomplete="off"
                               {{ $caso->tiposViolencia->contains($tipo->id) ? 'checked' : '' }}>

                        <label class="violencia-chip" for="violencia_{{ $tipo->id }}">
                            {{ $tipo->nombre }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- RED DE CONTENCIÓN --}}
            <div class="col-12 mt-4">
                <label class="form-label fw-bold mb-2">Red de Contención</label>

                <div class="d-flex flex-wrap gap-2">
                    @foreach($redes as $red)
                        <input type="checkbox"
                               class="btn-check"
                               name="redes_contencion[]"
                               value="{{ $red->id }}"
                               id="red_{{ $red->id }}"
                               autocomplete="off"
                               {{ $caso->redesContencion->contains($red->id) ? 'checked' : '' }}>

                        <label class="red-chip" for="red_{{ $red->id }}">
                            {{ $red->nombre }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- MEDICACIONES --}}
            <div class="col-12 mt-4">
                <label class="form-label fw-bold">Medicaciones</label>

                <div id="medicaciones-container">
                    @foreach($caso->medicaciones as $index => $med)
                        <div class="row g-2 mb-2 medicacion-item">
                            <div class="col-md-6">
                                <input type="text" name="medicaciones[{{ $index }}][nombre]"
                                       class="form-control"
                                       value="{{ $med->nombre }}"
                                       placeholder="Nombre medicación">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="medicaciones[{{ $index }}][numero_lote]"
                                       class="form-control"
                                       value="{{ $med->numero_lote }}"
                                       placeholder="Número lote">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger w-100 remove-medicacion">X</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-medicacion">
                    + Agregar medicación
                </button>
            </div>

            {{-- ENCARGADO --}}
            <div class="col-12 mt-3">
                <label>Encargado</label>
                <select name="encargado_id" class="form-control">
                    @foreach($encargados as $encargado)
                        <option value="{{ $encargado->id }}"
                            {{ $legajo->encargado_id == $encargado->id ? 'selected' : '' }}>
                            {{ $encargado->apellido }} {{ $encargado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- BOTÓN --}}
            <div class="col-12 mt-4 text-end">
                <hr style="opacity: 0.1;">
                <button type="submit" class="btn text-white px-5 py-2 shadow-sm" style="background: #5651A0;">
                    <i class="bi bi-check-circle"></i> Actualizar Cambios
                </button>
            </div>

        </div>
    </form>
</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const violenciaCheckbox = document.getElementById('violencia_previa');
    const violenciaContainer = document.getElementById('violencia-container');

    function toggleViolencia() {
        if (violenciaCheckbox.checked) {
            violenciaContainer.style.display = 'block';
        } else {
            violenciaContainer.style.display = 'none';
        }
    }

    toggleViolencia();
    violenciaCheckbox.addEventListener('change', toggleViolencia);

    let index = {{ $caso->medicaciones->count() }};

    document.getElementById('add-medicacion').addEventListener('click', function () {
        const container = document.getElementById('medicaciones-container');

        const html = `
            <div class="row g-2 mb-2 medicacion-item">
                <div class="col-md-6">
                    <input type="text" name="medicaciones[${index}][nombre]" class="form-control" placeholder="Nombre medicación">
                </div>
                <div class="col-md-4">
                    <input type="text" name="medicaciones[${index}][numero_lote]" class="form-control" placeholder="Número lote">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100 remove-medicacion">X</button>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        index++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-medicacion')) {
            e.target.closest('.medicacion-item').remove();
        }
    });

});
</script>

@endsection