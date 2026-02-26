@extends('backend.layouts.app')

@section('content')

<div class="card p-4">

<h4>Nueva Localidad</h4>

<form method="POST"
action="{{ route('localidades.store') }}">

@csrf

<label>Nombre</label>

<input type="text"
name="nombre"
class="form-control"
required>

<div class="mt-3">

<button class="btn btn-success">

Guardar

</button>

<a href="{{ route('localidades.index') }}"
class="btn btn-secondary">

Volver

</a>

</div>

</form>

</div>

@endsection