@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm p-4">

<div class="d-flex justify-content-between mb-3">

<h4>Zonas de Barrio</h4>

<a href="{{ route('zonas.create') }}"
class="btn btn-primary">

Nueva Zona

</a>

</div>

<table class="table table-hover">

<tr>

<th>ID</th>
<th>Nombre</th>
<th width="200">Acciones</th>

</tr>

@foreach($zonas as $zona)

<tr>

<td>{{ $zona->id }}</td>

<td>{{ $zona->nombre }}</td>

<td>

<a href="{{ route('zonas.edit',$zona->id) }}"
class="btn btn-warning btn-sm">

Editar

</a>

<form method="POST"
action="{{ route('zonas.destroy',$zona->id) }}"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">

Eliminar

</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection