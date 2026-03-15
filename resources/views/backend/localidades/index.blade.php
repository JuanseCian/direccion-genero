@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 text-white" 
         style="background:#5651A0; border-radius:8px 8px 0 0;">
        
        <h5 class="mb-0">
            <i class="bi bi-geo-alt"></i> Localidades
        </h5>

        <a href="{{ route('localidades.create') }}" class="btn btn-light btn-sm shadow-sm w-100 w-sm-auto">
            <i class="bi bi-plus-lg"></i> Nueva Localidad
        </a>
    </div>

    <div class="card-body bg-light p-2 p-md-3">

        <div class="table-responsive rounded shadow-sm">
            <table class="table align-middle table-hover bg-white mb-0">
                
                <thead style="background:#ecebfa;">
                    <tr>
                        <th class="ps-3">Nombre</th>
                        <th>C.P.</th> <th class="d-none d-md-table-cell">Provincia</th> <th class="text-center" style="min-width: 180px;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($localidades as $localidad)
                    <tr>
                        <td class="ps-3 fw-medium">{{ $localidad->nombre }}</td>
                        <td>{{ $localidad->codigo_postal }}</td>
                        <td class="d-none d-md-table-cell">
                            <span class="badge bg-soft-primary text-dark border">
                                {{ $localidad->provincia->nombre ?? 'Sin Provincia' }}
                            </span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('localidades.edit', $localidad->id) }}" 
                               class="btn btn-primary btn-sm me-1" 
                               title="Editar">
                               <i class="bi bi-pencil-square"></i>
                               <span class="d-none d-lg-inline">Editar</span>
                            </a>

                            <form method="POST" 
                                  action="{{ route('localidades.destroy', $localidad->id) }}" 
                                  style="display:inline"
                                  class="form-delete">
                                
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm" title="Borrar">
                                    <i class="bi bi-trash"></i>
                                    <span class="d-none d-lg-inline">Borrar</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div> </div>
</div>

@endsection