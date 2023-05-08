<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Detail extends Component
{
    protected $listeners = ['detailRole'];

    public $title = 'Detail Role';

    public $permissions = [1];

    public $data, $name, $permissionData;

    public function render()
    {
        $this->permissionData = Permission::orderByDesc('name')->get();

        return view('livewire.role.detail');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-detail-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function detailRole($data)
    {
        $this->data = Role::find($data['role_id']);

        $this->name = $this->data->name;

        $this->permissions = $this->data->permissions->pluck('id');

        $this->modalShow();
    }

    public function edit($id)
    {
        $this->emit('editRole', ['role_id' => $id]);
        $this->modalClose();
    }
}
