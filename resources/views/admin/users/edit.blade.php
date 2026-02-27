@extends('backend.layouts.app')

@section('content')

<div class="container">

<h2>Editar Usuario</h2>


@if(session('success'))
<div class="alert alert-success">{{ session('success') }}
</div>
@endif


<form method="POST"action="{{ route('admin.users.update',$user->id) }}">

@csrf
@method('PUT')


<h4>Datos usuario</h4>

<div class="mb-2">

<label>Usuario</label>

<input type="text"class="form-control"value="{{ $user->username }}"disabled>

</div>


<div class="mb-2">

<label>Nombre</label>

<input type="text"class="form-control"value="{{ $user->nombre }} {{ $user->apellido }}"disabled>

</div>



<hr>


<h4>Estado</h4>

<select name="rol_id"class="form-control">

<option value="2" {{ $user->rol_id==2?'selected':'' }} >

Activo

</option>


<option value="3" {{ $user->rol_id==3?'selected':'' }} >
    Inactivo
</option>

</select>


<hr>


<h4>Permisos áreas</h4>


@foreach($areas as $area)

<div class="form-check">

<input type="checkbox" name="areas[]" value="{{ $area->id }}" class="form-check-input"


{{ $user->areas->contains($area->id) ? 'checked' : '' }} >


<label class="form-check-label">
    {{ $area->nombre }}
</label>
</div>


@endforeach


<br>


<button class="btn btn-success">

Guardar cambios

</button>


<a href="{{ route('admin.users.index') }}" class="btn btn-secondary">

Volver

</a>


</form>

</div>

@endsection