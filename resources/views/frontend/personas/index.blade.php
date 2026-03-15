@extends('frontend.layouts.front')

@section('title','Personas')

@section('content')

<div class="card card-soft p-4 mb-4">
    {{-- Se agregó flex-wrap, align-items-center y un gap para que se vea bien en móviles --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h3 class="mb-0">Personas</h3>
        <a href="{{ route('personas.create') }}" class="btn btn-primary">
            Nueva Persona
        </a>
    </div>
</div>

<div class="card card-soft p-4">
    {{-- Este div es el que hace la magia de la tabla responsive en Bootstrap --}}
    <div class="table-responsive">
        {{-- Agregué table-hover y align-middle para mejorar la visualización --}}
        <table class="table table-hover align-middle text-nowrap">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Barrio</th>
                    <th>Áreas</th>
                    <th>Acciones</th> {{-- Faltaba el encabezado de esta columna --}}
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
                        <a href="{{ route('personas.edit', $p->id) }}" class="btn btn-sm btn-secondary">
                            Ver / Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection