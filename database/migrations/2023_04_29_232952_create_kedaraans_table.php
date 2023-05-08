<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained();
            $table->string('nama_kendaraan')->nullable();
            $table->string('warna_kendaraan')->nullable();
            $table->string('plat_nomor')->nullable();
            $table->string('nomor_mesin')->nullable();
            $table->string('nomor_rangka')->nullable();
            $table->date('tgl_pajak')->nullable();
            $table->date('tgl_ganti_plat')->nullable();
            $table->string('nama_pengguna')->nullable();
            $table->string('nik_pengguna')->nullable();
            $table->string('telp_pengguna')->nullable();
            $table->text('alamat_pengguna')->nullable();
            $table->text('foto_stnk')->nullable();
            $table->text('foto_ktp')->nullable();
            $table->date('tgl_update_stnk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraans');
    }
};
