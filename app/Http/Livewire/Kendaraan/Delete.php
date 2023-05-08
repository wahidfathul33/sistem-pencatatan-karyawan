<?php

namespace App\Http\Livewire\Kendaraan;

use App\Models\Kendaraan;
use Livewire\Component;

class Delete extends Component
{
    protected $listeners = ['deleteKendaraan' => 'showModalConfirmation'];

    public $title = 'Delete Kendaraan';
    public $messageBody = 'Apakah anda yakin? Data yang anda pilih akan dihapus permanen!';

    public $data_id;

    public function render()
    {
        return view('livewire.kendaraan.delete');
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
        $dataId = $data['kendaraan_id'];
        $dataId = is_array($dataId) ? json_encode($dataId) : $dataId;

        $this->data_id = $dataId;
        $this->modalShow();
    }

    public function delete($id)
    {
        $data = is_array($id) ? Kendaraan::whereIn('id', $id) : Kendaraan::find($id);

        if ($data){
            $data->delete();

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Menghapus data Kendaraan berhasil!']);

            $this->emit('updateKendaraanTable');
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Menghapus data Kendaraan gagal!']);
        }

        $this->modalClose();
    }
}
