<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    protected $listeners = ['editPermission'];

    public $title = 'Edit Permission';

    public $data, $name;

    public function rules(): array
    {
        return [
            'name' => 'required|unique:permissions,name,'.$this->data->id
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => "permission dengan nama \"$this->name\" sudah ada"
        ];
    }

    public function render()
    {
        return view('livewire.permission.edit');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editPermission($data)
    {
        $this->data = Permission::find($data['permission_id']);

        if ($this->data){
            $this->name = $this->data->name;
        }

        $this->modalShow();
    }

    public function submit($id)
    {
        $data = $this->validate();

        $permission = Permission::find($id);

        if ($permission){
            $permission->update($data);

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Mengubah data Permission berhasil!']);

            $this->emit('updatePermissionTable');
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Mengubah data Permission gagal!']);
        }

        $this->modalClose();
    }
}
