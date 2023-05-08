<?php

namespace App\Http\Livewire\Kendaraan;

use App\Models\Kendaraan;
use Livewire\Component;

class Detail extends Component
{
    protected $listeners = ['detailKendaraan'];

    public $title = 'Detail Kendaraan';

    public $data;

    public function render()
    {
        return view('livewire.kendaraan.detail');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-detail-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function detailKendaraan($data)
    {
        $this->data = Kendaraan::find($data['kendaraan_id']);

        $this->modalShow();
    }

    public function edit($id)
    {
        $this->emit('editKendaraan', ['kendaraan_id' => $id]);
        $this->modalClose();
    }
}
