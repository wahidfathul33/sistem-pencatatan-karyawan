<div class="modal fade" id="detailModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($data)
                <div class="modal-body">
                    <div class="row fv-row mb-7">
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Nama Kendaraan</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->nama_kendaraan }}" readonly/>
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Warna Kendaraan</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->warna_kendaraan }}" readonly/>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Nomor Kendaraan</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->plat_nomor }}" readonly/>
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Asal Desa/Kelurahan</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->desa->nama }}" readonly/>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Nomor Mesin</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->nomor_mesin }}" readonly/>
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Nama Pengguna</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->nama_pengguna }}" readonly/>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Nomor Rangka</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->nomor_rangka }}" readonly/>
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Nomor Telpon Pengguna</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->telp_pengguna }}" readonly/>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Tanggal Pajak</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->tgl_pajak }}" readonly/>
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Alamat Pengguna</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->alamat_pengguna }}" readonly/>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Tanggal Ganti Plat</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->tgl_ganti_plat }}" readonly/>
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">NIK Pengguna</label>
                            <input class="form-control form-control-lg form-control-solid "
                                   type="text" value="{{ $data->nik_pengguna }}" readonly/>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Foto STNK</label>
                            <img src="{{ asset('images/stnk/'.$data->foto_stnk) }}" style="width: 100%">
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-6 fw-bolder text-dark">Foto KTP</label>
                            <img src="{{ asset('images/ktp/'.$data->foto_ktp) }}" style="width: 100%">
                        </div>
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
