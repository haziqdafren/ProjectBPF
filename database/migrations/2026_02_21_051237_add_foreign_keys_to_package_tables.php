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
        // Add foreign key constraint for data_paket -> ekspedisi
        Schema::table('data_paket', function (Blueprint $table) {
            $table->foreign('ekspedisi_id')
                  ->references('Id_ekpedisi')
                  ->on('ekspedisi')
                  ->onDelete('restrict') // Prevent deletion of expedition if packages exist
                  ->onUpdate('cascade'); // Update package if expedition ID changes
        });

        // Add foreign key constraint for histori -> ekspedisi
        Schema::table('histori', function (Blueprint $table) {
            $table->foreign('ekspedisi_id')
                  ->references('Id_ekpedisi')
                  ->on('ekspedisi')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });

        // Add foreign key constraint for lacak_paket -> ekspedisi
        Schema::table('lacak_paket', function (Blueprint $table) {
            $table->foreign('ekspedisi_id')
                  ->references('Id_ekpedisi')
                  ->on('ekspedisi')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_paket', function (Blueprint $table) {
            $table->dropForeign(['ekspedisi_id']);
        });

        Schema::table('histori', function (Blueprint $table) {
            $table->dropForeign(['ekspedisi_id']);
        });

        Schema::table('lacak_paket', function (Blueprint $table) {
            $table->dropForeign(['ekspedisi_id']);
        });
    }
};
