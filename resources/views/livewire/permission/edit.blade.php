<div class="modal fade" id="editModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($data)
                <form class="form w-100" wire:submit.prevent="submit({{ $data->id }})">
                    <div class="modal-body">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bolder text-dark">Permission</label>
                            <input wire:model.defer="name" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                   type="text" value="{{ $data->name }}" placeholder="Masukkan permission" />
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
            @else
                <p>User Tidak Ditemukan</p>
            @endif
        </div>
    </div>
</div>
