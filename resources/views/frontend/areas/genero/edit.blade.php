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
                <input type="text" name="barrio" class="form-control border-0 shadow-sm" value="{{ $legajo->barrio->nombre ?? '' }}">
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
@endsection