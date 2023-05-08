<div class="modal modal-lg" id="detailModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button wire:click="modalClose" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            @if($data)
                <form>
                    <div class="modal-body">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bolder text-dark">Nama Role</label>
                            <input class="form-control form-control-lg form-control-solid"
                                   type="text" wire:model="name" readonly/>
                        </div>
                        <div class="row">
                            <label class="form-label fs-6 fw-bolder text-dark">Permission</label>
                            <div class="col-4 mb-2">
                                <p>List</p>
                                @foreach($permissionData as $key => $permission)
                                    @if(\Str::contains($permission, '-list'))
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}" disabled/>
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
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}" disabled/>
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
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}" disabled/>
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
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}" disabled/>
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
                                            <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}" disabled/>
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
                                        <input wire:model="permissions" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission{{ $permission->id }}" disabled/>
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
                        <button wire:click="edit({{ $data->id }})" type="button" class="btn btn-primary">
                            <span wire:loading.remove wire:target="edit" class="indicator-label">Edit</span>
                                <span wire:loading wire:target="edit" class="indicator-progress">Tunggu
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


