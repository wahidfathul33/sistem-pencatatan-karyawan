<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    protected $listeners = ['createRole'];

    public $title = 'Tambah Role';

    public $selectAll = false;

    public $permissions = [];

    public $name, $permissionData;

    protected array $rules = [
        'name' => ['required', 'unique:roles,name'],
        'permissions' => ['required', 'array'],
    ];

    public function render()
    {
        $this->permissionData = Permission::orderByDesc('name')->get();

        return view('livewire.role.create');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-create-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function createRole()
    {
        $this->modalShow();
    }

    public function submit()
    {
        $this->validate();

        $role = Role::create(['name' => \Str::lower($this->name)]);
        $role->syncPermissions($this->permissions);

        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'Menambahkan Role berhasil!']);

        $this->name = '';
        $this->permissions = [];
        $this->selectAll = false;

        $this->emit('updateRoleTable');
        $this->modalClose();
    }

    public function updatedSelectAll($value)
    {
        $this->permissions = $value ? Permission::pluck('id')->toArray() : [];
    }

    public function updatedPermissions()
    {
        $this->selectAll = false;
    }
}
