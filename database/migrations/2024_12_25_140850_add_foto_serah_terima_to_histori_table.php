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
            $table->string('foto_serah_terima')->nullable(); // Menambahkan kolom foto serah terima
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('histori', function (Blueprint $table) {
            $table->dropColumn('foto_serah_terima'); // Menghapus kolom saat rollback
        });
    }
};
