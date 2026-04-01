@extends('frontend.layouts.front')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header text-white" style="background:#5651A0;">
            <h5 class="mb-0">Nueva Denuncia</h5>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('denuncias.store') }}">
                @csrf

                <div class="mb-3">
                    <label>Persona</label>
                    <select name="persona_id" class="form-control" required>
                        <option value="">Seleccionar</option>
                        @foreach($personas as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->apellido }}, {{ $p->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Agresor</label>
                    <select name="agresor_id" class="form-control">
                        <option value="">Sin especificar</option>
                        @foreach($personas as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->apellido }}, {{ $p->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tipo de violencia</label>
                    <input type="text" name="tipo_violencia" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Lugar</label>
                    <input type="text" name="lugar" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="requiere_intervencion" class="form-check-input">
                    <label class="form-check-label">Requiere intervención</label>
                </div>

                <button class="btn btn-success">
                    Guardar Denuncia
                </button>

            </form>

        </div>
    </div>

</div>
@endsection