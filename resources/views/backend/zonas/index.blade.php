@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header d-flex justify-content-between align-items-center text-white" 
         style="background:#5651A0; border-radius:8px 8px 0 0;">
        
        <h5 class="mb-0">
            <i class="bi bi-layers"></i> Zonas de Barrio
        </h5>

        <a href="{{ route('zonas.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-lg"></i> Nueva Zona
        </a>
    </div>

    <div class="card-body bg-light">

        <table class="table align-middle table-hover bg-white rounded shadow-sm overflow-hidden">
            
            <thead style="background:#ecebfa;">
                <tr>
                    <th>Nombre de la Zona</th>
                    <th width="220" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($zonas as $zona)
                <tr>
                    <td class="fw-bold">{{ $zona->nombre }}</td>
                    <td class="text-center">

                        <a href="{{ route('zonas.edit', $zona->id) }}" 
                           class="btn btn-primary btn-sm me-2 shadow-sm">
                           <i class="bi bi-pencil-square"></i>
                           Editar
                        </a>

                        <form method="POST" 
                              action="{{ route('zonas.destroy', $zona->id) }}" 
                              style="display:inline"
                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta zona?')">
                            
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm shadow-sm">
                                <i class="bi bi-trash"></i>
                                Borrar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        @if($zonas->isEmpty())
            <div class="text-center py-4">
                <p class="text-muted">No hay zonas registradas aún.</p>
            </div>
        @endif

    </div>

</div>

@endsection