{{-- Denuncias vinculadas por el DNI de la persona del legajo. --}}
<div class="card shadow-sm border-0 mb-4 border-start border-4" style="border-color:#dc3545!important;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 text-danger fw-bold">
            <i class="bi bi-exclamation-triangle me-2"></i>Denuncias
        </h5>
        <span class="badge bg-danger-subtle text-danger">
            {{ $denuncias->count() }} {{ $denuncias->count() === 1 ? 'registro' : 'registros' }}
        </span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="small text-uppercase">
                        <th>Fecha</th>
                        <th>Atendido por</th>
                        <th>Denunciante</th>
                        <th>Contacto</th>
                        <th>Ubicación</th>
                        <th>Agresor</th>
                        <th>Tipo de violencia</th>
                        <th>Observaciones</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($denuncias as $denuncia)
                        <tr>
                            <td class="fw-bold">
                                {{ $denuncia->fecha ? \Carbon\Carbon::parse($denuncia->fecha)->format('d/m/Y') : 'S/D' }}
                            </td>
                            <td>{{ $denuncia->atendido_por ?: 'S/D' }}</td>
                            <td>
                                <div>{{ $denuncia->denunciante ?: 'S/D' }}</div>
                                <span class="text-muted">DNI: {{ $denuncia->dni ?: 'S/D' }}</span>
                            </td>
                            <td>
                                <div>{{ $denuncia->telefono ?: 'S/D' }}</div>
                            </td>
                            <td>
                                <div>{{ $denuncia->direccion ?: 'S/D' }}</div>
                                @if($denuncia->barrio)
                                    <span class="text-muted">{{ $denuncia->barrio }}</span>
                                @endif
                            </td>
                            <td>{{ $denuncia->agresor ?: 'S/D' }}</td>
                            <td>{{ $denuncia->tipo_violencia ?: 'S/D' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($denuncia->observaciones ?? '', 80) ?: 'S/D' }}</td>
                            <td class="text-end">
                                <a href="{{ route('denuncias.edit', $denuncia->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Ver o editar denuncia">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                No hay denuncias registradas para este DNI.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
