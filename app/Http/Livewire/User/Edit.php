<?php

namespace App\Http\Livewire\User;

use App\Models\Desa;
use App\Models\User;
use App\Traits\ToastAlert;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use ToastAlert;

    protected $listeners = ['editUser'];

    public $title = 'Edit User';
    public $username;
    public $email;
    public $password;
    public $desa_id = 1;
    public $role;
    public $user;

    public function render()
    {
        $roles = Role::query()->orderBy('name')->get();
        $desas = Desa::query()->orderBy('nama')->get();

        return view('livewire.user.edit', compact('roles', 'desas'));
    }

    protected function rules()
    {
        return [
            'username' => 'required',
            'email' => 'email|required|unique:users,email,'.$this->user->id,
            'desa_id' => 'required',
            'role' => 'required',
        ];
    }

    public function editUser($data)
    {
        $this->user = User::find($data['user_id']);

        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->desa_id = $this->user->desa_id;
        $this->role = $this->user->roles->pluck('id')[0];

        $this->modalShow();
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            if ($this->password){
                $data['password'] = $this->password;
            }

            $this->user->update($data);

            $this->user->assignRole($data['role']);
        }catch (QueryException|\Exception $e){
            $this->errorAlert('Mengubah data User gagal! '. $e->getMessage());
            return false;
        }

        $this->successAlert('Mengubah data User berhasil!');
        $this->emit('updateUserTable');
        $this->resetForm();
        $this->modalClose();
    }

    private function resetForm()
    {
        $this->reset([
            'username',
            'email',
            'password',
            'desa_id',
            'role',
        ]);
    }

    public function modalShow()
    {
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function modalClose()
    {
        $this->resetForm();
        $this->resetValidation();

        $this->dispatchBrowserEvent('close-modal');
    }
}
