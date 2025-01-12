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
        Schema::create('ekspedisi', function (Blueprint $table) {
            $table->string('Id_ekpedisi')->primary(); // Pastikan ini adalah primary key
            $table->string('nama_ekspedisi');
            $table->string('kontak');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ekspedisi');
    }
};
