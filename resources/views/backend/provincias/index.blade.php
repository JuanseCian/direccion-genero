@extends('backend.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center text-white" 
         style="background:#5651A0; border-radius:8px 8px 0 0;">
        <h5 class="mb-0"><i class="bi bi-map"></i> Provincias</h5>
        <a href="{{ route('provincias.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-lg"></i> Nueva Provincia
        </a>
    </div>

    <div class="card-body bg-light">
        <table class="table align-middle table-hover bg-white rounded shadow-sm overflow-hidden">
            <thead style="background:#ecebfa;">
                <tr>
                    <th width="80">ID</th>
                    <th>Nombre</th>
                    <th width="220" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($provincias as $provincia)
                <tr>
                    <td>{{ $provincia->id }}</td>
                    <td class="fw-bold">{{ $provincia->nombre }}</td>
                    <td class="text-center">
                        <a href="{{ route('provincias.edit', $provincia->id) }}" class="btn btn-primary btn-sm me-2">
                           <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form method="POST" action="{{ route('provincias.destroy', $provincia->id) }}" style="display:inline" onsubmit="return confirm('¿Eliminar provincia?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection