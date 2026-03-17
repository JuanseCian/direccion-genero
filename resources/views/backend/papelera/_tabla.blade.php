<div class="table-responsive">
    <table class="table table-hover bg-white shadow-sm rounded overflow-hidden">
        <thead style="background:#ecebfa;">
            <tr>
                <th class="ps-3">Persona</th>
                <th>Fecha de Eliminación</th>
                <th>Eliminado por</th> {{-- Nueva Columna --}}
                <th>Motivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registros as $reg)
                <tr>
                    <td class="ps-3">
                        <strong>{{ $reg->persona->nombre }} {{ $reg->persona->apellido }}</strong>
                    </td>
                    <td>{{ $reg->deleted_at->format('d/m/Y H:i') }}</td>
                    
                    {{-- Columna del Usuario --}}
                    <td>
                        @if($reg->eliminador)
                            {{-- Aquí 'name' es la columna de la tabla 'users' --}}
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-person me-1"></i> {{ $reg->eliminador->username }}
                            </span>
                        @else
                            <span class="text-muted small">No registrado</span>
                        @endif
                    </td>

                    <td><small>{{ $reg->motivo_eliminacion }}</small></td>
                    <td class="text-center">
                        <form action="{{ route('backend.papelera.restore', [$tipo, $reg->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                Restaurar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Sin registros eliminados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>