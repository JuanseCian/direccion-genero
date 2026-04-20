@extends('frontend.layouts.front')

@section('title','Nueva Intervención')

@section('content')

<div class="container py-4">

<div class="d-flex justify-content-between mb-4">

<div>
<h3 class="fw-bold" style="color:#5651A0">
<i class="bi bi-journal-plus"></i>
Nueva Intervención
</h3>

<p class="text-muted">
{{ $caso->persona->apellido }}, {{ $caso->persona->nombre }}
</p>

</div>

<a href="{{ route('masculinidades.edit',$caso->id) }}"
class="btn btn-outline-secondary">

<i class="bi bi-arrow-left"></i>
Volver al caso

</a>

</div>


<form action="{{ route('masculinidades.intervenciones.store',$caso->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="row g-3">

<div class="col-md-3">

<label class="form-label fw-bold">Fecha</label>

<input type="date"
name="fecha_intervencion"
class="form-control"
value="{{ date('Y-m-d') }}"
required>

</div>

<div class="col-md-4">

<label class="form-label fw-bold">Tipo</label>

<select name="tipo_intervencion_id"
class="form-select"
required>

<option value="">Seleccione...</option>

@foreach($tiposIntervencion as $tipo)

<option value="{{ $tipo->id }}">
{{ $tipo->nombre }}
</option>

@endforeach

</select>

</div>

<div class="col-md-5">

<label class="form-label fw-bold">Profesional</label>

<select name="encargado_id"
class="form-select"
required>

<option value="">Seleccione...</option>

@foreach($encargados as $encargado)

<option value="{{ $encargado->id }}">
{{ $encargado->apellido }},
{{ $encargado->nombre }}
</option>

@endforeach

</select>

</div>

<div class="col-12">

<label class="form-label fw-bold">Detalle</label>

<textarea name="detalle"
class="form-control"
rows="4"
required></textarea>

</div>

<div class="col-12">

<label class="form-label fw-bold">
Adjuntar archivo
</label>

<input type="file"
       name="archivos[]"
       class="form-control"
       multiple
       accept=".pdf,.jpg,.jpeg,.png">

</div>

</div>

</div>

<div class="card-footer text-end">

<button class="btn btn-success px-4">

<i class="bi bi-save"></i>
Guardar

</button>

</div>

</div>

</form>

</div>

@endsection