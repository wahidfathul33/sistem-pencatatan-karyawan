<?php

namespace App\Http\Livewire\User;

use App\Models\Desa;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Detail extends Component
{
    protected $listeners = ['detailUser'];

    public $title = 'Detail User';

    public $user;
    public $username;
    public $email;
    public $password;
    public $desa_id;
    public $role;
    public $user_id;

    public function render()
    {
        $roles = Role::query()->orderBy('name')->get();
        $desas = Desa::query()->orderBy('nama')->get();

        return view('livewire.user.detail', compact('roles', 'desas'));
    }

    public function detailUser($data)
    {
        $this->user = User::find($data['user_id']);

        $this->user_id = $this->user->id;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->desa_id = $this->user->desa_id;
        $this->role = $this->user->roles->pluck('id')[0];

        $this->modalShow();
    }

    public function edit($user_id)
    {
        $this->emit('editUser', ['user_id' => $user_id]);
        $this->modalClose();
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-detail-modal');
    }

    public function modalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
