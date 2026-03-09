@extends('frontend.layouts.front')

@section('title','Nueva Persona')

@section('content')

<div class="card card-soft p-4">

    <h3 class="mb-4">
        Nueva Persona
    </h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('personas.store') }}">
    @csrf
    <h5 class="mb-3">Datos personales</h5>

        <div class="row">

            <div class="col-md-3">

                <label class="form-label">DNI</label>
                <input type="text" name="dni" class="form-control @error('dni') is-invalid @enderror" >
                @error('dni')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>


            <div class="col-md-3">

                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" >

            </div>


            <div class="col-md-3">

                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" >

            </div>


            <div class="col-md-3">

                <label class="form-label">Fecha nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" >

            </div>
            
            <div class="col-md-3">

                <label class="form-label">Sexo</label>
                <select name="sexo" class="form-control" >
                    <option value="">Seleccione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>

        </div>
           <div class="col-md-3">

            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" name="agresor" value="1" id="agresor">
                <label class="form-check-label" for="agresor">
                    Es agresor
                </label>
            </div>

        </div>

        <div class="col-md-3 d-none" id="campo_masculinidades">

        <div class="form-check mt-4">

                <input 
                    class="form-check-input"
                    type="checkbox"
                    name="debe_asistir_masculinidades"
                    value="1"
                    id="masculinidades">

                <label class="form-check-label" for="masculinidades">
                    Debe asistir a curso de masculinidades
                </label>

            </div>

        </div>

        <div class="col-md-3">

            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" name="victima" value="1" id="victima">
                <label class="form-check-label" for="victima">
                    Es víctima
                </label>
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
                <label class="form-label">Provincia</label>
                <select name="provincia_id" class="form-control">

                    <option value="">Seleccione Provincia</option>

                    @foreach($provincia as $provincia)
                    <option value="{{ $provincia->id }}"> {{ $provincia->nombre }} </option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Localidad</label>
                <select name="localidad_id" class="form-control">

                    <option value="">Seleccione barrio</option>

                    @foreach($localidad as $localidad)
                    <option value="{{ $localidad->id }}"> {{ $localidad->nombre }} </option>
                    @endforeach
                    
                </select>
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
                <select name="trabaja" class="form-control" >
                    <option value="">Seleccione</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>

            </div>

            <div class="col-md-6">

                <label class="form-label">Nivel Estudio</label>
                <select name="nivel_estudio_id" class="form-control" >
                    @foreach($nivelEstudio as $nivel)
                        <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                    @endforeach
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

<script>

document.addEventListener('DOMContentLoaded', function(){

    const chkAgresor = document.getElementById('agresor');
    const campoMasculinidades = document.getElementById('campo_masculinidades');

    chkAgresor.addEventListener('change', function(){

        if(this.checked){
            campoMasculinidades.classList.remove('d-none');
        }else{
            campoMasculinidades.classList.add('d-none');
        }

    });

});

</script>

@endsection