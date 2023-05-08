<?php

namespace App\Http\Livewire\Desa;

use App\Models\Desa;
use App\Traits\ToastAlert;
use Illuminate\Database\QueryException;
use Livewire\Component;

class Create extends Component
{
    use ToastAlert;

    protected $listeners = ['createDesa'];

    public $title = 'Tambah Desa';
    public $show_form = false;

    public $nama;
    public $alamat;

    public function render()
    {
        return view('livewire.desa.create');
    }

    protected array $rules = [
        'nama' => 'required',
        'alamat' => 'required'
    ];

    public function createDesa()
    {
        $this->show_form = true;
        $this->modalShow();
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            Desa::create($data);
        }catch (QueryException|\Exception $e){
            $this->errorAlert('Menambahkan data gagal! '. $e->getMessage());
            return false;
        }

        $this->successAlert('Menambahkan data berhasil!');
        $this->emit('updateDesaTable');
        $this->resetForm();
        $this->modalClose();
    }

    private function resetForm()
    {
        $this->reset([
            'nama',
            'alamat',
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
