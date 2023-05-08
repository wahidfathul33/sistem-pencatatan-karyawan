@extends('layouts.app')

@section('page-title', 'Kinerja Pegawai')
@section('content-title', 'Kinerja Pegawai')

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
        <li class="breadcrumb-item text-muted">Kinerja Pegawai</li>
    </ul>
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body p-0">
                <div class="card-px py-10">
                    @livewire('penilaian-kinerja.filter')
                    @livewire('penilaian-kinerja.data-table')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @livewire('penilaian-kinerja.create')
    @livewire('penilaian-kinerja.edit')
    @livewire('penilaian-kinerja.detail')
    @livewire('penilaian-kinerja.delete')
    @livewire('penilaian-kinerja.lock-logbook')
@endsection

@push('js')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#createModal').modal('hide');
            $('#editModal').modal('hide');
            $('#detailModal').modal('hide');
            $('#deleteModal').modal('hide');
            $('#lockModal').modal('hide');
        });

        window.addEventListener('show-create-modal', event =>{
            $('#createModal').modal('show');
        });
        window.addEventListener('show-edit-modal', event =>{
            $('#editModal').modal('show');
        });
        window.addEventListener('show-detail-modal', event =>{
            $('#detailModal').modal('show');
        });
        window.addEventListener('show-delete-modal', event =>{
            $('#deleteModal').modal('show');
        });
        window.addEventListener('show-lock-modal', event =>{
            $('#lockModal').modal('show');
        });
    </script>
@endpush
