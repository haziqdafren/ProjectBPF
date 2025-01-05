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
            $table->id('id_lacak'); // Primary key
            $table->string('no_resi'); // Define no_resi as a string
            $table->string('nama_produk');
            $table->enum('nama_ekspedisi', ['JNE', 'Tiki', 'Pos Indonesia', 'Gojek', 'Grab']);
            $table->date('tgl_tiba');
            $table->enum('lokasi', ['Pos Security', 'Rumah Tangga']);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('no_resi')->references('no_resi')->on('data_paket')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lacak_paket');
    }
};
