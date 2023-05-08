<?php

namespace App\Http\Livewire\User;

use App\Models\Desa;
use App\Models\User;
use App\Traits\ToastAlert;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use ToastAlert;

    protected $listeners = ['createUser'];

    public $title = 'Tambah User';
    public $show_form = false;

    public $username;
    public $email;
    public $password;
    public $desa_id;
    public $role;

    public function render()
    {
        $roles = Role::query()->orderBy('name')->get();
        $desas = Desa::query()->orderBy('nama')->get();

        return view('livewire.user.create', compact('roles', 'desas'));
    }

    protected array $rules = [
        'username' => 'required',
        'email' => 'email|required|unique:users,email',
        'password' => 'required',
        'desa_id' => 'required',
        'role' => 'required',
    ];

    public function createUser()
    {
        $this->show_form = true;
        $this->modalShow();
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            $user = User::create($data);

            $user->assignRole($data['role']);
        }catch (QueryException|\Exception $e){
            $this->errorAlert('Menambahkan data User gagal! '. $e->getMessage());
            return false;
        }

        $this->successAlert('Menambahkan data User berhasil!');
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
        $this->dispatchBrowserEvent('show-create-modal');
    }

    public function modalClose()
    {
        $this->resetForm();
        $this->resetValidation();
        $this->show_form = false;

        $this->dispatchBrowserEvent('close-modal');
    }
}
