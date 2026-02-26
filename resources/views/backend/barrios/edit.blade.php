@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

<div class="card-header text-white"
style="background:#5651A0">

    <h5 class="mb-0">
        Editar Barrio
    </h5>

</div>


<div class="card-body">

<form method="POST"
action="{{ route('barrios.update',$barrio->id) }}">

@csrf
@method('PUT')


<div class="mb-3">

<label>Nombre</label>

<input type="text"
name="nombre"
value="{{ $barrio->nombre }}"
class="form-control">

</div>


<div class="mb-3">

<label>Localidad</label>

<select name="localidad_id"
class="form-control">

@foreach($localidades as $loc)

<option value="{{ $loc->id }}"
@if($loc->id == $barrio->localidad_id)
selected
@endif>

{{ $loc->nombre }}

</option>

@endforeach

</select>

</div>


<div class="mb-3">

<label>Zona</label>

<select name="zona_barrio_id"
class="form-control">

@foreach($zonas as $zona)

<option value="{{ $zona->id }}"
@if($zona->id == $barrio->zona_barrio_id)
selected
@endif>

{{ $zona->nombre }}

</option>

@endforeach

</select>

</div>


<button class="btn btn-primary">
Actualizar
</button>

<a href="{{ route('barrios.index') }}"
class="btn btn-secondary">

Volver

</a>


</form>

</div>

</div>

@endsection