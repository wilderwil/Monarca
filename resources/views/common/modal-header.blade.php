<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>{{ $componentName }} | {{ $selectedId > 0 ? 'EDITAR' : 'CREAR' }}</b>
                    <h6 wire:loading class="text-center text-warning">Por favor espere</h6>
            </div>
            <div class="modal-body">
