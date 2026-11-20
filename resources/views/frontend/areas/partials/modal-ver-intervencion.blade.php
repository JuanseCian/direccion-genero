{{--
    Modal flotante para visualizar una intervención sin salir del legajo.
    Uso: cualquier enlace con la clase "js-ver-intervencion" y href a la vista show.
    Carga la vista show por AJAX y muestra solo el bloque #intervencion-detalle.
--}}
<div class="modal fade" id="modalVerIntervencion" tabindex="-1" aria-labelledby="modalVerIntervencionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable modal-fullscreen-lg-down">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white" style="background:#5651A0;">
                <h5 class="modal-title" id="modalVerIntervencionLabel">
                    <i class="bi bi-clipboard2-pulse me-2"></i>Detalle de la intervención
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body bg-light" id="modalVerIntervencionBody"></div>

            <div class="modal-footer">
                <a href="#" id="modalVerIntervencionEditar" class="btn btn-outline-primary d-none">
                    <i class="bi bi-pencil-square me-1"></i>Editar
                </a>
                <a href="#" id="modalVerIntervencionPestana" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Abrir en otra pestaña
                </a>
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<style>
    #modalVerIntervencion #intervencion-detalle {
        max-width: 100%;
        padding: 0 !important;
    }

    #modalVerIntervencion [data-ocultar-en-modal] {
        display: none !important;
    }

    #modalVerIntervencion .sticky-lg-top {
        position: static !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('modalVerIntervencion');
    if (!modalEl || typeof bootstrap === 'undefined') return;

    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    const body = document.getElementById('modalVerIntervencionBody');
    const btnPestana = document.getElementById('modalVerIntervencionPestana');
    const btnEditar = document.getElementById('modalVerIntervencionEditar');
    let estilosInyectados = [];
    let peticionActual = 0;

    const spinner = `
        <div class="text-center py-5 text-muted">
            <div class="spinner-border" role="status" style="color:#5651A0;"></div>
            <div class="mt-3">Cargando intervención...</div>
        </div>`;

    function limpiarEstilos() {
        estilosInyectados.forEach(el => el.remove());
        estilosInyectados = [];
    }

    document.addEventListener('click', function (event) {
        const link = event.target.closest('a.js-ver-intervencion');
        if (!link) return;

        // Ctrl/Cmd/Shift + click o clic medio: comportamiento normal (nueva pestaña)
        if (event.ctrlKey || event.metaKey || event.shiftKey || event.button !== 0) return;

        event.preventDefault();

        const url = link.href;
        const idPeticion = ++peticionActual;

        limpiarEstilos();
        body.innerHTML = spinner;
        btnPestana.href = url;
        btnEditar.classList.add('d-none');
        modal.show();

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
            credentials: 'same-origin'
        })
            .then(response => {
                if (!response.ok) throw new Error('HTTP ' + response.status);
                return response.text();
            })
            .then(html => {
                if (idPeticion !== peticionActual) return;

                const doc = new DOMParser().parseFromString(html, 'text/html');
                const detalle = doc.getElementById('intervencion-detalle');
                if (!detalle) throw new Error('Contenido no encontrado');

                doc.querySelectorAll('style[data-intervencion-estilos]').forEach(style => {
                    const copia = document.createElement('style');
                    copia.textContent = style.textContent;
                    document.head.appendChild(copia);
                    estilosInyectados.push(copia);
                });

                const linkEditar = detalle.querySelector('[data-ocultar-en-modal] a[href*="intervenciones"][href*="/edit"]');
                if (linkEditar) {
                    btnEditar.href = linkEditar.getAttribute('href');
                    btnEditar.classList.remove('d-none');
                }

                body.innerHTML = '';
                body.appendChild(document.importNode(detalle, true));
            })
            .catch(() => {
                if (idPeticion !== peticionActual) return;
                body.innerHTML = `
                    <div class="alert alert-danger m-3">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        No se pudo cargar la intervención.
                        <a href="${url}" target="_blank" rel="noopener noreferrer" class="alert-link">Abrir en otra pestaña</a>.
                    </div>`;
            });
    });

    modalEl.addEventListener('hidden.bs.modal', function () {
        peticionActual++;
        limpiarEstilos();
        body.innerHTML = '';
    });
});
</script>
