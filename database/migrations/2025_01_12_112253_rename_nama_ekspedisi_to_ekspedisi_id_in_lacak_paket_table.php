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
            $table->renameColumn('nama_ekspedisi', 'ekspedisi_id');
        });
    }

    public function down()
    {
        Schema::table('lacak_paket', function (Blueprint $table) {
            $table->renameColumn('ekspedisi_id', 'nama_ekspedisi');
        });
    }
};
