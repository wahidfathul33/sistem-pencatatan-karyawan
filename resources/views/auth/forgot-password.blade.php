@extends('layouts.auth')

@section('page-title', 'Password Reset')

@push('style')
@endpush

@section('content')
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            @include('partials._alert')
            <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" method="POST" action="{{ route('password.email') }}">
               @csrf
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Lupa Password ?</h1>
                    <div class="text-gray-400 fw-bold fs-4">Masukkan email Anda untuk mengatur ulang password Anda.</div>
                </div>
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
                    <input class="form-control form-control-solid @error('email') is-invalid @enderror" type="email" placeholder="" name="email"
                        autocomplete="off" />
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                        <span class="indicator-label">Kirim</span>
                        <span class="indicator-progress">Sedang diproses...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <a href="{{ route('auth.login') }}" class="btn btn-lg btn-light-danger fw-bolder">Batal</a>
                </div>
            </form>
        </div>
@endsection
