@extends('frontend.layouts.front')

@section('title','Editar Caso - Masculinidades')

@section('content')

<div class="container-fluid py-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0" style="color:#5651A0;">
            <i class="bi bi-pencil-square"></i> Editar Caso
        </h2>
        <p class="text-muted">
            {{ $caso->persona->apellido }}, {{ $caso->persona->nombre }}
        </p>
    </div>

    <div>
        <button type="button"
                class="btn btn-info btn-sm text-white shadow-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalIntervenciones">

            <i class="bi bi-chat-right-text"></i> Intervenciones
        </button>

        <a href="{{ route('masculinidades.index') }}"
           class="btn btn-outline-secondary shadow-sm">

           <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<form action="{{ route('masculinidades.update', $caso->id) }}" method="POST">
@csrf
@method('PUT')


{{-- IDENTIFICACIÓN --}}
<div class="card shadow-sm border-0 mb-4">

<div class="card-header bg-white py-3">
<h5 class="mb-0 text-primary">
<i class="bi bi-person-badge me-2"></i>
1. Identificación del Agresor y Responsables
</h5>
</div>

<div class="card-body">

<div class="row g-3">

<div class="col-md-6">
<label class="form-label fw-bold text-secondary">Agresor</label>

<select name="persona_id" class="form-select" disabled>
@foreach($agresores as $agresor)
<option value="{{ $agresor->id }}"
{{ $caso->persona_id == $agresor->id ? 'selected' : '' }}>
{{ $agresor->apellido }}, {{ $agresor->nombre }} ({{ $agresor->dni }})
</option>
@endforeach
</select>
</div>

<div class="col-md-6">
<label class="form-label fw-bold text-secondary">Encargado/a</label>

<select name="encargado_id" class="form-select border-primary-subtle">
<option value="">Seleccione...</option>

@foreach($encargados as $encargado)
<option value="{{ $encargado->id }}"
{{ $caso->encargado_id == $encargado->id ? 'selected' : '' }}>
{{ $encargado->nombre }}
</option>
@endforeach

</select>
</div>

</div>
</div>
</div>



{{-- CONTEXTO --}}
<div class="card shadow-sm border-0 mb-4">

<div class="card-header bg-white py-3">
<h5 class="mb-0 text-primary">
<i class="bi bi-journal-text me-2"></i>
2. Contexto del Caso
</h5>
</div>

<div class="card-body bg-light-subtle">

<div class="row g-3">

<div class="col-md-4">
<label class="form-label fw-bold">Derivación</label>

<select name="derivacion_id" class="form-select">
@foreach($derivaciones as $d)
<option value="{{ $d->id }}"
{{ $caso->derivacion_id == $d->id ? 'selected' : '' }}>
{{ $d->nombre }}
</option>
@endforeach
</select>
</div>


<div class="col-md-4">
<label class="form-label fw-bold">Situación Habitacional</label>

<select name="situacion_habitacional_id" class="form-select">

<option value="">Seleccione...</option>

@foreach($situacionesHabitacionales as $sh)
<option value="{{ $sh->id }}"
{{ $caso->situacion_habitacional_id == $sh->id ? 'selected' : '' }}>
{{ $sh->nombre }}
</option>
@endforeach

</select>
</div>


<div class="col-md-4">
<label class="form-label fw-bold">Espacio Grupal</label>

<select name="espacio_grupal_id" class="form-select">

<option value="">Seleccione...</option>

@foreach($espaciosGrupales as $espacio)
<option value="{{ $espacio->id }}"
{{ $caso->espacio_grupal_id == $espacio->id ? 'selected' : '' }}>
{{ $espacio->nombre }}
</option>
@endforeach

</select>
</div>



{{-- VIOLENCIA --}}
<div class="col-md-12 my-3">

<div class="p-3 border rounded bg-white">

<label class="form-label fw-bold text-danger">
<i class="bi bi-exclamation-triangle"></i>
Tipos de Violencia Ejercida
</label>

<div class="row">

@foreach($tipoViolencia as $tipo)

<div class="col-md-3">

<div class="form-check">

<input class="form-check-input"
type="checkbox"
name="tipo_violencia_id[]"
value="{{ $tipo->id }}"
{{ $caso->tiposViolencia->contains($tipo->id) ? 'checked' : '' }}>

<label class="form-check-label">
{{ $tipo->nombre }}
</label>

</div>
</div>

@endforeach

</div>
</div>
</div>


<div class="col-md-4">
<label class="form-label fw-bold">Reincidencia</label>

<input type="number"
name="reincidencia"
class="form-control"
value="{{ $caso->reincidencia }}">
</div>



<div class="col-md-4">

<label class="form-label fw-bold">¿Debe realizar el dispositivo?</label>

<select name="debe_dispositivo"
id="debeDispositivo"
class="form-select">

<option value="">Seleccione...</option>

