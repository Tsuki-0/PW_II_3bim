<!-- Estilos do modal -->
<style>
    .modal-backdrop {
        --bs-backdrop-bg: var(--slate);
        --bs-backdrop-opacity: .5;
    }

    .modal-content {
        border: 1px solid var(--border);
        border-radius: 16px;
        background: var(--white);
        box-shadow: 0 20px 40px rgba(15, 23, 42, .18);
        overflow: hidden;
    }

    .modal-header {
        border-bottom: 1px solid var(--border);
        padding: 1.1rem 1.5rem;
    }

    .titulo-modal {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--slate);
    }

    .modal-header .btn-close:focus {
        box-shadow: 0 0 0 .2rem var(--teal-dim);
    }

    .modal-body {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        color: var(--muted);
    }

    .modal-icon {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--red-dim);
        color: var(--red);
        font-size: 1.15rem;
    }

    .modal-footer {
        border-top: 1px solid var(--border);
        background: var(--surface);
        padding: .9rem 1.5rem;
    }

    .btn-crud-danger {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-weight: 600;
        background: var(--red);
        border: 1px solid var(--red);
        color: var(--white);
        transition: background-color .15s ease, border-color .15s ease;
    }

    .btn-crud-danger:hover,
    .btn-crud-danger:focus {
        background: #c53030;
        border-color: #c53030;
        color: var(--white);
    }

    @media (max-width: 575.98px) {
        .modal-header,
        .modal-body,
        .modal-footer {
            padding-left: 1.1rem;
            padding-right: 1.1rem;
        }
    }
</style>

<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="titulo-modal" id="modalLabel">Excluir Enfermeiro</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="modal-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
                <p class="mb-0">Deseja realmente excluir este Enfermeiro?</p>
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-crud-danger" href="#">
                    <i class="fa-solid fa-circle-check"></i> Sim
                </a>
                <a id="cancel" class="btn btn-crud-secondary" data-bs-dismiss="modal" role="button">
                    <i class="fa-solid fa-circle-xmark"></i> Não
                </a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->