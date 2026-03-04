@extends('frontend.layouts.front')

@section('title','Editar Legajo de Género')

@section('content')


@if(isset($existeEnIve) && $existeEnIve)
    <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center" role="alert" style="background: #fff3cd; border-left: 5px solid #ffc107 !important;">
        <i class="bi bi-exclamation-diamond-fill me-3 fs-4 text-warning"></i>
        <div>
            <strong>Atención: Vinculación de Áreas</strong><br>
            Esta persona cuenta con un registro activo en el <strong>Área IVE</strong>. 
            Se recomienda coordinar acciones con dicho departamento.
        </div>
    </div>
@endif

<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-pencil-square"></i>  {{ $legajo->persona->apellido }}, {{ $legajo->persona->nombre }} <br><small>{{$legajo->persona->dni}}</small>
        </h2>
        <a href="{{ route('genero.index') }}" class="btn btn-light border-0">
            <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <form action="{{ route('genero.update', $legajo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="persona_id" value="{{ $legajo->persona_id }}">
        
        <div class="row g-4">
            {{-- SECCIÓN: Información Personal (Solo lectura o Selección) --}}
            <div class="col-md-12">
                <div class="p-3 rounded mb-2" style="background: #ecebfa; color: #5651A0;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-person-badge me-2"></i> Identificación del Legajo</h6>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Género Autopercibido</label>
                <input type="text" name="genero" class="form-control border-0 shadow-sm" 
                       value="{{ old('genero', $legajo->genero) }}" placeholder="Ej: Mujer Trans, No binario, etc.">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Nivel de Estudios</label>
                <select name="nivel_estudio_id" class="form-select border-0 shadow-sm">
                    @foreach($niveles_estudio as $nivel)
                        <option value="{{ $nivel->id }}" {{ $legajo->nivel_estudio_id == $nivel->id ? 'selected' : '' }}>
                            {{ $nivel->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SECCIÓN: Ubicación --}}
            <div class="col-md-12 mt-4">
                <div class="p-3 rounded mb-2" style="background: #f8f9fa;">
                    <h6 class="fw-bold mb-0 text-muted"><i class="bi bi-geo-alt me-2"></i> Ubicación y Residencia</h6>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Localidad</label>
                <select name="localidad_id" class="form-select border-0 shadow-sm">
                    @foreach($localidades as $loc)
                        <option value="{{ $loc->id }}" {{ $legajo->localidad_id == $loc->id ? 'selected' : '' }}>
                            {{ $loc->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Barrio</label>
                <select name="barrio_id" class="form-select border-0 shadow-sm">
                    <option value="">Seleccionar Barrio</option>
                    @foreach($barrios as $barrio)
                        <option value="{{ $barrio->id }}" {{ $legajo->barrio_id == $barrio->id ? 'selected' : '' }}>
                            {{ $barrio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            

            
            <div class="col-md-4">
                <label class="form-label fw-bold">Estado Civil</label>
                <select name="estado_civil_id" class="form-select border-0 shadow-sm">
                    @foreach($estados_civiles as $estado)
                        <option value="{{ $estado->id }}" {{ $legajo->estado_civil_id == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- Lista de Agresores Seleccionados --}}
                <div class="col-md-12 mt-4">
                    <div class="p-3 rounded mb-2" style="background: #f8f9fa;">
                        <h6 class="fw-bold mb-0 text-muted"><i class="bi bi-briefcase me-2"></i> Agresores</h6>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                <div class="p-3 rounded mb-3" style="background: #fff0f0; color: #a05151; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-person-exclamation me-2"></i> Agresores Vinculados (Área Masculinidades)</h6>
                    <button type="button" class="btn btn-sm btn-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgresores">
                        <i class="bi bi-plus-circle me-1"></i> Vincular Agresor
                    </button>
                </div>
             
                <div id="lista-agresores" class="row g-3">
                    @foreach($legajo->agresores as $agresor)
                        <div class="col-md-4" id="agresor-item-{{ $agresor->id }}">
                            <div class="card border-0 shadow-sm p-2 d-flex flex-row align-items-center justify-content-between" style="background: #fdf2f2;">
                                <div class="small">
                                    <a href="{{ route('masculinidades.edit', $agresor->id) }}" class="text-decoration-none" target="_blank">
                                        <span class="fw-bold text-danger">#{{ $agresor->id }}</span> - {{ $agresor->persona->apellido }}
                                        <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <input type="hidden" name="agresores[]" value="{{ $agresor->id }}">
                                </div>
                                <button type="button" class="btn btn-link text-danger p-0" onclick="quitarAgresor({{ $agresor->id }})">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal fade" id="modalAgresores" tabindex="-1" aria-labelledby="modalAgresoresLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="modalAgresoresLabel">Buscar Legajo en Masculinidades</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                                <input type="text" id="busquedaAgresor" class="form-control border-0 bg-light" placeholder="Buscar por Nombre, Apellido o DNI...">
                            </div>
                            
                            <div style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Legajo</th>
                                            <th>Nombre Completo</th>
                                            <th>DNI</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaResultadosAgresores">
                                        @foreach($casosMasculinidades as $casoM)
                                        <tr class="fila-agresor">
                                            <td><strong>#{{ $casoM->id }}</strong></td>
                                            <td>{{ $casoM->persona->apellido }}, {{ $casoM->persona->nombre }}</td>
                                            <td>{{ $casoM->persona->dni }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        onclick="agregarAgresor({{ $casoM->id }}, '{{ $casoM->persona->apellido }} {{ $casoM->persona->nombre }}')">
                                                    Seleccionar
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
            {{-- SECCIÓN: Situación Socio-Laboral --}}
            <div class="col-md-12 mt-4">
                <div class="p-3 rounded mb-2" style="background: #f8f9fa;">
                    <h6 class="fw-bold mb-0 text-muted"><i class="bi bi-briefcase me-2"></i> Situación Laboral</h6>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch p-3 bg-white rounded shadow-sm border">
                    <input class="form-check-input" type="checkbox" name="trabaja" value="1" id="trabaja" 
                           {{ $legajo->trabaja ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="trabaja">¿Posee empleo actualmente?</label>
                </div>
            </div>
            <div class="mb-3">
                <label>Encargado</label>
                <select name="encargado_id" class="form-control">
                    <option value="">Seleccionar Encargado</option>

                    @foreach($encargados as $encargado)
                    <option value="{{ $encargado->id }}"
                        {{ $legajo->encargado_id == $encargado->id ? 'selected' : '' }}>
                        {{ $encargado->apellido }} {{ $encargado->nombre }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-danger">Situación de Vulnerabilidad / Observaciones</label>
                <textarea name="observaciones" class="form-control border-0 shadow-sm" rows="2">{{ $legajo->observaciones ?? '' }}</textarea>
            </div>

            <div class="col-12 mt-5 text-end">
                <hr style="opacity: 0.1;">
                <button type="submit" class="btn text-white px-5 py-2 shadow-sm" style="background: #5651A0;">
                    <i class="bi bi-save me-2"></i> Guardar Cambios en Legajo
                </button>
            </div>
        </div>
    </form>
</div>

<script>
// Buscador en tiempo real dentro del modal
document.getElementById('busquedaAgresor').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll('#tablaResultadosAgresores .fila-agresor');
    
    filas.forEach(fila => {
        let texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});

const urlBaseMasculinidades = "{{ route('masculinidades.edit', ':id') }}";
// Función para agregar el agresor a la lista visual
function agregarAgresor(id, nombre) {
    if (document.getElementById('agresor-item-' + id)) {
        alert('Este agresor ya ha sido seleccionado.');
        return;
    }
    const urlLegajo = urlBaseMasculinidades.replace(':id', id);

    const lista = document.getElementById('lista-agresores');
    const html = `
        <div class="col-md-4" id="agresor-item-${id}">
            <div class="card border-0 shadow-sm p-2 d-flex flex-row align-items-center justify-content-between" style="background: #fdf2f2;">
                <div class="small">
                    <span class="fw-bold text-danger">#${id}</span> - ${nombre}
                    <input type="hidden" name="agresores[]" value="${id}">
                </div>
                <button type="button" class="btn btn-link text-danger p-0" onclick="quitarAgresor(${id})">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </div>
        </div>
    `;
    lista.insertAdjacentHTML('beforeend', html);
    
    // Opcional: Cerrar el modal o dar feedback
    // var modal = bootstrap.Modal.getInstance(document.getElementById('modalAgresores'));
    // modal.hide();
}

// Función para quitar de la lista
function quitarAgresor(id) {
    const elemento = document.getElementById('agresor-item-' + id);
    if (elemento) {
        elemento.remove();
    }
}
</script>
@endsection