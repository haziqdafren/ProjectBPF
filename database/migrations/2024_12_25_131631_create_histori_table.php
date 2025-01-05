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
            $table->id();
            $table->string('no_resi'); // Ensure this matches the type in data_paket
            $table->string('nama_produk');
            $table->string('nama_ekspedisi');
            $table->string('no_hpPenerima');
            $table->date('tgl_tiba');
            $table->string('lokasi');
            $table->enum('status', ['Sudah Diterima', 'Belum Diterima']);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('no_resi')->references('no_resi')->on('data_paket')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('histori');
    }
}
;
