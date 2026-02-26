@extends('backend.layouts.app')

@section('content')

<div class="card shadow-sm p-4">

    <div class="d-flex justify-content-between mb-3">

        <h4>Localidades</h4>

        <a href="{{ route('localidades.create') }}"
        class="btn btn-primary"> Nueva Localidad </a>

    </div>

    <table class="table table-hover align-middle">

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th width="200">Acciones</th>

        </tr>

        @foreach($localidades as $localidad)

        <tr>
            <td>{{ $localidad->id }}</td>
            <td>{{ $localidad->nombre }}</td>
            <td>

                <a href="{{ route('localidades.edit',$localidad->id) }}" class="btn btn-warning btn-sm"> Editar </a>
                <form method="POST" action="{{ route('localidades.destroy',$localidad->id) }}" style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"> Eliminar </button>

                </form>
            </td>
        </tr>

        @endforeach

    </table>

</div>

@endsection