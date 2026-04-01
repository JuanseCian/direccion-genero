@extends('frontend.layouts.front')

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-sm border-0">
        
        <div class="card-header d-flex justify-content-between align-items-center text-white" 
             style="background:#5651A0;">
            
            <h5 class="mb-0">
                <i class="bi bi-exclamation-triangle me-2"></i> Denuncias
            </h5>

            <a href="{{ route('denuncias.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-lg"></i> Nueva Denuncia
            </a>
        </div>

        <div class="card-body bg-light">
            <div class="table-responsive">

                <table class="table table-hover bg-white">
                    <thead style="background:#ecebfa;">
                        <tr>
                            <th>Fecha</th>
                            <th>Denunciante</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Agresor</th>
                            <th>Tipo Violencia</th>
                            <th width="120" class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($denuncias as $d)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($d->fecha)->format('d/m/Y') }}</td>

                            <td>{{ $d->denunciante_nombre }} {{ $d->denunciante_apellido }}</td>

                            <td>{{ $d->dni }}</td>

                            <td>{{ $d->telefono }}</td>

                            <td>{{ $d->agresor }}</td>

                            <td>{{ $d->tipo_violencia }}</td>

                            <td class="text-center">
                                <div class="btn-group">
                                    
                                    <a href="{{ route('denuncias.edit',$d->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('denuncias.destroy',$d->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Eliminar denuncia?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No hay denuncias registradas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $denuncias->links() }}
                </div>

            </div>
        </div>
    </div>

</div>
@endsection