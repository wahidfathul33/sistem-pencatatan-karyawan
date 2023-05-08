<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Desa::create([
            'nama' => 'Padarangin',
            'alamat' => 'Geneng, Padarangin, Kec. Slogoimo, Kab. Wonogiri'
        ]);

        Desa::create([
            'nama' => 'Watusomo',
            'alamat' => 'Watusomo, Kec. Slogoimo, Kab. Wonogiri'
        ]);
    }
}
