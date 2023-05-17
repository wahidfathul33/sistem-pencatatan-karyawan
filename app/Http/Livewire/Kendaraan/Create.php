<?php

namespace App\Http\Livewire\Kendaraan;

use App\Models\Desa;
use App\Models\Kendaraan;
use App\Traits\ToastAlert;
use Couchbase\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    use ToastAlert;

    protected $listeners = ['createKendaraan'];

    public $title = 'Tambah Kendaraan';
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

    public function render()
    {
        $desas = Desa::query()->orderBy('nama')->get();

        return view('livewire.kendaraan.create', compact('desas'));
    }

    protected array $rules = [
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
        'foto_stnk' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ];

    public function createKendaraan()
    {
        $this->show_form = true;
        $this->desa_id = auth()->user()->hasRole('desa') ? auth()->user()->desa_id : null;

        $this->modalShow();
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            $data['foto_stnk'] = $this->foto_stnk->store(md5(microtime()), 'stnk');

            $kendaraan = Kendaraan::create($data);
            $kendaraan->update(['tgl_update_stnk' => now()]);
        }catch (QueryException|\Exception $e){
            $this->errorAlert('Menambahkan data gagal! '. $e->getMessage());
            return false;
        }

        $this->successAlert('Menambahkan data berhasil!');
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
            'foto_stnk'
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
