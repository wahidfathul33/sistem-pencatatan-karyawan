<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Delete extends Component
{
    protected $listeners = ['deleteRole' => 'showModalConfirmation'];

    public $title = 'Delete Role';
    public $messageBody = 'Apakah anda yakin? Data yang anda pilih akan dihapus permanen!';
    public $role_id;

    public function render()
    {
        return view('livewire.role.delete');
    }

    public function showModalConfirmation($data)
    {
        $this->role_id = $data['role_id'];
        $this->modalShow();
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($role_id)
    {
        $user = Role::find($role_id);
        $user->delete();

        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'Menghapus data Role berhasil!']);

        $this->emit('updateRoleTable');
        $this->modalClose();
    }
}
