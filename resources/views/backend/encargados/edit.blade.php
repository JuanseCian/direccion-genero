@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header"> 
        Editar Encargado: {{ $encargado->nombre }} {{ $encargado->apellido }}
    </div>

    <div class="card-body">
        {{-- Cambiamos a la ruta update y pasamos el ID --}}
        <form method="POST" action="{{ route('backend.encargados.update', $encargado->id) }}">
            @csrf
            @method('PUT') {{-- Indispensable para actualizar en Laravel --}}

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $encargado->nombre }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $encargado->apellido }}" required>
            </div>

            <h5 class="mb-3">Áreas Asignadas</h5>

            <div class="d-flex flex-wrap gap-2">
                @foreach($areas as $area)
                    {{-- 1. Mantenemos el filtro para ocultar "admin" --}}
                    @if(strtolower($area->nombre) !== 'admin')
                        <input type="checkbox" 
                               class="btn-check" 
                               name="areas[]" 
                               value="{{ $area->id }}" 
                               id="area-{{ $area->id }}" 
                               autocomplete="off"
                               {{-- 2. Lógica para marcar si el encargado ya tiene esta área --}}
                               @if($encargado->areas->contains($area->id)) checked @endif>
                        
                        <label class="btn btn-outline-custom d-flex align-items-center justify-content-center text-center" 
                               for="area-{{ $area->id }}" 
                               style="width: 180px; height: 60px; font-weight: 500; padding: 5px;">
                            {{ $area->nombre }}
                        </label>
                    @endif
                @endforeach
            </div>

            <br>
            <div class="mt-3">
                <button class="btn btn-primary px-4"> Actualizar Cambios </button>
                <a href="{{ route('backend.encargados.index') }}" class="btn btn-secondary px-4"> Cancelar </a>
            </div>
        </form>
    </div>
</div>

{{-- Mantenemos el mismo estilo violeta para coherencia visual --}}
<style>
    .btn-outline-custom {
        color: #555;
        background-color: #fff;
        border: 1px solid #ddd;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .btn-outline-custom:hover {
        background-color: #f3e5f5;
        border-color: #ce93d8;
        color: #7b1fa2;
    }

    /* ESTADO SELECCIONADO (CLICK O YA CARGADO) - TINTE VIOLETA */
    .btn-check:checked + .btn-outline-custom {
        background-color: #7b1fa2 !important;
        border-color: #6a1b9a !important;
        color: #ffffff !important;
        box-shadow: 0 4px 6px rgba(123, 31, 162, 0.3);
    }
</style>

@endsection