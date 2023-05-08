<?php

namespace App\Http\Livewire\Desa;

use App\Models\Desa;
use Livewire\Component;

class Delete extends Component
{
    protected $listeners = ['deleteDesa' => 'showModalConfirmation'];

    public $title = 'Delete Desa';
    public $messageBody = 'Apakah anda yakin? Data yang anda pilih akan dihapus permanen!';

    public $data_id;

    public function render()
    {
        return view('livewire.desa.delete');
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
        $dataId = $data['desa_id'];
        $dataId = is_array($dataId) ? json_encode($dataId) : $dataId;

        $this->data_id = $dataId;
        $this->modalShow();
    }

    public function delete($id)
    {
        $data = is_array($id) ? Desa::whereIn('id', $id) : Desa::find($id);

        if ($data){
            $data->delete();

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Menghapus data Desa berhasil!']);

            $this->emit('updateDesaTable');
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Menghapus data Desa gagal!']);
        }

        $this->modalClose();
    }
}
