@extends('frontend.layouts.front')

@section('title','Nueva Persona')

@section('content')

<style>
    /* Pequeños ajustes para pulir la interfaz */
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
    /* Estilo especial para los switches */
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
</style>

<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="bi bi-person-plus-fill text-primary me-2"></i> Registrar Nueva Persona
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

    <form method="POST" action="{{ route('personas.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- SECCIÓN 1: DATOS PERSONALES --}}
        <div class="section-card">
            <div class="section-title">
                <i class="bi bi-person-vcard"></i> Datos Personales
            </div>
            
            <div class="row g-4">
                <div class="col-md-3">
                    <label class="form-label">DNI</label>
                    <input type="text" name="dni" class="form-control @error('dni') is-invalid @enderror" placeholder="Ej: 35123456">
                    @error('dni')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" placeholder="Apellido">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Fecha nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control">
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Sexo</label>
                    <select name="sexo" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
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
                        <input class="form-check-input bg-danger border-danger" type="checkbox" name="agresor" value="1" id="agresor">
                        <label class="form-check-label text-danger fw-bold" for="agresor">Es agresor</label>
                    </div>
                </div>

                <div class="col-md-4 d-none" id="campo_masculinidades">
                    <div class="form-check form-switch mt-2 fade-in">
                        <input class="form-check-input bg-info border-info" type="checkbox" name="debe_asistir_masculinidades" value="1" id="masculinidades">
                        <label class="form-check-label text-info fw-bold" for="masculinidades">Debe asistir a Masculinidades</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input bg-success border-success" type="checkbox" name="victima" value="1" id="victima">
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
                        <input type="text" name="telefono" class="form-control border-start-0 ps-0" placeholder="Ej: 3364 123456">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Domicilio</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-house text-muted"></i></span>
                        <input type="text" name="domicilio" class="form-control border-start-0 ps-0" placeholder="Calle y número">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Provincia</label>
                    <select name="provincia_id" class="form-select">
                        <option value="">Seleccione Provincia...</option>
                        @foreach($provincia as $provincia)
                            <option value="{{ $provincia->id }}"> {{ $provincia->nombre }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Localidad</label>
                    <select name="localidad_id" class="form-select">
                        <option value="">Seleccione Localidad...</option>
                        @foreach($localidad as $localidad)
                            <option value="{{ $localidad->id }}"> {{ $localidad->nombre }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Barrio</label>
                    <select name="barrio_id" class="form-select">
                        <option value="">Seleccione Barrio...</option>
                        @foreach($barrios as $barrio)
                            <option value="{{ $barrio->id }}"> {{ $barrio->nombre }} </option>
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

            <div class="row g-4 align-items-center">
                <div class="col-md-4">
                    <label class="form-label">Trabaja</label>
                    <select name="trabaja" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nivel Estudio</label>
                    <select name="nivel_estudio_id" class="form-select">
                        <option value="">Seleccione Nivel...</option>
                        @foreach($nivelEstudio as $nivel)
                            <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Grupo sanguíneo</label>
                    <select name="grupo_sanguineo" class="form-select">
                        <option value="">Seleccione...</option>
                        <option>A+</option><option>A-</option>
                        <option>B+</option><option>B-</option>
                        <option>AB+</option><option>AB-</option>
                        <option>O+</option><option>O-</option>
                    </select>
                </div>
            </div>

            <hr class="my-4 border-light">

            {{-- PANEL DEL CUD (Mejorado) --}}
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label d-block mb-3">Certificado Único de Discapacidad</label>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3 border rounded-3 bg-light">
                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <div class="bg-white p-2 rounded-circle shadow-sm me-3 text-primary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="bi bi-file-earmark-medical fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Adjuntar CUD</h6>
                                <small class="text-muted">Si la persona posee certificado, ingrese los datos aquí.</small>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-3">
                            <span id="cudCargadoBadge" class="badge bg-success py-2 px-3 rounded-pill d-none shadow-sm">
                                <i class="bi bi-check-circle-fill me-1"></i> Datos listos
                            </span>
                            <input class="form-check-input d-none" type="checkbox" id="tiene_cud">
                            <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCud" onclick="document.getElementById('tiene_cud').checked = true;">
                                <i class="bi bi-plus-circle me-1"></i> Configurar CUD
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTONERA --}}
        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('personas.index') }}" class="btn btn-light btn-lg px-4 border rounded-pill shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Cancelar
            </a>
            <button class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                <i class="bi bi-save me-1"></i> Guardar Persona
            </button>
        </div>
    </form>

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
                        <input type="text" name="numero_cud" class="form-control" placeholder="Ej: 000-111-222">
                    </div>

                    <div class="row mb-3 g-3">
                        <div class="col-6">
                            <label class="form-label">Fecha emisión</label>
                            <input type="date" name="fecha_emision_cud" class="form-control">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Fecha vencimiento</label>
                            <input type="date" name="fecha_vencimiento_cud" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea name="observaciones_cud" class="form-control" rows="2" placeholder="Detalles adicionales..."></textarea>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Adjuntar Archivo (Imagen o PDF)</label>
                        <input type="file" name="archivo_cud" class="form-control bg-white" accept=".pdf,image/*">
                        
                        @if(isset($persona->cud) && $persona->cud->archivo_adjunto)
                            <div class="mt-3 p-2 bg-white border rounded d-flex justify-content-between align-items-center">
                                <span class="text-muted small"><i class="bi bi-paperclip"></i> Archivo existente</span>
                                <a href="{{ asset('storage/' . $persona->cud->archivo_adjunto) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                                    Ver archivo
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer bg-white rounded-bottom-4 py-3">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" id="btnGuardarCudLocal" data-bs-dismiss="modal">
                        Aceptar y Continuar
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const chkAgresor = document.getElementById('agresor');
    const campoMasculinidades = document.getElementById('campo_masculinidades');

    // Muestra u oculta masculinidades con un pequeño delay para la fluidez
    chkAgresor.addEventListener('change', function(){
        if(this.checked){
            campoMasculinidades.classList.remove('d-none');
        }else{
            campoMasculinidades.classList.add('d-none');
            document.getElementById('masculinidades').checked = false; // Desmarca si se oculta
        }
    });

    // Lógica visual para indicar que el CUD fue cargado
    document.getElementById('btnGuardarCudLocal').addEventListener('click', function(){
        // Mostramos el badge principal en el formulario
        document.getElementById('cudCargadoBadge').classList.remove('d-none');
        
        // Disparamos un Toast de éxito si lo tienes configurado (opcional)
        if(typeof Toast !== 'undefined') {
            Toast.fire({ icon: 'info', title: 'Datos de CUD pre-guardados en el formulario.' });
        }
    });
});
</script>

@endsection