<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Detail extends Component
{
    protected $listeners = ['detailPermission'];

    public $title = 'Detail Permission';

    public $data;

    public function render()
    {
        return view('livewire.permission.detail');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-detail-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function detailPermission($data)
    {
        $this->data = Permission::find($data['permission_id']);

        $this->modalShow();
    }

    public function edit($id)
    {
        $this->emit('editPermission', ['permission_id' => $id]);
        $this->modalClose();
    }
}
