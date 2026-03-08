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
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>

            <h5 class="mb-3">Áreas</h5>

            <div class="d-flex flex-wrap gap-2">
                @foreach($areas as $area)
                    {{-- 1. Filtro para quitar la opción "admin" --}}
                    @if(strtolower($area->nombre) !== 'admin')
                        <input type="checkbox" 
                               class="btn-check" 
                               name="areas[]" 
                               value="{{ $area->id }}" 
                               id="area-{{ $area->id }}" 
                               autocomplete="off">
                        
                        <label class="btn btn-outline-custom d-flex align-items-center justify-content-center" 
                               for="area-{{ $area->id }}" 
                               style="width: 180px; height: 60px; border: 1px solid #ddd; font-weight: 500;">
                            {{ $area->nombre }}
                        </label>
                    @endif
                @endforeach
            </div>

            <br>
            <button class="btn btn-success px-4"> Guardar </button>
        </form>
    </div>
</div>

{{-- Estilo para que al seleccionar se pinte del color del header (gris suave de card-header) --}}
<style>
    .btn-outline-custom {
        color: #333;
        background-color: transparent;
        transition: all 0.2s;
    }

    .btn-check:checked + .btn-outline-custom {
        background-color: #7b1fa2 !important; /* Violeta principal */
        border-color: #6a1b9a !important;     /* Borde violeta más oscuro */
        color: #ffffff !important;           /* Texto blanco para contraste */
        box-shadow: 0 4px 6px rgba(123, 31, 162, 0.3); /* Sombra suave violeta */
    }

    .btn-check:checked + .btn-outline-custom:hover {
        background-color: #6a1b9a !important; 
    }
</style>

@endsection