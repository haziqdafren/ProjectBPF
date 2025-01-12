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
        Schema::table('lacak_paket', function (Blueprint $table) {
            $table->unsignedBigInteger('ekspedisi_id')->change(); // Ubah tipe data sesuai kebutuhan
        });
    }

    public function down()
    {
        Schema::table('lacak_paket', function (Blueprint $table) {
            $table->integer('ekspedisi_id')->change(); // Kembalikan ke tipe data sebelumnya jika perlu
        });
    }
};
