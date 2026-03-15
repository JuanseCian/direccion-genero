@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-2 py-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            {{-- Encabezado Adaptativo --}}
            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4 gap-3">
                <div>
                    <h2 class="h3 mb-1 text-gray-800"><i class="fas fa-user-cog me-2 text-primary"></i>Editar Usuario</h2>
                    <p class="text-muted small mb-0">Ajuste de roles y permisos de acceso al sistema.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary shadow-sm w-100 w-sm-auto">
                    <i class="fas fa-arrow-left me-1"></i> <span class="d-sm-inline">Volver</span>
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

                {{-- Card 1: Información de Cuenta --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="mb-0 text-secondary small text-uppercase fw-bold"><i class="fas fa-id-card me-2"></i>Información de Cuenta</h5>
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
                        <h5 class="mb-0 text-secondary small text-uppercase fw-bold"><i class="fas fa-shield-alt me-2"></i>Asignación de Rol</h5>
                    </div>
                    <div class="card-body bg-white">
                        <div class="mb-0">
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

                {{-- Card 3: Permisos de Áreas --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="mb-0 text-secondary small text-uppercase fw-bold"><i class="fas fa-layer-group me-2"></i>Permisos por Áreas</h5>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row g-3">
                            @foreach($areas as $area)
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-check area-check-box p-0">
                                        <input type="checkbox" name="areas[]" value="{{ $area->id }}" 
                                               class="form-check-input d-none" id="area_{{ $area->id }}"
                                               {{ $user->areas->contains($area->id) ? 'checked' : '' }}>
                                        
                                        <label class="area-clickable-label d-flex align-items-center justify-content-between border rounded p-3 m-0 shadow-xs" 
                                               for="area_{{ $area->id }}">
                                            <span class="fw-semibold small text-truncate">{{ $area->nombre }}</span>
                                            <i class="fas fa-check-circle check-icon ms-2"></i>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Card 4: Acceso a Casos IVE --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="mb-0 text-secondary small text-uppercase fw-bold">
                            <i class="fas fa-folder-open me-2"></i>Permisos Casos IVE
                        </h5>
                    </div>
                    <div class="card-body bg-white">
                        <label class="form-label fw-bold text-muted small mb-2">Casos específicos permitidos</label>
                        <div class="p-2 border rounded bg-light" style="max-height:250px; overflow-y:auto;">
                            <div class="row g-2">
                                @foreach($iveCasos as $caso)
                                    <div class="col-12 col-md-6">
                                        <div class="form-check bg-white p-2 border rounded shadow-xs">
                                            <input type="checkbox" name="ive_casos[]" value="{{ $caso->id }}"
                                                   class="form-check-input ms-0 me-2" id="ive_caso_{{ $caso->id }}"
                                                   {{ $user->iveCasos->contains($caso->id) ? 'checked' : '' }}>
                                            <label class="form-check-label small text-truncate w-75" for="ive_caso_{{ $caso->id }}">
                                                <strong>#{{ $caso->id }}</strong> - {{ $caso->persona->apellido ?? '' }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción Adaptativos --}}
                <div class="d-flex flex-column flex-sm-row gap-2 mb-5">
                    <button type="submit" class="btn btn-success btn-lg px-md-5 shadow-sm order-last order-sm-first">
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
    /* Se mantienen tus estilos pero con mejoras de toque móvil */
    .area-clickable-label {
        cursor: pointer;
        transition: all 0.2s ease;
        background-color: #fff;
        color: #6c757d;
        border: 2px solid #e9ecef !important;
        min-height: 58px;
    }
    .area-check-box .form-check-input:checked + .area-clickable-label {
        background-color: #7973CF !important;
        border-color: #7973CF !important;
        color: #fff !important;
        box-shadow: 0 4px 10px rgba(121, 115, 207, 0.3);
    }
    .check-icon { opacity: 0.1; }
    .area-check-box .form-check-input:checked + .area-clickable-label .check-icon { opacity: 1; }
    .area-clickable-label:active { transform: scale(0.98); }
</style>
@endsection