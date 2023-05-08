<div class="modal" id="detailModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($data)
                <div class="modal-body">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Bulan Tahun</label>
                        <input class="form-control form-control-lg form-control-solid "
                               type="text" value="{{ \Carbon\Carbon::parse($data->bulan_tahun)->isoFormat('MMMM YYYY') }}" readonly/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Hasil Kinerja</label>
                        <textarea class="form-control form-control-lg form-control-solid "
                                  type="text" readonly>{{ $data->hasil_kinerja }}</textarea>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Indikator</label>
                        <textarea class="form-control form-control-lg form-control-solid "
                                  type="text" readonly>{{ $data->indikator }}</textarea>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Target</label>
                        <input class="form-control form-control-lg form-control-solid "
                                  type="number" value="{{ $data->target }}" readonly/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Realisasi</label>
                        <input class="form-control form-control-lg form-control-solid "
                                  type="number" value="{{ $data->realisasi }}" readonly/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="modalClose" type="button" class="btn btn-secondary">Tutup</button>
                    @if(!$data->is_lock)
                    <button wire:click="edit({{ $data->id ?? '' }})" type="button" class="btn btn-primary">
                        <span wire:loading.remove wire:target="edit" class="indicator-label">Edit</span>
                        <span wire:loading wire:target="edit" class="indicator-progress">Tunggu
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                    </button>
                    @endif
                </div>
            @else
                <p>Data Tidak Ditemukan</p>
            @endif
        </div>
    </div>
</div>
