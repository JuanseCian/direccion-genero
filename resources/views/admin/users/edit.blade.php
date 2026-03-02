@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Encabezado --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-user-cog me-2 text-primary"></i>Editar Usuario</h2>
                    <p class="text-muted small">Ajuste de roles y permisos de acceso al sistema.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Volver al listado
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                {{-- Card 1: Información de Cuenta (Solo lectura) --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="mb-0 text-secondary"><i class="fas fa-id-card me-2"></i>Información de Cuenta</h5>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted small">Nombre de Usuario</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-0"><i class="fas fa-at"></i></span>
                                    <input type="text" class="form-control bg-light border-0" value="{{ $user->username }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted small">Nombre Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-0"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control bg-light border-0" value="{{ $user->nombre }} {{ $user->apellido }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Rol y Estado --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="mb-0 text-secondary"><i class="fas fa-shield-alt me-2"></i>Asignación de Rol</h5>
                    </div>
                    <div class="card-body bg-white">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Seleccionar Rol del Sistema</label>
                            <select name="rol_id" class="form-select border-primary-soft shadow-none" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->rol_id == $role->id ? 'selected' : '' }}>
                                        @switch($role->id)
                                            @case(1) Usuario @break
                                            @case(2) Administrador @break
                                            @case(3) Inactivo @break
                                            @case(4) Programador @break
                                            @default {{ $role->nombre }}
                                        @endswitch
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Permisos de Áreas (Diseño Iluminado) --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="mb-0 text-secondary"><i class="fas fa-layer-group me-2"></i>Permisos por Áreas</h5>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            @foreach($areas as $area)
                                <div class="col-md-4 mb-3">
                                    {{-- Contenedor con la clase custom 'area-check-box' --}}
                                    <div class="form-check form-switch area-check-box p-0">
                                        <input type="checkbox" name="areas[]" value="{{ $area->id }}" 
                                               class="form-check-input d-none" id="area_{{ $area->id }}"
                                               {{ $user->areas->contains($area->id) ? 'checked' : '' }}>
                                        
                                        <label class="area-clickable-label d-flex align-items-center justify-content-between border rounded p-3 m-0 shadow-xs" 
                                               for="area_{{ $area->id }}">
                                            <span class="fw-semibold">{{ $area->nombre }}</span>
                                            <i class="fas fa-check-circle check-icon"></i>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="d-flex gap-2 mb-5">
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                        <i class="fas fa-save me-2"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-lg shadow-sm">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* Estilo base del rectángulo */
    .area-clickable-label {
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #fff;
        color: #6c757d;
        border: 2px solid #e9ecef !important;
    }

    /* Ocultamos el checkbox original para usar el diseño de la card */
    .area-check-box .form-check-input:checked + .area-clickable-label {
        background-color: #7973CF !important;
        border-color: #7973CF !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(121, 115, 207, 0.4);
    }

    /* Icono de check que aparece/cambia */
    .check-icon {
        opacity: 0.2;
        transition: opacity 0.3s ease;
    }

    .area-check-box .form-check-input:checked + .area-clickable-label .check-icon {
        opacity: 1;
    }

    /* Efecto Hover */
    .area-clickable-label:hover {
        border-color: #7973CF !important;
        background-color: #f8f9ff;
    }

    .shadow-xs { box-shadow: 0 .125rem .25rem rgba(0,0,0,.04); }
    .bg-info-soft { background-color: #e0f7fa; color: #00838f; }
</style>
@endsection 