<div class="modal" id="createModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static"
     aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($show_form)
                <form class="form w-100" wire:submit.prevent="submit">
                    <div class="modal-body">
                        <div class="fv-row mb-7">
                            @include('partials._alert')
                            <label class="form-label fs-6 fw-bolder text-dark required" for="bulan">Pilih Bulan dan
                                Tahun</label>
                            <input
                                wire:model="bulan_tahun"
                                class="form-control form-control-lg form-control-solid @error('bulan_tahun') is-invalid @enderror"
                                type="month" lang="id-ID" id="bulan"/>
                            @error('bulan_tahun')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bolder text-dark required">Hasil Kinerja</label>
                            <textarea
                                class="form-control form-control-lg form-control-solid @error('hasil_kinerja') is-invalid @enderror"
                                type="text" wire:model.defer="hasil_kinerja"
                                placeholder="Masukkan Hasil Kinerja"></textarea>
                            @error('hasil_kinerja')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bolder text-dark required">Indikator</label>
                            <textarea
                                class="form-control form-control-lg form-control-solid @error('indikator') is-invalid @enderror"
                                type="text" wire:model.defer="indikator" placeholder="Masukkan Indikator"></textarea>
                            @error('indikator')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bolder text-dark required">Target</label>
                            <input
                                class="form-control form-control-lg form-control-solid @error('target') is-invalid @enderror"
                                type="number" wire:model.defer="target" placeholder="Masukkan Target"/>
                            @error('target')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bolder text-dark required">Realisasi</label>
                            <input
                                class="form-control form-control-lg form-control-solid @error('realisasi') is-invalid @enderror"
                                type="number" wire:model.defer="realisasi" placeholder="Masukkan Realisasi"/>
                            @error('realisasi')
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
            @endif
        </div>
    </div>
</div>
