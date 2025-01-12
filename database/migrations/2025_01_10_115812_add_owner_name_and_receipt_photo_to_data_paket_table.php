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
            // Menambahkan kolom untuk nama pemilik paket
            $table->string('nama_pemilik')->nullable(); // Kolom ini bisa null jika tidak ada

            // Menambahkan kolom untuk bukti serah terima berupa foto
            $table->string('bukti_serah_terima')->nullable(); // Kolom ini juga bisa null
        });
    }

    public function down()
    {
        Schema::table('data_paket', function (Blueprint $table) {
            // Menghapus kolom jika rollback
            $table->dropColumn('nama_pemilik');
            $table->dropColumn('bukti_serah_terima');
        });
    }
};
