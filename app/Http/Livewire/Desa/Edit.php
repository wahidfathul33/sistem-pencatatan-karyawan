<?php

namespace App\Http\Livewire\Desa;

use App\Models\Desa;
use App\Traits\ToastAlert;
use Illuminate\Database\QueryException;
use Livewire\Component;

class Edit extends Component
{
    use ToastAlert;

    protected $listeners = ['editDesa'];

    public $title = 'Edit Desa';
    public $nama;
    public $alamat;
    public $data;

    public function render()
    {
        return view('livewire.desa.edit');
    }

    protected function rules()
    {
        return [
            'nama' => 'required',
            'alamat' => 'required'
        ];
    }

    public function editDesa($data)
    {
        $this->data = Desa::find($data['desa_id']);

        $this->nama = $this->data->nama;
        $this->alamat = $this->data->alamat;

        $this->modalShow();
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            $this->data->update($data);
        }catch (QueryException|\Exception $e){
            $this->errorAlert('Mengubah data Desa gagal! '. $e->getMessage());
            return false;
        }

        $this->successAlert('Mengubah data Desa berhasil!');
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
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function modalClose()
    {
        $this->resetForm();
        $this->resetValidation();

        $this->dispatchBrowserEvent('close-modal');
    }
}
