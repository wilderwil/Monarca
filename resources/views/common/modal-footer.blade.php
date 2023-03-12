</div>
<div class="modal-footer">
    <button wire:click.prevent="resetUI()" type="button" class="btn btn-dark close-btn"
        data-dismiss="modal">Cerrar</button>
    @if ($selectedId < 1)
        <button wire:click.prevent="store()" type="button" class="btn btn-dark close-modal">Crear</button>
    @else
        <button wire:click.prevent="update()" type="button" class="btn btn-dark close-modal">Actualizar</button>
    @endif
</div>
</div>
</div>
</div>
