@extends('layouts.app')

@section('page-title', 'Menilai Kinerja Pegawai')
@section('content-title', 'Menilai Kinerja Pegawai')

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
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('penilaian.index') }}" class="text-muted text-hover-primary">Penilaian</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Menilai Kinerja Pegawai</li>
    </ul>
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        @livewire('nilai-skp.menilai-form', ['id' => $nilai_skp->id])
    </div>
@endsection

@push('js')
@endpush
