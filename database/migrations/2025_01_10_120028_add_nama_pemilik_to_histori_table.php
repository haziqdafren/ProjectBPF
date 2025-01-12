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
        Schema::table('histori', function (Blueprint $table) {
            // Menambahkan kolom untuk nama pemilik
            $table->string('nama_pemilik')->nullable(); // Kolom ini bisa null jika tidak ada
        });
    }

    public function down()
    {
        Schema::table('histori', function (Blueprint $table) {
            // Menghapus kolom jika rollback
            $table->dropColumn('nama_pemilik');
        });
    }
};
