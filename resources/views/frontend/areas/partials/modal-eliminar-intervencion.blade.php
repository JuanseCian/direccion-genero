<div class="modal fade" id="modalEliminarIntervencion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Eliminar intervención
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form id="formEliminarIntervencion" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p class="mb-2">
                        Esta acción quitará la intervención del historial del legajo.
                        Los archivos asociados se conservarán.
                    </p>
                    <p class="fw-bold text-danger mb-3">¿Está seguro de continuar?</p>

                    <label for="motivo_eliminacion" class="form-label fw-bold">
                        Motivo de la eliminación <span class="text-danger">*</span>
                    </label>
                    <textarea
                        id="motivo_eliminacion"
                        name="motivo_eliminacion"
                        class="form-control"
                        rows="4"
                        minlength="10"
                        maxlength="1000"
                        required
                        placeholder="Explique por qué se elimina esta intervención..."
                    ></textarea>
                    <div class="form-text">El motivo debe tener al menos 10 caracteres.</div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Confirmar eliminación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalEliminarIntervencion');
    const form = document.getElementById('formEliminarIntervencion');
    const motivo = document.getElementById('motivo_eliminacion');

    if (!modal || !form || !motivo) return;

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        form.action = button.dataset.action;
        motivo.value = '';
    });
});
</script>
