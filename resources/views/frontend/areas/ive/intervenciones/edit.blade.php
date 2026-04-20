@extends('frontend.layouts.front')

@section('title','Editar Intervención')

@section('content')

<div class="container py-4">

<h3 class="fw-bold mb-4" style="color:#5651A0;">
<i class="bi bi-pencil"></i>
Editar Intervención
</h3>

<form action="{{ route('ive.intervenciones.update',$intervencion->id) }}"
      method="POST"
      enctype="multipart/form-data"> {{-- <- Muy importante para subir archivos --}}

    @csrf
    @method('PUT')

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-3">
                    <label class="form-label fw-bold">Fecha</label>
                    <input type="date"
                           name="fecha_intervencion"
                           class="form-control"
                           value="{{ $intervencion->fecha_intervencion }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Tipo</label>
                    <select name="tipo_intervencion_id" class="form-select" required>
                        @foreach($tiposIntervencion as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ $intervencion->tipo_intervencion_id == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-bold">Profesional</label>
                    <select name="encargado_id" class="form-select" required>
                        @foreach($encargados as $encargado)
                            <option value="{{ $encargado->id }}"
                                {{ $intervencion->encargado_id == $encargado->id ? 'selected' : '' }}>
                                {{ $encargado->apellido }}, {{ $encargado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Detalle</label>
                    <textarea name="detalle" class="form-control" rows="4" required>{{ $intervencion->detalle }}</textarea>
                </div>

                {{-- NUEVO: Input para subir archivo --}}
                <div class="col-12">
                    <label class="form-label fw-bold">Archivo adjunto</label>
                    <input type="file"
                            name="archivos[]"
                            class="form-control"
                            multiple
                            accept=".pdf,.jpg,.jpeg,.png">

                    @php
                        $adjuntos = \App\Models\Adjunto::where('entidad_tipo','intervencion_ive')
                            ->where('entidad_id',$intervencion->id)
                            ->get();
                    @endphp

                    @if($adjuntos->count())
                        <div class="mt-3">
                            <label class="form-label fw-bold">Archivos adjuntos</label>

                            <ul class="list-group">
                                @foreach($adjuntos as $adjunto)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        
                                        <span>
                                            <i class="bi bi-paperclip"></i>
                                            {{ $adjunto->nombre_original }}
                                        </span>

                                        <a href="{{ route('adjuntos.descargar', $adjunto->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        target="_blank">
                                            <i class="bi bi-download"></i> Descargar
                                        </a>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <div class="card-footer text-end">
     <a href="{{ route('frontend.areas.ive.edit', $intervencion->ive_caso_id) }}" class="btn btn-secondary">
    Volver
</a>
            <button class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Actualizar
            </button>
        </div>
    </div>
</form>

</div>

@endsection