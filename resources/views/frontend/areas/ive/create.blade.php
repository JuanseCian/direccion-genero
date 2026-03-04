@extends('frontend.layouts.front')

@section('title','Registrar Atención IVE')

@section('content')


<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-clipboard2-plus"></i> Nueva Atención IVE
        </h2>
        <a href="{{ route('frontend.areas.ive.index') }}" class="btn btn-light border-0">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('frontend.areas.ive.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            {{-- SECCIÓN: Identificación --}}
            <div class="col-12">
                <div id="alerta-vinculacion-genero" class="alert alert-warning border-0 shadow-sm mb-3 d-none animate__animated animate__fadeIn">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-exclamation me-3 fs-3"></i>
                        <div>
                            <strong>Atención: Caso en Género Detectado</strong><br>
                            Esta persona ya posee un registro activo en la <strong>Dirección de Género</strong>. 
                            Se recomienda realizar un abordaje integral entre ambas áreas.
                        </div>
                    </div>
                </div>
                <div class="p-3 rounded" style="background: #f8f9fa;">
                    <label class="form-label fw-bold">Seleccionar Persona (Solo Femenino)</label>
                    <select name="persona_id" id="persona_id_ive" class="form-select shadow-sm" required>
                        <option value="" selected disabled>Seleccione una persona...</option>
                        @foreach($personas as $persona)
                            <option value="{{ $persona->id }}" 
                                    data-vinculada="{{ in_array($persona->id, $idsEnGenero) ? 'true' : 'false' }}">
                                {{ $persona->apellido }}, {{ $persona->nombre }} (DNI {{ $persona->dni }})
                                {{ in_array($persona->id, $idsEnGenero) ? ' ⚠️' : '' }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Solo se listan personas de sexo femenino según protocolo.</small>
                </div>
            </div>

            {{-- SECCIÓN: Datos Médicos --}}
            <div class="col-md-6">
                <label class="form-label fw-bold">Fecha de Última Menstruación (FUM)</label>
                <input type="date" name="fum" class="form-control border-0 shadow-sm"> {{-- --}}
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Semanas (ECO)</label>
                <input type="number" name="eco_semanas" class="form-control border-0 shadow-sm" placeholder="Semanas por ecografía"> {{-- --}}
            </div>
            <div class="col-md-12 mt-4">
                <label class="form-label fw-bold">Medicación administrada</label>

                <div id="medicaciones-container">
                    <div class="row g-2 mb-2 medicacion-item">
                        <div class="col-md-6">
                            <input type="text"
                                name="medicaciones[0][nombre]"
                                class="form-control"
                                placeholder="Nombre de la medicación">
                        </div>
                        <div class="col-md-4">
                            <input type="text"
                                name="medicaciones[0][numero_lote]"
                                class="form-control"
                                placeholder="Número de lote">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger w-100 remove-medicacion">X</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-medicacion">
                    + Agregar medicación
                </button>
            </div>
            {{-- SECCIÓN: Antecedentes y Social --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">Cantidad de Hijos</label>
                <input type="number" name="cantidad_hijos" value="0" class="form-control border-0 shadow-sm"> {{-- --}}
            </div>
            <div class="col-md-4 mt-auto">
                <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input mx-1" type="checkbox" name="obra_social" value="1" id="os"> {{-- --}}
                    <label class="form-check-label fw-bold" for="os">¿Posee Obra Social?</label>
                </div>
            </div>
            <div class="col-md-4 mt-auto">
                <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input mx-1" type="checkbox" name="interrupcion_previa" value="1" id="ip"> {{-- --}}
                    <label class="form-check-label fw-bold" for="ip">Interrupción Previa</label>
                </div>
            </div>

            <div class="col-md-4 mt-2">
            <div class="form-check form-switch p-3 bg-light rounded shadow-sm">
                    <input class="form-check-input mx-1" 
                        type="checkbox" 
                        name="violencia_previa" 
                        value="1" 
                        id="violencia_previa">
                    <label class="form-check-label fw-bold" for="violencia_previa">
                        ¿Vivió violencia previa?
                    </label>
                </div>
            </div>

           <div class="col-md-12 mt-3" id="violencia-container" style="display: none;">
                <label class="form-label fw-bold mb-2 text-danger">
                    Tipos de violencia
                </label>

                <div class="d-flex flex-wrap gap-2">
                    @foreach($tiposViolencia as $tipo)
                        <input type="checkbox"
                            class="btn-check"
                            name="tipos_violencia[]"
                            value="{{ $tipo->id }}"
                            id="violencia_{{ $tipo->id }}"
                            autocomplete="off"
                            @if(isset($caso) && $caso->tiposViolencia->contains($tipo->id)) checked @endif>

                        <label class="violencia-chip"
                            for="violencia_{{ $tipo->id }}">
                            {{ $tipo->nombre }}
                        </label>
                    @endforeach
                </div>
            </div>
            
         <div class="col-md-12 mt-3">
            <label class="form-label fw-bold mb-2">Red de contención</label>

            <div class="d-flex flex-wrap gap-2">
                @foreach($redes as $red)
                    <input type="checkbox"
                        class="btn-check"
                        name="redes_contencion[]"
                        value="{{ $red->id }}"
                        id="red_{{ $red->id }}"
                        autocomplete="off"
                        @if(isset($caso) && $caso->redesContencion->contains($red->id)) checked @endif>

                    <label class="red-chip"
                        for="red_{{ $red->id }}">
                        {{ $red->nombre }}
                    </label>
                @endforeach
            </div>
        </div>
                <label>Encargado</label>
                <select name="encargado_id" class="form-control">
                    <option value="">Seleccionar Encargado</option>
                    @foreach($encargados as $encargado)
                    <option value="{{ $encargado->id }}"> {{ $encargado->apellido }} {{ $encargado->nombre }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 mt-4">
                <hr style="opacity: 0.1;">
                <button type="submit" class="btn text-white px-5 py-2 shadow-sm" style="background: #5651A0;">
                    <i class="bi bi-save"></i> Guardar Registro IVE
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectPersonaIve = document.getElementById('persona_id_ive');
    const alertaGenero = document.getElementById('alerta-vinculacion-genero');

    if(selectPersonaIve) {
        selectPersonaIve.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            // Si el atributo data-vinculada es true, mostramos el aviso
            if (selectedOption.dataset.vinculada === 'true') {
                alertaGenero.classList.remove('d-none');
            } else {
                alertaGenero.classList.add('d-none');
            }
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.querySelector('input[name="violencia_previa"]');
    const container = document.getElementById('violencia-container');

    function toggleViolencia() {
        if (checkbox.checked) {
            container.style.display = 'block';
            container.style.opacity = 0;
            container.style.transition = 'opacity 0.3s ease';
            setTimeout(() => container.style.opacity = 1, 10);
        } else {
            container.style.opacity = 0;
            setTimeout(() => container.style.display = 'none', 300);
        }
    }

    toggleViolencia();
    checkbox.addEventListener('change', toggleViolencia);
});
</script>
<script>
let index = 1;

document.getElementById('add-medicacion').addEventListener('click', function () {
    const container = document.getElementById('medicaciones-container');

    const html = `
        <div class="row g-2 mb-2 medicacion-item">
            <div class="col-md-6">
                <input type="text"
                       name="medicaciones[${index}][nombre]"
                       class="form-control"
                       placeholder="Nombre de la medicación">
            </div>
            <div class="col-md-4">
                <input type="text"
                       name="medicaciones[${index}][numero_lote]"
                       class="form-control"
                       placeholder="Número de lote">
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
</script>
@endsection