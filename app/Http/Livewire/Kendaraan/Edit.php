<?php

namespace App\Http\Livewire\Kendaraan;

use App\Models\Desa;
use App\Models\Kendaraan;
use App\Traits\ToastAlert;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    use ToastAlert;

    protected $listeners = ['editKendaraan'];

    public $title = 'Edit Kendaraan';
    public $show_form = false;
    public $desa_id;
    public $nama_kendaraan;
    public $warna_kendaraan;
    public $plat_nomor;
    public $nomor_mesin;
    public $nomor_rangka;
    public $tgl_pajak;
    public $tgl_ganti_plat;
    public $nama_pengguna;
    public $nik_pengguna;
    public $telp_pengguna;
    public $alamat_pengguna;
    public $foto_stnk;
    public $foto_ktp;
    public $data;

    public function render()
    {
        $desas = Desa::query()->orderBy('nama')->get();

        return view('livewire.kendaraan.edit', compact('desas'));
    }

    protected function rules()
    {
        return [
            'desa_id' => 'required',
            'nama_kendaraan' => 'required',
            'warna_kendaraan' => 'required',
            'plat_nomor' => 'required',
            'nomor_mesin' => 'required',
            'nomor_rangka' => 'required',
            'tgl_pajak' => 'required',
            'tgl_ganti_plat' => 'required',
            'nama_pengguna' => 'required',
            'nik_pengguna' => 'required',
            'telp_pengguna' => 'required',
            'alamat_pengguna' => 'required',
            'foto_stnk' => 'sometimes',
            'foto_ktp' => 'sometimes'
        ];
    }

    public function editKendaraan($data)
    {
        $this->show_form = true;
        $this->data = Kendaraan::find($data['kendaraan_id']);

        $this->desa_id = $this->data->desa_id;
        $this->nama_kendaraan = $this->data->nama_kendaraan;
        $this->warna_kendaraan = $this->data->warna_kendaraan;
        $this->plat_nomor = $this->data->plat_nomor;
        $this->nomor_mesin = $this->data->nomor_mesin;
        $this->nomor_rangka = $this->data->nomor_rangka;
        $this->tgl_pajak = $this->data->tgl_pajak;
        $this->tgl_ganti_plat = $this->data->tgl_ganti_plat;
        $this->nama_pengguna = $this->data->nama_pengguna;
        $this->nik_pengguna = $this->data->nik_pengguna;
        $this->telp_pengguna = $this->data->telp_pengguna;
        $this->alamat_pengguna = $this->data->alamat_pengguna;

        $this->modalShow();
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            if (!empty($data['foto_stnk'])){
                $data['foto_stnk'] = $this->foto_stnk->store(md5(microtime()), 'stnk');
                $data['tgl_update_stnk'] = now();
            }else{
                unset($data['foto_stnk']);
            }

            if (!empty($data['foto_ktp'])){
                $data['foto_ktp'] = $this->foto_ktp->store(md5(microtime()), 'ktp');
            }else{
                unset($data['foto_ktp']);
            }

            $this->data->update($data);
        }catch (QueryException|\Exception $e){
            $this->errorAlert('Mengubah data Kendaraan gagal! '. $e->getMessage());
            return false;
        }

        $this->successAlert('Mengubah data Kendaraan berhasil!');
        $this->emit('updateKendaraanTable');
        $this->resetForm();
        $this->modalClose();
    }

    private function resetForm()
    {
        $this->reset([
            'desa_id',
            'nama_kendaraan',
            'warna_kendaraan',
            'plat_nomor',
            'nomor_mesin',
            'nomor_rangka',
            'tgl_pajak',
            'tgl_ganti_plat',
            'nik_pengguna',
            'telp_pengguna',
            'alamat_pengguna',
            'foto_stnk',
            'foto_ktp'
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
