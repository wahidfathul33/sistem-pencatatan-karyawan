<div class="modal fade" id="createModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <form class="form w-100" wire:submit.prevent="submit">
                <div class="modal-body">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Permission</label>
                        <input class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                               type="text" wire:model.defer="name" placeholder="Masukkan permission" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="modalClose" type="button" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading.remove wire:target="submit" class="indicator-label">Simpan</span>
                        <span wire:loading wire:target="submit" class="indicator-progress">Menyimpan
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
