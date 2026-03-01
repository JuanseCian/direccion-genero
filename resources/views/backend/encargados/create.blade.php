@extends('backend.layouts.app')

@section('content')

<div class="card">

    <div class="card-header"> 
        Nuevo Encargado 
    </div>


    <div class="card-body">

        <form method="POST" action="{{ route('backend.encargados.store') }}">

        @csrf

            <div class="mb-3">

                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control">

            </div>


            <div class="mb-3">

                <label>Apellido</label>
                <input type="text" name="apellido" class="form-control">

            </div>


            <h5>Areas</h5>

            @foreach($areas as $area)

            <div>
                <input type="checkbox" name="areas[]" value="{{ $area->id }}"> {{ $area->nombre }}
            </div>

            @endforeach
            <br>

            <button class="btn btn-success"> Guardar </button>


        </form>

    </div>

</div>

@endsection