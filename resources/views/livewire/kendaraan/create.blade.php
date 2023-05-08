<div class="modal" id="createModal" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($show_form)
                <form class="form w-100" wire:submit.prevent="submit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row fv-row mb-7">
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Nama Kendaraan</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('nama_kendaraan') is-invalid @enderror"
                                    type="text" wire:model="nama_kendaraan" placeholder="Masukkan Nama Kendaraan" />
                                @error('nama_kendaraan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Nama Pengguna</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('nama_pengguna') is-invalid @enderror"
                                    type="text" wire:model="nama_pengguna" placeholder="Masukkan Nama Pengguna" />
                                @error('nama_pengguna')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Nomor Kendaraan</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('plat_nomor') is-invalid @enderror"
                                    type="text" wire:model="plat_nomor" placeholder="Masukkan Nomor Kendaraan" />
                                @error('plat_nomor')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Asal Desa/Kelurahan</label>
                                <select wire:model="desa_id" class="form-select form-select-solid @error('desa_id') is-invalid @enderror"
                                {{ auth()->user()->hasRole('desa') ? 'disabled' : '' }}>
                                    <option value="">Pilih Desa</option>
                                    @foreach($desas as $desa)
                                        <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                                    @endforeach
                                </select>
                                @error('desa_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Nomor Mesin</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('nomor_mesin') is-invalid @enderror"
                                    type="text" wire:model="nomor_mesin" placeholder="Masukkan Nomor Mesin" />
                                @error('nomor_mesin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">NIK Pengguna</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('nik_pengguna') is-invalid @enderror"
                                    type="text" wire:model="nik_pengguna" placeholder="Masukkan NIK Pengguna" />
                                @error('nik_pengguna')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Nomor Rangka</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('nomor_rangka') is-invalid @enderror"
                                    type="text" wire:model="nomor_rangka" placeholder="Masukkan Nomor Rangka" />
                                @error('nomor_rangka')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Nomor Telpon Pengguna</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('telp_pengguna') is-invalid @enderror"
                                    type="text" wire:model="telp_pengguna" placeholder="Masukkan Nomor Telpon Pengguna" />
                                @error('telp_pengguna')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Tanggal Pajak</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('tgl_pajak') is-invalid @enderror"
                                    type="date" wire:model="tgl_pajak" placeholder="Masukkan Tanggal Pajak" />
                                @error('tgl_pajak')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Alamat Pengguna</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('alamat_pengguna') is-invalid @enderror"
                                    type="text" wire:model="alamat_pengguna" placeholder="Masukkan Alamat Pengguna" />
                                @error('alamat_pengguna')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Tanggal Ganti Plat</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('tgl_ganti_plat') is-invalid @enderror"
                                    type="date" wire:model="tgl_ganti_plat" placeholder="Masukkan Tanggal Ganti Plat" />
                                @error('tgl_ganti_plat')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Foto STNK</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('foto_stnk') is-invalid @enderror"
                                    type="file" wire:model="foto_stnk" />
                                @error('foto_stnk')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Warna Kendaraan</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('warna_kendaraan') is-invalid @enderror"
                                    type="text" wire:model="warna_kendaraan" placeholder="Masukkan Warna Kendaraan" />
                                @error('warna_kendaraan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-6 fw-bolder text-dark">Foto KTP</label>
                                <input
                                    class="form-control form-control-lg form-control-solid @error('foto_ktp') is-invalid @enderror"
                                    type="file" wire:model="foto_ktp" />
                                @error('foto_ktp')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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

@push('js')
    <script>
        window.addEventListener('show-create-modal', event => {
            $('#createModal').modal('show');
        });
    </script>
@endpush
