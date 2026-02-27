@extends('frontend.layouts.front')

@section('title', 'Nuevo Legajo de Género')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h3 class="mb-0" style="color: #5651A0; font-weight: 700;">
                <i class="bi bi-file-earmark-plus-fill me-2"></i>Nuevo Legajo: Área Género
            </h3>
            <a href="{{ route('genero.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('genero.store') }}" method="POST">
                @csrf

                {{-- SECCIÓN: IDENTIFICACIÓN --}}
                <div class="mb-5">
                    <h5 class="section-title">
                        <i class="bi bi-person-badge me-2"></i>Identificación
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="persona_id" class="form-label fw-bold text-secondary">Persona (Solo Sexo Femenino)</label>
                            <select name="persona_id" id="persona_id" class="form-select shadow-sm @error('persona_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Seleccione una persona...</option>
                                @foreach($personas as $persona)
                                    <option value="{{ $persona->id }}">
                                        {{ $persona->apellido }}, {{ $persona->nombre }} (DNI {{ $persona->dni }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="form-label fw-bold text-secondary">Género autopercibido</label>
                            <input type="text" name="genero" id="genero" class="form-control shadow-sm" placeholder="Ej: Mujer Trans, No binario, etc.">
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN: UBICACIÓN --}}
                <div class="mb-5 p-3 rounded-3" style="background-color: #f8f9fa;">
                    <h5 class="section-title">
                        <i class="bi bi-geo-alt me-2"></i>Ubicación
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="provincia_id" class="form-label fw-bold text-secondary">Provincia</label>
                            <select name="provincia_id" id="provincia_id" class="form-select shadow-sm">
                                <option value="">Seleccione...</option>
                                @foreach($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="localidad_id" class="form-label fw-bold text-secondary">Localidad</label>
                            <select name="localidad_id" id="localidad_id" class="form-select shadow-sm">
                                <option value="">Seleccione...</option>
                                @foreach($localidades as $localidad)
                                    <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="barrio_id" class="form-label fw-bold text-secondary">Barrio</label>
                            <select name="barrio_id" id="barrio_id" class="form-select shadow-sm">
                                <option value="">Seleccione...</option>
                                @foreach($barrios as $barrio)
                                    <option value="{{ $barrio->id }}">{{ $barrio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN: SITUACIÓN --}}
                <div class="mb-5">
                    <h5 class="section-title">
                        <i class="bi bi-info-circle me-2"></i>Situación Socio-Educativa
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="estado_civil_id" class="form-label fw-bold text-secondary">Estado Civil</label>
                            <select name="estado_civil_id" id="estado_civil_id" class="form-select shadow-sm">
                                <option value="">Seleccione...</option>
                                @foreach($estados_civiles as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="nivel_estudio_id" class="form-label fw-bold text-secondary">Nivel de Estudio</label>
                            <select name="nivel_estudio_id" id="nivel_estudio_id" class="form-select shadow-sm">
                                <option value="">Seleccione...</option>
                                @foreach($niveles_estudio as $nivel)
                                    <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="trabaja" class="form-label fw-bold text-secondary">¿Trabaja actualmente?</label>
                            <select name="trabaja" id="trabaja" class="form-select shadow-sm">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN: ORGANIZACIÓN --}}
                <div class="mb-5">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="organizacion_social" class="form-label fw-bold text-secondary">¿Participa en organización social?</label>
                            <select name="organizacion_social" id="organizacion_social" class="form-select shadow-sm">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="organizacion_social_detalle" class="form-label fw-bold text-secondary">Detalle de la organización</label>
                            <input type="text" name="organizacion_social_detalle" id="organizacion_social_detalle" class="form-control shadow-sm" placeholder="Nombre de la institución o agrupación">
                        </div>
                    </div>
                </div>

                {{-- OBSERVACIONES --}}
                <div class="mb-4">
                    <label for="observaciones" class="form-label fw-bold text-secondary">Observaciones adicionales</label>
                    <textarea name="observaciones" id="observaciones" class="form-control shadow-sm" rows="3" placeholder="Notas importantes sobre el legajo..."></textarea>
                </div>

                <div class="text-end border-top pt-4">
                    <button type="reset" class="btn btn-light px-4 me-2">Limpiar</button>
                    <button type="submit" class="btn text-white px-5 shadow-sm" style="background-color: #5651A0;">
                        <i class="bi bi-check-circle me-2"></i>Guardar Legajo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Estilos extra para pulir el diseño */
    .section-title {
        color: #5651A0;
        font-weight: 600;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #5651a021;
        display: inline-block;
        padding-bottom: 5px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #5651A0;
        box-shadow: 0 0 0 0.25rem rgba(86, 81, 160, 0.25);
    }
    .card {
        border-radius: 15px;
    }
</style>
@endsection