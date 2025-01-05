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
            $table->id();
            $table->string('no_resi')->unique();
            $table->string('nama_produk');
            $table->string('no_hpPenerima');
            $table->string('nama_ekspedisi');
            $table->date('tgl_tiba');
            $table->string('lokasi');
            $table->enum('status', ['Sudah Diterima', 'Belum Diterima']);
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('data_paket');
    }
};
