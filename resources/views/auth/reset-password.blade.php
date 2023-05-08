@extends('layouts.auth')

@section('page-title', 'Atur Password Baru Baru')

@push('style')
@endpush

@section('content')
        <div class="w-lg-550px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            @include('partials._alert')
            <form class="form w-100" novalidate="novalidate" id="kt_new_password_form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Atur Password Baru</h1>
                    <div class="text-gray-400 fw-bold fs-4">Sudah mengatur ulang password Anda?
                        <a href="{{ route('auth.login') }}" class="link-primary fw-bolder">Login disini</a>
                    </div>
                </div>
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <div class="mb-1">
                        <label class="form-label fw-bolder text-dark fs-6">Password</label>
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" placeholder=""
                                name="password" autocomplete="off" />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                    </div>
                    <div class="text-muted">Gunakan 8 karakter atau lebih dengan campuran huruf, angka &amp; simbol.</div>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-dark fs-6">Konfirmasi Password</label>
                    <input class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" type="password" placeholder=""
                        name="password_confirmation" autocomplete="off" />
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                        <span class="indicator-label">Kirim</span>
                        <span class="indicator-progress">Sedang diproses...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
@endsection
