<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_pakets', function (Blueprint $table) {
            $table->id('no_resi');
            $table->string('produk');
            $table->string('pemilik');
            $table->eloquent('ekspedisi');
            $table->date('tanggal_tiba')->nullable();
            $table->eloquent('lokasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pakets');
    }
};