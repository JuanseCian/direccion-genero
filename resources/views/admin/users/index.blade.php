@extends('backend.layouts.app')
@section('content')

<div class="container">

<h2>Usuarios</h2>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Usuario</th>
<th>Nombre</th>
<th>Rol</th>
<th>Acciones</th>

</tr>

</thead>


<tbody>

@foreach($users as $user)

<tr>

<td>{{ $user->id }}</td>

<td>{{ $user->username }}</td>

<td>{{ $user->nombre }} {{ $user->apellido }}</td>


<td>

@if($user->rol_id==3)

<span class="badge bg-danger">
Inactivo
</span>

@else

<span class="badge bg-success">
Activo
</span>

@endif

</td>


<td>

<a href="{{ route('admin.users.edit',$user->id) }}"
class="btn btn-primary btn-sm">

Editar

</a>

</td>


</tr>

@endforeach

</tbody>

</table>

</div>

@endsection