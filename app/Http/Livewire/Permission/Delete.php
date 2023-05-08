<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Delete extends Component
{
    protected $listeners = ['deletePermission' => 'showModalConfirmation'];

    public $title = 'Delete Permission';
    public $messageBody = 'Apakah anda yakin? Data yang anda pilih akan dihapus permanen!';

    public $data_id;

    public function render()
    {
        return view('livewire.permission.delete');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function showModalConfirmation($data)
    {
        $dataId = $data['permission_id'];
        $dataId = is_array($dataId) ? json_encode($dataId) : $dataId;

        $this->data_id = $dataId;
        $this->modalShow();
    }

    public function delete($id)
    {
        $data = is_array($id) ? Permission::whereIn('id', $id) : Permission::find($id);

        if ($data){
            $data->delete();

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Menghapus data Permission berhasil!']);

            $this->emit('updatePermissionTable');
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Menghapus data Permission gagal!']);
        }

        $this->modalClose();
    }
}
