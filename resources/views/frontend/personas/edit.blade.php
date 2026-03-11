@extends('frontend.layouts.front')

@section('title','Editar Persona')

@section('content')

<div class="card card-soft p-4">

    <h3 class="mb-4">
        Editar Persona: {{ $persona->nombre }} {{ $persona->apellido }}
    </h3>

    @if ($errors->any())
    <div class="alert alert-danger">
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
    
    <h5 class="mb-3">Datos personales</h5>

        <div class="row">

            <div class="col-md-3">
                <label class="form-label">DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $persona->dni) }}" class="form-control @error('dni') is-invalid @enderror" >
                @error('dni')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
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
                <label class="form-label">Fecha nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $persona->fecha_nacimiento) }}" class="form-control" >
            </div>
            
            <div class="col-md-3">
                <label class="form-label">Sexo</label>
                <select name="sexo" class="form-control" >
                    <option value="">Seleccione</option>
                    <option value="Masculino" {{ $persona->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ $persona->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="agresor" value="1" id="agresor" {{ $persona->agresor ? 'checked' : '' }}>
                    <label class="form-check-label" for="agresor">
                        Es agresor
                    </label>
                </div>
            </div>

            <div class="col-md-3 {{ $persona->agresor ? '' : 'd-none' }}" id="campo_masculinidades">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="debe_asistir_masculinidades" value="1" id="masculinidades" {{ $persona->debe_asistir_masculinidades ? 'checked' : '' }}>
                    <label class="form-check-label" for="masculinidades">
                        Debe asistir a curso de masculinidades
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="victima" value="1" id="victima" {{ $persona->victima ? 'checked' : '' }}>
                    <label class="form-check-label" for="victima">
                        Es víctima
                    </label>
                </div>
            </div>
        </div>

        <h5 class="mt-4 mb-3">Contacto</h5>

        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $persona->telefono) }}" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Domicilio</label>
                <input type="text" name="domicilio" value="{{ old('domicilio', $persona->domicilio) }}" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Provincia</label>
                <select name="provincia_id" class="form-control">
                    <option value="">Seleccione Provincia</option>
                    @foreach($provincias as $prov)
                    <option value="{{ $prov->id }}" {{ $persona->provincia_id == $prov->id ? 'selected' : '' }}> {{ $prov->nombre }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Localidad</label>
                <select name="localidad_id" class="form-control">
                    <option value="">Seleccione localidad</option>
                    @foreach($localidades as $loc)
                    <option value="{{ $loc->id }}" {{ $persona->localidad_id == $loc->id ? 'selected' : '' }}> {{ $loc->nombre }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Barrio</label>
                <select name="barrio_id" class="form-control">
                    <option value="">Seleccione barrio</option>
                    @foreach($barrios as $barrio)
                    <option value="{{ $barrio->id }}" {{ $persona->barrio_id == $barrio->id ? 'selected' : '' }}> {{ $barrio->nombre }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <h5 class="mt-4 mb-3">Información adicional</h5>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Trabaja</label>
                <select name="trabaja" class="form-control" >
                    <option value="">Seleccione</option>
                    <option value="1" {{ $persona->trabaja == '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $persona->trabaja == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nivel Estudio</label>
                <select name="nivel_estudio_id" class="form-control" >
                    @foreach($nivelEstudio as $nivel)
                        <option value="{{ $nivel->id }}" {{ $persona->nivel_estudio_id == $nivel->id ? 'selected' : '' }}>{{ $nivel->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Grupo sanguíneo</label>
                <select name="grupo_sanguineo" class="form-control">
                    <option value="">Seleccione</option>
                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $gs)
                        <option value="{{ $gs }}" {{ $persona->grupo_sanguineo == $gs ? 'selected' : '' }}>{{ $gs }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-12 mt-4">
                <label class="form-label d-block mb-3 fw-bold text-muted text-uppercase small">Certificado de Discapacidad</label>

                {{-- Preguntamos si existe la RELACIÓN 'cud' --}}
                @if($persona->cud)
                    @php
                        $vencido = $persona->cud->fecha_vencimiento 
                                    && \Carbon\Carbon::parse($persona->cud->fecha_vencimiento)->isPast();
                    @endphp

                    <div id="contenedor_cud" class="alert shadow-sm p-3" style="background:#f0f7ff; border-left:5px solid #0d6efd;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            
                            <div>
                                <strong class="text-primary">
                                    <i class="bi bi-person-wheelchair me-2"></i>
                                    CUD Registrado
                                </strong>
                                
                                <div class="small mt-2 text-dark">
                                    <strong>N°:</strong> <span id="txt_num_cud">{{ $persona->cud->numero_cud }}</span> <br>
                                    
                                    <strong>Emisión:</strong> 
                                    <span id="txt_emision_cud">{{ $persona->cud->fecha_emision ? \Carbon\Carbon::parse($persona->cud->fecha_emision)->format('d/m/Y') : '—' }}</span> <br>
                                    
                                    <strong>Vencimiento:</strong> 
                                    <span id="txt_vencimiento_cud">{{ $persona->cud->fecha_vencimiento ? \Carbon\Carbon::parse($persona->cud->fecha_vencimiento)->format('d/m/Y') : '—' }}</span>
                                </div>
                            </div>

                            <div class="text-end">
                                <span class="badge {{ $vencido ? 'bg-danger' : 'bg-success' }} fs-6 mb-2 d-inline-block">
                                    {{ $vencido ? 'CUD Vencido' : 'CUD Vigente' }}
                                </span>
                                <br>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCud">
                                    <i class="bi bi-pencil-square me-1"></i> Modificar Certificado
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div id="contenedor_sin_cud" class="p-4 border border-dashed rounded text-center bg-light">
                        <p class="text-muted mb-3">No se han registrado datos de discapacidad para esta persona.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCud">
                            <i class="bi bi-plus-circle me-1"></i> Cargar Datos de CUD
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-5">
            <button class="btn btn-primary btn-lg"> Actualizar Persona </button>
            <a href="{{ route('personas.index') }}" class="btn btn-secondary btn-lg"> Volver </a>
        </div>

        <div class="modal fade" id="modalCud" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Certificado Único de Discapacidad</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Número de CUD</label>
                            {{-- Usamos la relación $persona->cud para traer los datos reales --}}
                            <input type="text" name="numero_cud" value="{{ old('numero_cud', $persona->cud->numero_cud ?? '') }}" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha emisión</label>
                                <input type="date" name="fecha_emision_cud" value="{{ old('fecha_emision_cud', $persona->cud->fecha_emision ?? '') }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha vencimiento</label>
                                <input type="date" name="fecha_vencimiento_cud" value="{{ old('fecha_vencimiento_cud', $persona->cud->fecha_vencimiento ?? '') }}" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones_cud" class="form-control">{{ old('observaciones_cud', $persona->cud->observaciones ?? '') }}</textarea>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-primary">Adjuntar Archivo (PDF, JPG, PNG, JFIF)</label>
                            <input type="file" name="archivo_cud" class="form-control" accept=".pdf, image/*, .jfif">
                            
                            @if($persona->cud && $persona->cud->archivo_adjunto)
                                <div class="mt-3 p-3 border rounded bg-light">
                                    <p class="mb-2 text-muted small">Documento actual cargado:</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('personas.ver_cud', $persona->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('personas.descargar_cud', $persona->id) }}" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-download"></i> Descargar
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Guardar Cambios CUD</button>
                    </div>
                    <span id="cudCargado" class="badge bg-success {{ $persona->numero_cud ? '' : 'd-none' }}">
                        CUD cargado
                    </span>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const chkAgresor = document.getElementById('agresor');
    const campoMasculinidades = document.getElementById('campo_masculinidades');

    chkAgresor.addEventListener('change', function(){
        campoMasculinidades.classList.toggle('d-none', !this.checked);
    });

    document.querySelector('#modalCud .btn-success').addEventListener('click', function(){
        const num = document.querySelector('input[name="numero_cud"]').value;
        const emision = document.querySelector('input[name="fecha_emision_cud"]').value;
        const vencimiento = document.querySelector('input[name="fecha_vencimiento_cud"]').value;

        if(document.getElementById('txt_num_cud')) {
            document.getElementById('txt_num_cud').innerText = num || '—';
            document.getElementById('txt_emision_cud').innerText = emision ? emision.split('-').reverse().join('/') : '—';
            document.getElementById('txt_vencimiento_cud').innerText = vencimiento ? vencimiento.split('-').reverse().join('/') : '—';
        }
        
        document.getElementById('cudCargado').classList.remove('d-none');
    });
});

document.querySelector('#modalCud .btn-success').addEventListener('click', function(){
    // Obtenemos los valores de los inputs del modal
    const num = document.querySelector('input[name="numero_cud"]').value;
    const emision = document.querySelector('input[name="fecha_emision_cud"]').value;
    const vencimiento = document.querySelector('input[name="fecha_vencimiento_cud"]').value;

    // Si la tarjeta ya existe, actualizamos sus textos
    if(document.getElementById('txt_num_cud')) {
        document.getElementById('txt_num_cud').innerText = num || '—';
        document.getElementById('txt_emision_cud').innerText = emision ? emision.split('-').reverse().join('/') : '—';
        document.getElementById('txt_vencimiento_cud').innerText = vencimiento ? vencimiento.split('-').reverse().join('/') : '—';
    }
    
    // Mostramos el badge de "CUD cargado" dentro del modal como feedback
    document.getElementById('cudCargado').classList.remove('d-none');
});
</script>

@endsection