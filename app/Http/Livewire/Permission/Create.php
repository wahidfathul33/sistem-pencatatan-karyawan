<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    protected $listeners = ['createPermission'];

    public $title = 'Tambah Permission';

    public $name;

    protected array $rules = [
        'name' => ['required', 'unique:permissions,name']
    ];

    public function messages(): array
    {
        return [
            'name.unique' => "permission dengan nama \"$this->name\" sudah ada"
        ];
    }

    public function render()
    {
        return view('livewire.permission.create');
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-create-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function createPermission()
    {
        $this->modalShow();
    }

    public function submit()
    {
        $data = $this->validate();

        Permission::create($data);

        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'Menambahkan data Permission berhasil!']);

        $this->name = '';

        $this->emit('updatePermissionTable');
        $this->modalClose();
    }
}
