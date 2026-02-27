@extends('backend.layouts.app')

@section('title','Administrador')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        Usuarios pendientes de aprobación
    </div>
    <div class="card-body">
        No hay usuarios pendientes de aprobación.
        <br><br>
        <button class="btn btn-primary">Ver Todos los Usuarios</button>
    </div>
</div>

@endsection