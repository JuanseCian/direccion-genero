@extends('frontend.layouts.front')

@section('title','Nuevo Caso - Masculinidades')

@section('content')
<div class="card card-soft p-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="color: #5651A0;">
            <i class="bi bi-person-plus-fill"></i>
            Nuevo Caso de Masculinidades
        </h2>
        <a href="{{ route('masculinidades.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('masculinidades.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            {{-- DATOS FILTRADOS POR SEXO MASCULINO --}}
            <h3>Informacion Agresor</h3>
            <div class="col-md-6">
                <label class="form-label fw-bold">Agresor (Solo Masculinos)</label>
                <select name="persona_id" class="form-select @error('persona_id') is-invalid @enderror" required>
                    <option value="">Seleccione una persona...</option>
                    @foreach($agresores as $agresor)
                        <option value="{{ $agresor->id }}">{{ $agresor->apellido }}, {{ $agresor->nombre }} ({{ $agresor->dni }})</option>
                    @endforeach
                </select>
                @error('persona_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Encargado/a</label>
                <select name="encargado_id" class="form-select">
                    <option value="">Seleccione encargado...</option>
                    @foreach($encargados as $encargado)
                        <option value="{{ $encargado->id }}">{{ $encargado->nombre }}</option>
                    @endforeach
                </select>
            </div>  
            <div class="col-md-4">
                <label class="form-label fw-bold">Derivación</label>
                <select name="derivacion_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($derivaciones as $d)
                        <option value="{{ $d->id }}">{{ $d->nombre ?? 'Opción '.$d->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Situación Habitacional</label>
                <select name="situacion_habitacional_id" class="form-select">
                    <option value="">Seleccione...</option>
                    @foreach($situacionesHabitacionales as $sh)
                        <option value="{{ $sh->id }}">{{ $sh->nombre ?? 'Opción '.$sh->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label fw-bold">Violencia ejercida</label>

                <div class="row">
                    @foreach($tipoViolencia as $tipo)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="tipo_violencia_id[]" 
                                    value="{{ $tipo->id }}"
                                    id="violencia{{ $tipo->id }}"
                                >
                                <label class="form-check-label" for="violencia{{ $tipo->id }}">
                                    {{ $tipo->nombre }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Reincidencia</label>
                <input type="number" name="reincidencia" class="form-control" value="0">
            </div>
            
             <div class="col-md-4">
                <label class="form-label fw-bold">Asistencia al dispositivo</label>
                <input type="number" name="asistencia_dispositivo" class="form-control" value="0">
            </div>
            

            <div class="col-md-12">
                <label class="form-label fw-bold">Situación Judicial</label>
                <textarea name="situacion_judicial" class="form-control" rows="2" placeholder="Describa el estado de la causa..."></textarea>
            </div>
           
            {{-- CHECKBOXES DE COMPORTAMIENTO --}}
            <div class="col-md-12 mt-3">
                <div class="card bg-light p-3 border-0">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="trabaja" value="1">
                                <label class="form-check-label">¿Trabaja?</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="consumo" value="1">
                                <label class="form-check-label">¿Consumo?</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="desobediencia" value="1">
                                <label class="form-check-label">¿Desobediencia?</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="terapia" value="1">
                                <label class="form-check-label">¿Terapia?</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <h3>Informacion Victima</h3>
            <div class="col-md-6">
                <label class="form-label fw-bold">Victima</label>
                <select name="victima_id" class="form-select @error('victima_id') is-invalid @enderror" required>
                    <option value="">Seleccione una persona...</option>
                    @foreach($victimas as $victima)
                        <option value="{{ $victima->id }}">{{ $victima->apellido }}, {{ $victima->nombre }} ({{ $victima->dni }})</option>
                    @endforeach
                </select>
                @error('persona_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Situación Sanitaria/label>
                <select name="situacion_sanitaria_id" class="form-select">
                    <option value="">Seleccione...</option>
                    @foreach($situacionSanitaria as $situacionSanitaria)
                        <option value="{{ $situacionSanitaria->id }}">{{ $situacionSanitaria->nombre}}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="col-md-4">
                <label class="form-label fw-bold">Hijos en común</label>
                <input type="number" name="hijos_en_comun" class="form-control" value="0">
            </div>

             <div class="col-md-12">
                <label class="form-label fw-bold">Medidas Cautelares</label>

                <div class="row">
                    @foreach($medidasCautelares as $medida)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="medida_id[]" 
                                    value="{{ $medida->id }}"
                                    id="medida{{ $medida->id }}"
                                >
                                <label class="form-check-label" for="medida{{ $medida->id }}">
                                    {{ $medida->nombre }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            

            <hr class="my-4">
            {{-- CAMPOS ESPECÍFICOS DEL SQL --}}
            

            <div class="col-md-12">
                <label class="form-label fw-bold">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn text-white px-5 shadow-sm" style="background: #5651A0;">
                <i class="bi bi-save"></i> Guardar Caso
            </button>
        </div>
    </form>
</div>
@endsection