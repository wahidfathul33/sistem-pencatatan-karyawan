<div class="card">
    <div class="card-body p-0">
        <div class="card-header card-header-stretch">
            <div class="card-title d-flex align-items-center">
                <h3><br>Penilaian Kinerja Pegawai <span><br><p
                            class="text-muted fs-5">{{ \Carbon\Carbon::parse($nilai->bulan_tahun)->isoFormat('MMMM YYYY') }}</p></span></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table col-6">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $nilai->user->full_name }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $nilai->user->nip }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $nilai->user->jabatan }}</td>
                        </tr>
                        <tr>
                            <td>Unit Kerja</td>
                            <td>:</td>
                            <td>{{ $nilai->user->unit->nama }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <h4 class="mt-4">A. Kinerja</h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped gy-7 gs-7">
                    <thead>
                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th>No.</th>
                        <th>Hasil Kerja</th>
                        <th>Indikator</th>
                        <th>Target</th>
                        <th>Realisasi</th>
                        <th>Nilai Hasil Kerja</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($nilai->penilaian_kinerja as $key => $kinerja)
                        <tr>
                            <td>{{ $key+1 }}.</td>
                            <td>{{ $kinerja->hasil_kinerja }}</td>
                            <td>{{ $kinerja->indikator }}</td>
                            <td>{{ $kinerja->target }}</td>
                            <td>{{ $kinerja->realisasi }}</td>
                            <td>
                                <div class="d-flex @error('nilai_kinerja.'.$key ) border border-2 border-danger @enderror">
                                    <i wire:click="setNilaiKinerja({{ $key }}, 1, {{ $kinerja->id }})"
                                       class="fa fa-thumbs-up fs-2 {{ $nilai_kinerja[$key] === 1 ? 'text-primary' : '' }}"></i>
                                    <i wire:click="setNilaiKinerja({{ $key }}, 0, {{ $kinerja->id }})"
                                       class="fa fa-thumbs-down fs-2 ms-4 {{ $nilai_kinerja[$key] === 0 ? 'text-danger' : '' }}"></i>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-400">
                        <td class="fw-bold" colspan="5" style="vertical-align: middle;">Rating Kinerja</td>
                        <td style="width: 20%">
                            <select wire:model="rating_kinerja" class="form-select form-select-sm @error('rating_kinerja') is-invalid @enderror">
                                <option value="">Nilai</option>
                                <option value="Dibawah Ekspektasi">Dibawah Ekspektasi</option>
                                <option value="Sesuai Ekspektasi">Sesuai Ekspektasi</option>
                                <option value="Diatas Ekspektasi">Diatas Ekspektasi</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">B. Perilaku Kerja</h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped gy-7 gs-7">
                    <tbody>
                    @foreach($perilaku_kerja as $key => $perilaku)
                        <tr>
                            <td>{{ $key+1 }}.</td>
                            <td>{{ $perilaku->perilaku_kerja->core_values }}</td>
                            <td>{!!  $perilaku->perilaku_kerja->details !!}</td>
                            <td>
                                <div class="d-flex @error('nilai_perilaku.'.$key ) border border-2 border-danger @enderror">
                                    <i wire:click="setNilaiPerilaku({{ $key }}, 1, {{ $perilaku->id }})"
                                       class="fa fa-thumbs-up fs-2 {{ $nilai_perilaku[$key] === 1 ? 'text-primary' : '' }}"></i>
                                    <i wire:click="setNilaiPerilaku({{ $key }}, 0, {{ $perilaku->id }})"
                                       class="fa fa-thumbs-down fs-2 ms-4 {{ $nilai_perilaku[$key] === 0 ? 'text-danger' : '' }}"></i>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-400">
                        <td class="fw-bold" colspan="3" style="vertical-align: middle;">Rating Perilaku Kerja</td>
                        <td>
                            <select wire:model="rating_perilaku" class="form-select form-select-sm @error('rating_perilaku') is-invalid @enderror">
                                <option value="">Nilai</option>
                                <option value="Dibawah Ekspektasi">Dibawah Ekspektasi</option>
                                <option value="Sesuai Ekspektasi">Sesuai Ekspektasi</option>
                                <option value="Diatas Ekspektasi">Diatas Ekspektasi</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="bg-gray-400">
                        <td class="fw-bold" colspan="3" style="vertical-align: middle;">Predikat Penilaian Kinerja</td>
                        <td style="width: 20%;">
                            <select wire:model="nilai_predikat" class="form-select form-select-sm @error('nilai_predikat') is-invalid @enderror">
                                <option value="">Nilai</option>
                                <option value="Kurang">Kurang</option>
                                <option value="Cukup">Cukup</option>
                                <option value="Baik">Baik</option>
                                <option value="Sangat Baik">Sangat Baik</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                <a href="{{ route('penilaian.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left">&nbsp;</i>Kembali</a>
                <button wire:click="kunci" class="btn btn-primary ms-2">Simpan</button>
            </div>
        </div>
    </div>
</div>
