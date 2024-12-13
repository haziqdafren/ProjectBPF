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
            $table->enum('ekspedisi',['ekpedisi1','ekpedisi2','ekpedisi3','ekpedisi4']);
            $table->date('tanggal_tiba')->nullable();
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
