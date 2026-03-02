@extends('backend.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center text-white" 
         style="background:#5651A0; border-radius:8px 8px 0 0;">
        
        <h5 class="mb-0">
            <i class="bi bi-person-vcard"></i> Estados Civiles
        </h5>

        <a href="{{ route('backend.estado-civil.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-lg"></i> Nuevo Estado Civil
        </a>
    </div>

    <div class="card-body bg-light">
        <table class="table align-middle table-hover bg-white rounded shadow-sm overflow-hidden">
            <thead style="background:#ecebfa;">
                <tr>
                    <th class="ps-3">ID</th>
                    <th>Nombre</th>
                    <th width="220" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estados as $estado)
                <tr>
                    <td class="ps-3 text-muted">#{{ $estado->id }}</td>
                    <td class="fw-bold">{{ $estado->nombre }}</td>
                    <td class="text-center">
                        <a href="{{ route('backend.estado-civil.edit', $estado->id) }}" 
                           class="btn btn-primary btn-sm me-2">
                           <i class="bi bi-pencil-square"></i> Editar
                        </a>

                        <form method="POST" 
                              action="{{ route('backend.estado-civil.destroy', $estado->id) }}" 
                              style="display:inline"
                              class="d-inline form-delete">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Borrar
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