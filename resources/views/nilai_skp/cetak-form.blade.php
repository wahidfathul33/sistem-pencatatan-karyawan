@extends('layouts.app')

@section('page-title', 'Cetak Penilaian Kinerja')
@section('content-title', 'Cetak Penilaian Kinerja')

@push('style')
@endpush

@section('breadcrumb')

    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="/" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Cetak Penilaian Kinerja</li>
    </ul>
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body p-0">
                <div class="card-px py-6 my-2">
                    <form method="POST" action="{{ route('skp.cetak-action') }}">
                        @csrf
                        <div class="fv-row mb-7">
                            <div class="col-4">
                                @include('partials._alert')
                                <label class="form-label fs-6 fw-bolder text-dark required" for="bulan">Pilih Bulan dan Tahun Data Kinerja</label>
                                <input class="form-control form-control-lg form-control-solid @error('bulan_dan_tahun') is-invalid @enderror"
                                       type="month" lang="id-ID" id="bulan" name="bulan_dan_tahun" value="{{ \Carbon\Carbon::now()->subMonths()->format('Y-m') }}"/>
                                @error('bulan_dan_tahun')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <div class="col-4">
                                <label class="form-label fs-6 fw-bolder text-dark required" for="lokasi">Lokasi</label>
                                <input class="form-control form-control-lg form-control-solid @error('lokasi') is-invalid @enderror"
                                       type="text" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi"/>
                                @error('lokasi')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <div class="col-4">
                                <label class="form-label fs-6 fw-bolder text-dark required" for="tanggal_cetak">Pilih Tanggal Cetak</label>
                                <input class="form-control form-control-lg form-control-solid @error('tanggal_cetak') is-invalid @enderror"
                                       type="date" id="tanggal_cetak" name="tanggal_cetak" value="{{ date('Y-m-d') }}"/>
                                @error('tanggal_cetak')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
