<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_paket', function (Blueprint $table) {
            $table->id('no_resi');
            $table->string('nama_produk');
            $table->enum('nama_ekspedisi', ['JNE', 'Tiki', 'Pos Indonesia', 'Gojek', 'Grab']);
            $table->string('no_hpPenerima');
            $table->date('tgl_tiba');
            $table->enum('lokasi', ['Pos Security', 'Rumah Tangga']);//security dan rumah tangga
            $table->enum('status', ['Sudah Diterima', 'Belum Diterima']);// sudah diterima dan belum diterima
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_paket');
    }
};
