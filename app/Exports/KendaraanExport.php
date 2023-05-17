<?php

namespace App\Exports;

use App\Models\Kendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class KendaraanExport implements FromCollection, WithHeadings, withEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kendaraan::query()
            ->join('desas', 'desas.id', '=','kendaraans.desa_id')
            ->select(
                ['nama_kendaraan',
                'plat_nomor',
                'nomor_mesin',
                'nomor_rangka',
                'warna_kendaraan',
                'tgl_pajak',
                'tgl_ganti_plat',
                'nama_pengguna',
                'nama',
                'nik_pengguna',
                'telp_pengguna',
                'alamat_pengguna']
            )
            ->when(auth()->user()->hasRole('desa'),
                fn ($q) => $q->where('desa_id', auth()->user()->desa_id)->where('desa_id', auth()->user()->desa_id)
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Kendaraan',
            'Nomor Kendaraan',
            'Nomor Mesin',
            'Nomor Rangka',
            'Warna Kendaraan',
            'Tanggal Pajak',
            'Tanggal Ganti Plat',
            'Nama Pengguna',
            'Asal Desa/Kelurahan',
            'NIK Pengguna',
            'Nomor Telepon Pengguna',
            'Alamat Pengguna'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:L1')
                    ->getFont()
                    ->setBold(true);

            },
        ];
    }
}
