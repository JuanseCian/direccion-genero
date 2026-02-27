@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header d-flex justify-content-between align-items-center text-white" 
         style="background:#5651A0; border-radius:8px 8px 0 0;">
        
        <h5 class="mb-0">
            <i class="bi bi-geo-alt"></i> Localidades
        </h5>

        <a href="{{ route('localidades.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-lg"></i> Nueva Localidad
        </a>
    </div>

    <div class="card-body bg-light">

        <table class="table align-middle table-hover bg-white rounded shadow-sm overflow-hidden">
            
            <thead style="background:#ecebfa;">
                <tr>
                    <th>Nombre</th>
                    <th>Código Postal</th>
                    <th>Provincia</th>
                    <th width="220" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($localidades as $localidad)
                <tr>
                    <td>{{ $localidad->nombre }}</td>
                    <td>{{ $localidad->codigo_postal }}</td>
                    <td>{{ $localidad->provincia->nombre ?? 'Sin Provincia' }}</td>
                    <td class="text-center">

                        <a href="{{ route('localidades.edit', $localidad->id) }}" 
                           class="btn btn-primary btn-sm me-2">
                           <i class="bi bi-pencil-square"></i>
                           Editar
                        </a>

                        <form method="POST" 
                              action="{{ route('localidades.destroy', $localidad->id) }}" 
                              style="display:inline"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta localidad?')">
                            
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                                Borrar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection