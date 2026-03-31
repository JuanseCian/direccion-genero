@extends('frontend.layouts.front')

@section('title','Editar Persona')

@section('content')

<style>
    /* Estilos pulidos de la interfaz */
    .form-control, .form-select {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 0.6rem 1rem;
        transition: all 0.2s;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff;
        border-color: #6a63c7;
        box-shadow: 0 0 0 0.25rem rgba(106, 99, 199, 0.15);
    }
    .form-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .section-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .section-title {
        color: #6a63c7;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f0f0f5;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    /* Estilo para los switches */
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    .form-switch .form-check-label {
        padding-left: 0.5em;
        padding-top: 0.2em;
        font-weight: 500;
        cursor: pointer;
    }
    /* Tarjeta CUD */
    .cud-card {
        background: #f8faff;
        border: 1px solid #dbeafe;
        border-left: 5px solid #3b82f6;
        border-radius: 10px;
    }
    .cud-empty {
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 10px;
        transition: all 0.2s;
    }
    .cud-empty:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
</style>

<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="bi bi-person-gear text-primary me-2"></i> Editar Persona: <span class="text-secondary">{{ $persona->nombre }} {{ $persona->apellido }}</span>
        </h3>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-3">
        <div class="d-flex align-items-center fw-bold mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Por favor, corrige los siguientes errores:
        </div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('personas.update', $persona->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        {{-- SECCIÓN 1: DATOS PERSONALES --}}
        <div class="section-card">
            <div class="section-title">
                <i class="bi bi-person-vcard"></i> Datos Personales
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <label class="form-label">DNI</label>
                    <input type="text" name="dni" value="{{ old('dni', $persona->dni) }}" class="form-control @error('dni') is-invalid @enderror" >
                    @error('dni')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" value="{{ old('apellido', $persona->apellido) }}" class="form-control" >
                </div>

                <div class="col-md-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $persona->nombre) }}" class="form-control" >
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        Fecha nacimiento 
                        <span id="edadTexto" class="text-muted"></span>
                    </label>

                    <input type="date" 
                        name="fecha_nacimiento" 
                        id="fecha_nacimiento"
                        class="form-control"
                        value="{{ $persona->fecha_nacimiento }}">
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Sexo</label>
                    <select name="sexo" class="form-select" >
                        <option value="">Seleccione</option>
                        <option value="Masculino" {{ $persona->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ $persona->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 2: ROLES EN EL SISTEMA --}}
        <div class="section-card bg-light border-0">
            <div class="section-title text-secondary border-secondary-subtle">
                <i class="bi bi-tags-fill"></i> Clasificación en el Sistema
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input bg-danger border-danger" type="checkbox" name="agresor" value="1" id="agresor" {{ $persona->agresor ? 'checked' : '' }}>
                        <label class="form-check-label text-danger fw-bold" for="agresor">Es agresor</label>
                    </div>
                </div>

                <div class="col-md-4 {{ $persona->agresor ? '' : 'd-none' }}" id="campo_masculinidades">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input bg-info border-info" type="checkbox" name="debe_asistir_masculinidades" value="1" id="masculinidades" {{ $persona->debe_asistir_masculinidades ? 'checked' : '' }}>
                        <label class="form-check-label text-info fw-bold" for="masculinidades">Debe asistir a Masculinidades</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input bg-success border-success" type="checkbox" name="victima" value="1" id="victima" {{ $persona->victima ? 'checked' : '' }}>
                        <label class="form-check-label text-success fw-bold" for="victima">Es víctima</label>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 3: CONTACTO --}}
        <div class="section-card">
            <div class="section-title">
                <i class="bi bi-geo-alt-fill"></i> Contacto y Ubicación
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                        <input type="text" name="telefono" value="{{ old('telefono', $persona->telefono) }}" class="form-control border-start-0 ps-0">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Domicilio</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-house text-muted"></i></span>
                        <input type="text" name="domicilio" value="{{ old('domicilio', $persona->domicilio) }}" class="form-control border-start-0 ps-0">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Provincia</label>
                    <select name="provincia_id" class="form-select">
                        <option value="">Seleccione Provincia</option>
                        @foreach($provincias as $prov)
                        <option value="{{ $prov->id }}" {{ $persona->provincia_id == $prov->id ? 'selected' : '' }}> {{ $prov->nombre }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Localidad</label>
                    <select name="localidad_id" class="form-select">
                        <option value="">Seleccione Localidad</option>
                        @foreach($localidades as $loc)
                        <option value="{{ $loc->id }}" {{ $persona->localidad_id == $loc->id ? 'selected' : '' }}> {{ $loc->nombre }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Barrio</label>
                    <select name="barrio_id" class="form-select">
                        <option value="">Seleccione Barrio</option>
                        @foreach($barrios as $barrio)
                        <option value="{{ $barrio->id }}" {{ $persona->barrio_id == $barrio->id ? 'selected' : '' }}> {{ $barrio->nombre }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 4: INFORMACIÓN ADICIONAL Y CUD --}}
        <div class="section-card">
            <div class="section-title">
                <i class="bi bi-journal-plus"></i> Información Adicional
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Trabaja</label>
                    <select name="trabaja" class="form-select" >
                        <option value="">Seleccione</option>
                        <option value="1" {{ $persona->trabaja == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ $persona->trabaja == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nivel Estudio</label>
                    <select name="nivel_estudio_id" class="form-select" >
                        <option value="">Seleccione Nivel</option>
                        @foreach($nivelEstudio as $nivel)
                            <option value="{{ $nivel->id }}" {{ $persona->nivel_estudio_id == $nivel->id ? 'selected' : '' }}>{{ $nivel->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Grupo sanguíneo</label>
                    <select name="grupo_sanguineo" class="form-select">
                        <option value="">Seleccione</option>
                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $gs)
                            <option value="{{ $gs }}" {{ $persona->grupo_sanguineo == $gs ? 'selected' : '' }}>{{ $gs }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="my-4 border-light">

            {{-- GESTIÓN DEL CUD --}}
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label d-block mb-3">Certificado Único de Discapacidad</label>

                    @if($persona->cud)
                        @php
                            $vencido = $persona->cud->fecha_vencimiento 
                                        && \Carbon\Carbon::parse($persona->cud->fecha_vencimiento)->isPast();
                        @endphp

                        <div id="contenedor_cud" class="cud-card p-3 p-md-4 shadow-sm">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white p-3 rounded-circle shadow-sm me-3 text-primary">
                                        <i class="bi bi-person-wheelchair fs-3"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark">CUD Registrado</h6>
                                        <div class="small text-muted">
                                            <span class="me-3"><i class="bi bi-hash"></i> <span id="txt_num_cud">{{ $persona->cud->numero_cud }}</span></span>
                                            <span class="me-3"><i class="bi bi-calendar-event"></i> Emisión: <span id="txt_emision_cud">{{ $persona->cud->fecha_emision ? \Carbon\Carbon::parse($persona->cud->fecha_emision)->format('d/m/Y') : '—' }}</span></span>
                                            <span><i class="bi bi-calendar-x"></i> Vence: <span id="txt_vencimiento_cud">{{ $persona->cud->fecha_vencimiento ? \Carbon\Carbon::parse($persona->cud->fecha_vencimiento)->format('d/m/Y') : '—' }}</span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-md-end text-center mt-3 mt-md-0">
                                    <span class="badge {{ $vencido ? 'bg-danger' : 'bg-success' }} fs-6 mb-2 rounded-pill px-3 py-2 shadow-sm">
                                        <i class="bi {{ $vencido ? 'bi-exclamation-circle' : 'bi-check-circle' }} me-1"></i>
                                        {{ $vencido ? 'CUD Vencido' : 'CUD Vigente' }}
                                    </span>
                                    <br>
                                    <button type="button" class="btn btn-outline-primary rounded-pill btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalCud">
                                        <i class="bi bi-pencil-square me-1"></i> Modificar Datos
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="contenedor_sin_cud" class="cud-empty p-4 text-center">
                            <div class="text-muted mb-3">
                                <i class="bi bi-file-earmark-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                No se han registrado datos de discapacidad para esta persona.
                            </div>
                            <button type="button" class="btn btn-primary rounded-pill shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#modalCud">
                                <i class="bi bi-plus-circle me-1"></i> Cargar Datos de CUD
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- BOTONERA --}}
        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('personas.index') }}" class="btn btn-light btn-lg px-4 border rounded-pill shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Cancelar
            </a>
            <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                <i class="bi bi-save me-1"></i> Actualizar Persona
            </button>
        </div>

        <div class="modal fade" id="modalCud" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    
                    <div class="modal-header bg-primary text-white rounded-top-4 py-3">
                        <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-medical me-2"></i>Datos del CUD</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4 bg-light">
                        <div class="mb-3">
                            <label class="form-label">Número de CUD</label>
                            <input type="text" name="numero_cud" value="{{ old('numero_cud', $persona->cud->numero_cud ?? '') }}" class="form-control" placeholder="Ej: 000-111-222">
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Fecha emisión</label>
                                <input type="date" name="fecha_emision_cud" value="{{ old('fecha_emision_cud', $persona->cud->fecha_emision ?? '') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha vencimiento</label>
                                <input type="date" name="fecha_vencimiento_cud" value="{{ old('fecha_vencimiento_cud', $persona->cud->fecha_vencimiento ?? '') }}" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones_cud" class="form-control" rows="2" placeholder="Detalles adicionales...">{{ old('observaciones_cud', $persona->cud->observaciones ?? '') }}</textarea>
                        </div>

                        <hr class="border-secondary opacity-25">

                        <div class="mb-2">
                            <label class="form-label fw-bold text-primary">Adjuntar Archivo (PDF, JPG, PNG)</label>
                            <input type="file" name="archivo_cud" class="form-control bg-white" accept=".pdf, image/*, .jfif">
                            
                            @if($persona->cud && $persona->cud->archivo_adjunto)
                                <div class="mt-3 p-3 border rounded bg-white shadow-sm d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-0 text-dark small fw-bold"><i class="bi bi-paperclip text-primary"></i> Archivo actual cargado</p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('personas.ver_cud', $persona->id) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill" title="Ver archivo">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('personas.descargar_cud', $persona->id) }}" class="btn btn-sm btn-outline-success rounded-pill" title="Descargar archivo">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer bg-white rounded-bottom-4 py-3 d-flex justify-content-between align-items-center">
                        <span id="cudCargado" class="badge bg-success py-2 px-3 rounded-pill shadow-sm d-none">
                            <i class="bi bi-check-circle me-1"></i> Cambios en memoria
                        </span>
                        <div class="ms-auto">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" id="btnGuardarCud" data-bs-dismiss="modal">Aceptar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const chkAgresor = document.getElementById('agresor');
    const campoMasculinidades = document.getElementById('campo_masculinidades');

    // Muestra u oculta masculinidades basado en agresor
    chkAgresor.addEventListener('change', function(){
        campoMasculinidades.classList.toggle('d-none', !this.checked);
        if(!this.checked) {
            document.getElementById('masculinidades').checked = false;
        }
    });

    // Lógica para actualizar visualmente la tarjeta si se modifica en el modal
    document.getElementById('btnGuardarCud').addEventListener('click', function(){
        const num = document.querySelector('input[name="numero_cud"]').value;
        const emision = document.querySelector('input[name="fecha_emision_cud"]').value;
        const vencimiento = document.querySelector('input[name="fecha_vencimiento_cud"]').value;

        // Si la tarjeta ya existe, actualizamos sus textos en vivo
        if(document.getElementById('txt_num_cud')) {
            document.getElementById('txt_num_cud').innerText = num || '—';
            document.getElementById('txt_emision_cud').innerText = emision ? emision.split('-').reverse().join('/') : '—';
            document.getElementById('txt_vencimiento_cud').innerText = vencimiento ? vencimiento.split('-').reverse().join('/') : '—';
        }
        
        // Muestra el badge dentro del modal (y opcionalmente podrías agregar un Toast aquí si quieres)
        document.getElementById('cudCargado').classList.remove('d-none');
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function(){

    const fechaInput = document.getElementById('fecha_nacimiento');
    const edadTexto = document.getElementById('edadTexto');

    function calcularEdad(fecha) {
        if (!fecha) return '';

        const hoy = new Date();
        const nacimiento = new Date(fecha);

        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const mes = hoy.getMonth() - nacimiento.getMonth();

        if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
            edad--;
        }

        return edad;
    }

    function actualizarEdad() {
        const edad = calcularEdad(fechaInput.value);
        edadTexto.innerHTML = edad ? `(${edad} años)` : '';
    }

    fechaInput.addEventListener('change', actualizarEdad);

    // 👇 importante: calcular al cargar
    actualizarEdad();

});
</script>

@endsection