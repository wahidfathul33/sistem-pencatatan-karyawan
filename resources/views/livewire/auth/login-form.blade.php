<div>
    <form class="form w-100" novalidate="novalidate" wire:submit.prevent="submitLogin">
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Silakan Login</h1>
{{--            <div class="text-gray-400 fw-bold fs-4">Belum memiliki akun?--}}
{{--                <a href="{{ route('auth.register') }}" class="link-primary fw-bolder">Buat akun</a>--}}
{{--            </div>--}}
        </div>
        @include('partials._alert')
        <div class="fv-row mb-10">
            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
            <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                type="email" wire:model.defer="email" autocomplete="off" placeholder="Masukkan email" />
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Lupa Password ?</a>
            </div>
            <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                type="password" wire:model.defer="password" autocomplete="off" placeholder="Masukkan password" />
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <label class="form-check form-check-inline">
                <input wire:model.defer="remember_me" class="form-check-input" type="checkbox">
                <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Ingat saya</span>
            </label>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                <span class="indicator-label">Lanjutkan</span>
                <span class="indicator-progress">Sedang diproses...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</div>
