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
            $table->id('no_resi'); // Primary key
            $table->string('produk');
            $table->string('pemilik');
            $table->enum('ekspedisi',['ekspedisi1','ekspedisi2','ekspedisi3','ekspedisi4']);
            $table->date('tanggal_tiba')->nullable();
            $table->timestamps(); // Created at and updated at timestamps
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
