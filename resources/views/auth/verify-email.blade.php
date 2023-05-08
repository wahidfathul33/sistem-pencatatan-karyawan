@extends('layouts.auth')

@section('page-title', 'Login')

@push('style')
@endpush

@section('content')
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            @include('partials._alert')
            <div class="pt-lg-10 mb-10" >
                <!--begin::Logo-->
                <h1 class="fw-bolder fs-2qx text-gray-800 mb-7">Verifikasi Email Anda</h1>
                <!--end::Logo-->
                <!--begin::Message-->
                <div class="fs-3 fw-bold text-muted mb-10">Kami telah mengirim email ke
                    <a href="#" class="link-primary fw-bolder">{{ auth()->user()->email }}</a>
                    <br />silakan ikuti link untuk memverifikasi email Anda.</div>
                <!--end::Message-->
                <!--begin::Action-->
                <div class="text-center mb-10">
                    <h3 class="fw-bold text-gray-700">Belum menerima email?</h3>
                    <a href="{{ route('verification.send') }}" class="btn btn-lg btn-primary fw-bolder">Kirim ulang</a>
                </div>
                <!--end::Action-->
            </div>
        </div>
@endsection

