@extends('frontend.layouts.front')

@section('title','Nueva Persona')

@section('content')

<div class="card card-soft p-4">

    <h3 class="mb-4">
        Nueva Persona
    </h3>


    <form method="POST" action="{{ route('personas.store') }}">
    @csrf
    <h5 class="mb-3">Datos personales</h5>

        <div class="row">

            <div class="col-md-3">

                <label class="form-label">DNI</label>
                <input type="text" name="dni" class="form-control" required>

            </div>


            <div class="col-md-3">

                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" required>

            </div>


            <div class="col-md-3">

                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>

            </div>


            <div class="col-md-3">

                <label class="form-label">Fecha nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" required>

            </div>
            
            <div class="col-md-3">

                <label class="form-label">Sexo</label>
                <select name="sexo" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>

        </div>

        <h5 class="mt-4 mb-3">Contacto</h5>

        <div class="row">

            <div class="col-md-4">

                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control">

            </div>


            <div class="col-md-4">

                <label class="form-label">Domicilio</label>
                <input type="text" name="domicilio" class="form-control">

            </div>


            <div class="col-md-4">
                <label class="form-label">Barrio</label>
                <select name="barrio_id" class="form-control">

                    <option value="">Seleccione barrio</option>

                    @foreach($barrios as $barrio)
                    <option value="{{ $barrio->id }}"> {{ $barrio->nombre }} </option>
                    @endforeach
                    
                </select>
            </div>

        </div>


        <h5 class="mt-4 mb-3">Información adicional</h5>

        <div class="row">

            <div class="col-md-6">

                <label class="form-label">Trabaja</label>
                <select name="trabaja" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>

            </div>



            <div class="col-md-6">

                <label class="form-label">Grupo sanguíneo</label>
                <select name="grupo_sanguineo"
                class="form-control">

                <option value="">Seleccione</option>

                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>O+</option>
                <option>O-</option>

                </select>

            </div>

        </div>

        <div class="mt-5">

            <button class="btn btn-success btn-lg"> Guardar Persona </button>

            <a href="{{ route('personas.index') }}" class="btn btn-secondary btn-lg"> Volver </a>

        </div>


    </form>

</div>

@endsection