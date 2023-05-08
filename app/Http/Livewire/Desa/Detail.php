<?php

namespace App\Http\Livewire\Desa;

use App\Models\Desa;
use Livewire\Component;

class Detail extends Component
{
    protected $listeners = ['detailDesa'];

    public $title = 'Detail Desa';

    public $data;

    public function render()
    {
        return view('livewire.desa.detail');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-detail-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function detailDesa($data)
    {
        $this->data = Desa::find($data['desa_id']);

        $this->modalShow();
    }

    public function edit($id)
    {
        $this->emit('editDesa', ['desa_id' => $id]);
        $this->modalClose();
    }
}
