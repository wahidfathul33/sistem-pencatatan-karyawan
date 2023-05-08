@extends('layouts.app')

@section('page-title', 'Penilaian')
@section('content-title', 'Penilaian')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush

@section('breadcrumb')

    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="/" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Penilaian</li>
    </ul>
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header card-header-stretch">
                <div class="card-title d-flex align-items-center"><h3>Daftar Pegawai</h3></div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('penilaian.filter') }}">
                    @csrf
                    <div class="row mb-7">
                        {{ $status_nilai }}
                        <div class="col-3">
                            <input
                                name="bulan_tahun"
                                class="form-control form-control-lg form-control-solid"
                                value="{{ $bulan_tahun ?? \Carbon\Carbon::now()->subMonths()->format('Y-m') }}"
                                type="month" lang="id-ID"/>
                        </div>
                        <div class="col-3">
                            <select name="status_nilai" class="form-select form-select-lg form-select-solid">
                                <option value="">Semua</option>
                                <option value="true"  {{ $status_nilai === 'true' ? 'selected' : '' }}>Sudah Dinilai</option>
                                <option value="false" {{ $status_nilai === 'false' ? 'selected' : '' }}>Belum Dinilai</option>
                            </select>
                        </div>
                        <div class="col-3">
                        <input type="submit" class="btn btn-primary" value="Filter" />
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example" class="table table-striped gy-7 gs-7">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($nilaiArray as $key => $nilai)
                            <tr>
                                <td style="width: 8%">{{ $key+1 }}</td>
                                <td>{{ $nilai->user->full_name }}</td>
                                <td>{{ $nilai->user->nip }}</td>
                                <td>{{ $nilai->user->jabatan }}</td>
                                <td>{{ $nilai->user->unit->nama }}</td>
                                <td style="width: 10%">
                                    @if($nilai->is_lock)
                                        <a href="{{ route('penilaian.menilai', ['nilai_skp' => $nilai->id]) }}"
                                           class="btn btn-sm btn-warning" title="Ubah Nilai">
                                            Ubah Nilai
                                        </a>
                                    @else
                                        <a href="{{ route('penilaian.menilai', ['nilai_skp' => $nilai->id]) }}"
                                           class="btn btn-sm btn-primary {{ $nilai->penilaian_kinerja_count <= 0 ? 'disabled' : '' }}" title="Beri Nilai">
                                            Beri Nilai
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "searching": true,
            });
        });
    </script>
@endpush
