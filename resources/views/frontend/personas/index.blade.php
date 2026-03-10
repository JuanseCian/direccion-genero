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
            <th>Áreas</th>
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
                    <div class="d-flex gap-1 flex-wrap">
                        {{-- Etiqueta IVE (Verde) --}}
                        @if($p->casosIve->count() > 0)
                            <span class="badge rounded-pill shadow-sm" style="background-color: #28a745; color: white;">
                                IVE
                            </span>
                        @endif

                        {{-- Etiqueta Género (Lila/Morado) --}}
                        @if($p->casosGenero->count() > 0)
                            <span class="badge rounded-pill shadow-sm" style="background-color: #6f42c1; color: white;">
                                GÉNERO
                            </span>
                        @endif

                        {{-- Etiqueta Masculinidades (Celeste) --}}
                        {{-- @if($p->casosMasculinidades->count() > 0)
                            <span class="badge rounded-pill shadow-sm" style="background-color: #0dcaf0; color: white;">
                                <i class="bi bi-people me-1"></i> MASCULINIDADES
                            </span>
                        @endif --}}

                        {{-- Si no tiene ningún legajo --}}
                        @if($p->casosIve->count() == 0 && $p->casosGenero->count() == 0)
                            <span class="badge rounded-pill bg-light text-muted border">Sin Intervención</span>
                        @endif
                    </div>
                </td>
                <td>
                    <a href="{{ route('personas.edit', $p->id) }}"
                    class="btn btn-sm btn-secondary">
                        Ver / Editar
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>

</div>

@endsection