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
        Schema::create('lacak_paket', function (Blueprint $table) {
            $table->id('id_lacak');
            $table->foreignId('no_resi')->constrained('data_paket', 'no_resi')->onDelete('cascade'); // Pastikan kolom yang dirujuk benar
            $table->string('nama_produk');
            $table->enum('nama_ekspedisi', ['JNE', 'Tiki', 'Pos Indonesia', 'Gojek', 'Grab']);
            $table->date('tgl_tiba');
            $table->enum('lokasi', ['Pos Security', 'Rumah Tangga']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lacak_paket');
    }
};
