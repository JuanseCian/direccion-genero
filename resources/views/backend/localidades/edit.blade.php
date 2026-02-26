@extends('backend.layouts.app')

@section('content')

<div class="card p-4">

    <h4>Editar Localidad</h4>

    <form method="POST" action="{{ route('localidades.update',$localidad->id) }}">

        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $localidad->nombre }}" class="form-control">

        <div class="mt-3">

            <button class="btn btn-success"> Actualizar </button>

            <a href="{{ route('localidades.index') }}" class="btn btn-secondary"> Volver </a>

        </div>
    </form>

</div>

@endsection