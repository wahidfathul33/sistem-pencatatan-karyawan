<?php

namespace App\Http\Livewire\Role;

use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    protected $listeners = ['editRole'];

    public $title = 'Edit Role';

    public $selectAll = false;

    public $permissions = [];

    public $data, $name, $permissionData;

    public function render()
    {
        $this->permissionData = Permission::orderByDesc('name')->get();

        return view('livewire.role.edit');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editRole($data)
    {
        $this->data = Role::find($data['role_id']);

        $this->name = $this->data->name;

        $this->permissions = $this->data->permissions->pluck('id');

        $this->modalShow();
    }

    public function submit($id)
    {
        $this->validate([
            'name' => 'required|unique:roles,name,'.$this->data->id,
            'permissions' => 'required|array'
        ]);

        $role = Role::find($id);
        $role->update(['name' => \Str::lower($this->name)]);
        $role->syncPermissions($this->permissions);

        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'Mengubah Role berhasil!']);

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
