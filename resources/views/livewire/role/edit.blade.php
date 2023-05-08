<div class="modal modal-lg" id="editModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($data)
                <form class="form w-100" wire:submit.prevent="submit({{ $data->id }})">
                    <div class="modal-body">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bolder text-dark">Nama Role</label>
                            <input class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                   type="text" wire:model.defer="name" placeholder="Masukkan nama role" />
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <label class="form-label fs-6 fw-bolder text-dark">Permission</label>
                            @error('permissions')
                            <span class="text-danger  mb-4">{{ $message }}</span>
                            @enderror
                            <div class="col-12 mb-4">
                                <div class="form-check form-check-custom form-check-solid mb-2">
                                    <input wire:model="selectAll" class="form-check-input" type="checkbox" id="select-all"/>
                                    <label class="form-check-label" for="select-all">
                                        Pilih Semua
                                    </label>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <p>List</p>
                                @foreach($permissionData as $key => $permission)
                                    @if(\Str::contains($permission, '-list'))
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}"/>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @php
                                            unset($permissionData[$key]);
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-4 mb-2">
                                <p>Add</p>
                                @foreach($permissionData as $key => $permission)
                                    @if(\Str::contains($permission, '-add'))
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}"/>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @php
                                            unset($permissionData[$key]);
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-4 mb-2">
                                <p>Detail</p>
                                @foreach($permissionData as $key => $permission)
                                    @if(\Str::contains($permission, '-detail'))
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}"/>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @php
                                            unset($permissionData[$key]);
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-4 mb-2">
                                <p>Update</p>
                                @foreach($permissionData as $key => $permission)
                                    @if(\Str::contains($permission, '-update'))
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}"/>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @php
                                            unset($permissionData[$key]);
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-4 mb-2">
                                <p>Delete</p>
                                @foreach($permissionData as $key => $permission)
                                    @if(\Str::contains($permission, '-delete'))
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}"/>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @php
                                            unset($permissionData[$key]);
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-4 mb-2">
                                <p>Other</p>
                                @foreach($permissionData as $permission)
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}"/>
                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="modalClose" type="button" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="submit" class="indicator-label">Simpan</span>
                                <span wire:loading wire:target="submit" class="indicator-progress">Menyimpan
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            @else
                <p>Data Tidak Ditemukan</p>
            @endif
        </div>
    </div>
</div>


