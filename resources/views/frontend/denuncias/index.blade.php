@extends('frontend.layouts.front')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between text-white" style="background:#5651A0;">
            <h5>Denuncias</h5>

            <a href="{{ route('denuncias.create') }}" class="btn btn-light btn-sm">
                Nueva
            </a>
        </div>

        <div class="card-body">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Persona</th>
                        <th>Agresor</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($denuncias as $d)
                        <tr>
                            <td>{{ $d->persona->apellido }}</td>
                            <td>{{ $d->agresor->apellido ?? '-' }}</td>
                            <td>{{ $d->fecha }}</td>
                            <td>{{ $d->tipo_violencia }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $denuncias->links() }}

        </div>
    </div>

</div>
@endsection