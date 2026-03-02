@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

<div class="card-header text-white"
     style="background:#5651A0; border-radius:8px 8px 0 0;">

<h5 class="mb-0">

<i class="bi bi-pencil-square"></i>
Editar Programa de Asistencia

</h5>

</div>


<div class="card-body bg-light">

<form method="POST"
action="{{ route('backend.programas-asistencia.update',$programa->id) }}">

@csrf
@method('PUT')

<div class="mb-3">

<label class="form-label">
Nombre
</label>

<input type="text"
name="nombre"
class="form-control"
value="{{ $programa->nombre }}"
required>

</div>


<button class="btn btn-primary">

<i class="bi bi-save"></i>
Actualizar

</button>


<a href="{{ route('backend.programas-asistencia.index') }}"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>
Volver

</a>

</form>

</div>

</div>

@endsection