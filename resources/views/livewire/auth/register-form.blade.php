<div>
    <form wire:submit.prevent="submitRegister" class="form w-100" novalidate="novalidate">
        <div class="mb-10 text-center">
            <h1 class="text-dark mb-3">Buat Akun</h1>
            <div class="text-gray-400 fw-bold fs-4">Sudah punya akun?
                <a href="{{ route('auth.login') }}" class="link-primary fw-bolder">Login disini</a>
            </div>
        </div>
        <button type="button" class="btn btn-light-primary fw-bolder w-100 mb-10">
            <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3">Login dengan Google</button>
        <div class="d-flex align-items-center mb-10">
            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
            <span class="fw-bold text-gray-400 fs-7 mx-2">ATAU</span>
            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
        </div>
        <div class="row fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6">Nama Lengkap</label>
            <input wire:model.defer="full_name" class="form-control form-control-lg form-control-solid @error('full_name') is-invalid @enderror" type="text" placeholder="Masukkan nama lengkap"
                   autocomplete="off" />
            @error('full_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6">Email</label>
            <input wire:model.defer="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email" placeholder="Masukkan email"
                   name="email" autocomplete="off" />
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-10 fv-row" data-kt-password-meter="true">
            <div class="mb-1">
                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                <div class="position-relative mb-3">
                    <input wire:model.defer="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" placeholder="Masukkan password"
                           autocomplete="off" />
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
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="fv-row mb-5">
            <label class="form-label fw-bolder text-dark fs-6">Konfirmasi Password</label>
            <input wire:model.defer="password_confirmation" class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Masukkan konfirmasi password"
                   autocomplete="off" />
            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary">
                <span class="indicator-label">Kirim</span>
                <span class="indicator-progress">Sedang diproses...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</div>