<option value="1"
{{ $caso->debe_dispositivo == 1 ? 'selected' : '' }}>
Sí
</option>

<option value="0"
{{ $caso->debe_dispositivo == 0 ? 'selected' : '' }}>
No
</option>

</select>

</div>


<div id="camposDispositivo" class="row">

<div class="col-md-4">

<label class="form-label fw-bold">
Asistencia al dispositivo
</label>

<select name="asistencia_dispositivo" class="form-select">

<option value="">Seleccione...</option>

<option value="1"
{{ $caso->asistencia_dispositivo == 1 ? 'selected' : '' }}>
Asistencia regular
</option>

<option value="2"
{{ $caso->asistencia_dispositivo == 2 ? 'selected' : '' }}>
Asistencia irregular
</option>

<option value="3"
{{ $caso->asistencia_dispositivo == 3 ? 'selected' : '' }}>
Abandonó
</option>

<option value="4"
{{ $caso->asistencia_dispositivo == 4 ? 'selected' : '' }}>
Finalizado
</option>

</select>

</div>


<div class="col-md-4">

<label class="form-label fw-bold">
Fecha de Finalización
</label>

<input type="date"
name="fecha_finalizacion"
class="form-control"
value="{{ $caso->fecha_finalizacion ?? '' }}">

</div>

</div>

</div>
</div>
</div>



{{-- VICTIMAS --}}
<div class="card shadow-sm border-0 mb-4 border-start border-4 border-danger">

<div class="card-header bg-white py-3">

<h5 class="mb-0 text-danger">
<i class="bi bi-shield-exclamation me-2"></i>
3. Información de la Víctima
</h5>

</div>

<div class="card-body">

<div class="row g-3">

<div class="col-md-12 mt-2">

<div class="p-3 rounded mb-3"
style="background:#e6f2ff;color:#004085;display:flex;justify-content:space-between;align-items:center;">

<h6 class="fw-bold mb-0">
<i class="bi bi-person-heart me-2"></i>
Víctimas Vinculadas
</h6>

<button type="button"
class="btn btn-sm btn-primary shadow-sm"
data-bs-toggle="modal"
data-bs-target="#modalVictimas">

<i class="bi bi-plus-circle me-1"></i>
Vincular Víctima

</button>

</div>


<div id="lista-victimas" class="row g-3">

@foreach($caso->victimas as $victima)

<div class="col-md-4"
id="victima-item-{{ $victima->id }}">

<div class="card border-0 shadow-sm p-2 d-flex flex-row align-items-center justify-content-between"
style="background:#f0f8ff;">

<div class="small">

<a href="{{ route('genero.edit',$victima->id) }}"
class="text-decoration-none"
target="_blank">

<span class="fw-bold text-primary">
#{{ $victima->id }}
</span>

{{ $victima->persona->apellido }},
{{ $victima->persona->nombre }}

<i class="bi bi-box-arrow-up-right ms-1"></i>

</a>

<input type="hidden"
name="victimas[]"
value="{{ $victima->id }}">

</div>

<button type="button"
class="btn btn-link text-danger p-0"
onclick="quitarVictima({{ $victima->id }})">

<i class="bi bi-x-circle-fill"></i>

</button>

</div>
</div>

@endforeach

</div>

</div>
</div>
</div>
</div>



{{-- FINAL --}}
<div class="card shadow-sm border-0 mb-5">

<div class="card-body">

<div class="row g-3">

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">
Situación Judicial
</label>

<textarea name="situacion_judicial"
class="form-control"
rows="3">{{ $caso->situacion_judicial }}</textarea>

</div>


<div class="col-md-6">

<label class="form-label fw-bold text-secondary">
Observaciones
</label>

<textarea name="observaciones"
class="form-control"
rows="3">{{ $caso->observaciones }}</textarea>

</div>

</div>
</div>


<div class="card-footer bg-light text-end py-3">

<button type="submit"
class="btn btn-lg text-white px-5 shadow-sm"
style="background:#5651A0">

<i class="bi bi-save-fill me-2"></i>
ACTUALIZAR CASO

</button>

</div>
</div>

</form>
</div>



<style>

.card{
border-radius:12px;
transition:0.3s;
}

.form-label{
font-size:0.9rem;
}

.form-control:focus,
.form-select:focus{
border-color:#5651A0;
box-shadow:0 0 0 0.2rem rgba(86,81,160,0.25);
}

.bg-light-subtle{
background:#f8f9fa;
}

.border-primary-subtle{
border-color:#5651a055 !important;
}

</style>


<script>

function toggleDispositivo(){

let valor=document.getElementById('debeDispositivo').value
let bloque=document.getElementById('camposDispositivo')

if(valor==1){
bloque.style.display='flex'
}else{
bloque.style.display='none'
}

}

document.getElementById('debeDispositivo').addEventListener('change',toggleDispositivo)

window.addEventListener('load',toggleDispositivo)

</script>

@endsection