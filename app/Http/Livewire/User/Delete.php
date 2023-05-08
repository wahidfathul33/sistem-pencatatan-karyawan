<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    protected $listeners = ['deleteUser' => 'showModalConfirmation'];

    public $title = 'Delete User';

    public $messageBody = 'Apakah anda yakin? Data yang anda pilih akan dihapus permanen!';

    public $data_id;

    public function render()
    {
        return view('livewire.user.delete');
    }

    public function showModalConfirmation($data)
    {
        $this->data_id = $data['user_id'];
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

    public function delete($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'Menghapus data User berhasil!']);

        $this->emit('updateUserTable');
        $this->modalClose();
    }
}
