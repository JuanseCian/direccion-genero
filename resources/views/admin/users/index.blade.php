@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-4">
    {{-- Encabezado de Sección --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-gray-800">Gestión de Usuarios</h2>
            <p class="text-muted small">Administración de accesos y roles del sistema.</p>
        </div>
        
    </div>


    {{-- Tarjeta Principal --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">ID</th>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Estado / Rol</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">#{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                        
                                    <span class="fw-semibold">{{ $user->username }}</span>
                                </div>
                            </td>
                            <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                            <td>
                                @if($user->rol_id == 3)
                                    <span class="badge rounded-pill bg-danger-soft text-danger border border-danger">
                                        <i class="fas fa-user-times me-1"></i> Inactivo
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-success-soft text-success border border-success">
                                        <i class="fas fa-user-check me-1"></i> Activo
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm" role="group" aria-label="Acciones de usuario">
                                    {{-- Botón Editar --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                    class="btn btn-outline-primary btn-sm" 
                                    data-bs-toggle="tooltip" 
                                    title="Editar Perfil">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>


                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

{{-- Estilos extra sugeridos para los badges suaves --}}
<style>
    .bg-success-soft { background-color: #e8fadf; }
    .bg-danger-soft { background-color: #fbe9eb; }
    .table-hover tbody tr:hover { background-color: #f8f9fc; }
</style>
@endsection