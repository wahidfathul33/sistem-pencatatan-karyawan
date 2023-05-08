<div class="modal" id="createModal" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($show_form)
            <form class="form w-100" wire:submit.prevent="submit">
                <div class="modal-body">
                    @if($role == 2)
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Desa</label>
                        <select wire:model="desa_id" class="form-select @error('desa_id') is-invalid @enderror">
                            <option value="">Pilih Desa</option>
                            @foreach($desas as $desa)
                                <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                            @endforeach
                        </select>
                        @error('desa_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Role</label>
                        <select wire:model="role" class="form-select @error('role') is-invalid @enderror"
                                id="select2-role" data-placeholder="Pilih Role">
                            <option value="">Pilih Role</option>
                            @foreach($roles as $roleValue)
                                <option value="{{ $roleValue->id }}">{{ str()->title($roleValue->name) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Nama</label>
                        <input
                            class="form-control form-control-lg form-control-solid @error('username') is-invalid @enderror"
                            type="text" wire:model="username" placeholder="Masukkan Username" />
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <input
                            class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                            type="email" wire:model="email" placeholder="Masukkan Email" />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bolder text-dark">Password</label>
                        <input
                            class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                            type="password" wire:model="password" placeholder="Masukkan Password" />
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="modalClose" type="button" class="btn btn-secondary">Batal</button>
                    <button wire:click="submit" type="button" class="btn btn-primary">
                        <span wire:loading.remove wire:target="submit" class="indicator-label">Simpan</span>
                        <span wire:loading wire:target="submit" class="indicator-progress">Tunggu
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('show-create-modal', event => {
            $('#createModal').modal('show');
        });
    </script>
@endpush
