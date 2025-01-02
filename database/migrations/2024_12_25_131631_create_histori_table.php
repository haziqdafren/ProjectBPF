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
        Schema::create('histori', function (Blueprint $table) {
            $table->id('id_histori');
            $table->foreignId('no_resi')->constrained('data_paket', 'no_resi')->onDelete('cascade'); // Pastikan kolom yang dirujuk benar
            $table->string('nama_produk');
            $table->enum('nama_ekspedisi', ['JNE', 'Tiki', 'Pos Indonesia', 'Gojek', 'Grab']);//diubah
            $table->string('no_hpPenerima');
            $table->date('tgl_tiba');
            $table->enum('lokasi', ['Kampus A', 'Kampus B', 'Kampus C']);//diubah
            $table->enum('status', ['Dikirim', 'Dalam Perjalanan', 'Sampai']);//diubah
            $table->string('foto_serah_terima')->nullable(); // Menambahkan kolom foto serah terima
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('histori');
    }
}
;
