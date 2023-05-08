@extends('layouts.app')

@section('page-title', 'Welcome')
@section('content-title', 'Welcome')

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
        <li class="breadcrumb-item text-muted">Dashboards</li>
    </ul>
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body p-0">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bold mb-10">Selamat datang</h2>
                    <p class="text-gray-400 fs-4 fw-semibold">Di {{ config('app.name') }}
                    </p>
                </div>
                <div class="text-center px-4 py-10">
                    <img class="mw-100 mh-300px" alt="" src={{ asset("assets/media/illustrations/unitedpalms-1/2.png") }}>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
