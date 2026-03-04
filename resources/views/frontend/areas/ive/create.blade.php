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
            <div class="mb-3">
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
@endsection