@extends('frontend.layouts.front')

@section('title','Personas')

@section('content')

<div class="card card-soft p-4 mb-4">

    <div class="d-flex justify-content-between">

        <h3>Personas</h3>

        <a href="{{ route('personas.create') }}"
           class="btn btn-primary">

            Nueva Persona

        </a>

    </div>

</div>


<div class="card card-soft p-4">

    <table class="table">

        <thead>

            <tr>
            <th>DNI</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Barrio</th>
            </tr>

        </thead>

        <tbody>

        @foreach($personas as $p)
        <tr>

            <td>{{ $p->dni }}</td>

            <td>{{ $p->apellido }}</td>

            <td>{{ $p->nombre }}</td>

            <td>{{ $p->telefono }}</td>
            
            <td>{{ $p->barrio->nombre ?? '-' }}</td>

            <td>
                <a href="#"
                class="btn btn-sm btn-secondary">
                    Ver
                </a>
            </td>
        </tr>
        @endforeach

        </tbody>

    </table>

</div>

@endsection