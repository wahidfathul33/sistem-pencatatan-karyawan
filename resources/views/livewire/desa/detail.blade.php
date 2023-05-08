<div class="modal fade" id="detailModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($data)
                <div class="modal-body">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Nama</label>
                        <input class="form-control form-control-lg form-control-solid "
                               type="text" value="{{ $data->nama }}" readonly/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Alamat</label>
                        <input class="form-control form-control-lg form-control-solid "
                               type="text" value="{{ $data->alamat }}" readonly/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="modalClose" type="button" class="btn btn-secondary">Tutup</button>
                    <button wire:click="edit({{ $data->id ?? '' }})" type="button" class="btn btn-primary">
                        <span wire:loading.remove wire:target="edit" class="indicator-label">Edit</span>
                        <span wire:loading wire:target="edit" class="indicator-progress">Tunggu
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                    </button>
                </div>
            @else
                <p>Data Tidak Ditemukan</p>
            @endif
        </div>
    </div>
</div>
