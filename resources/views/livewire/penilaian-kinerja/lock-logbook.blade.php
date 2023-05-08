<div class="modal" id="lockModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="fv-row">
                    <h5>{{ $messageBody }}</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click="modalClose" type="button" class="btn btn-secondary">Batal</button>
                <button wire:click="lock({{ $data_id }})" type="button" class="btn btn-info">
                    <span wire:loading.remove wire:target="lock" class="indicator-label">Kunci</span>
                    <span wire:loading wire:target="lock" class="indicator-progress">Menyimpan
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
