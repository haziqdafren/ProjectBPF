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
        Schema::table('data_paket', function (Blueprint $table) {
            // Mengubah nama kolom dari nama_ekspedisi menjadi ekspedisi_id
            $table->renameColumn('nama_ekspedisi', 'ekspedisi_id');
        });
    }

    public function down()
    {
        Schema::table('data_paket', function (Blueprint $table) {
            // Mengembalikan nama kolom dari ekspedisi_id menjadi nama_ekspedisi
            $table->renameColumn('ekspedisi_id', 'nama_ekspedisi');
        });
    }  
};
