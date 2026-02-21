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
        // Add indexes to improve query performance
        Schema::table('data_paket', function (Blueprint $table) {
            $table->index('ekspedisi_id'); // Speed up joins with ekspedisi table
            $table->index('lokasi'); // Speed up location-based queries
            $table->index('status'); // Speed up status filtering
            $table->index('tgl_tiba'); // Speed up date-based queries
            $table->index('nama_pemilik'); // Speed up owner name searches
        });

        Schema::table('histori', function (Blueprint $table) {
            $table->index('no_resi'); // Already has foreign key, but add explicit index
            $table->index('ekspedisi_id');
            $table->index('lokasi');
            $table->index('status');
            $table->index(['tgl_tiba', 'lokasi']); // Composite index for common queries
        });

        Schema::table('lacak_paket', function (Blueprint $table) {
            $table->index('no_resi');
            $table->index('ekspedisi_id');
            $table->index('lokasi');
            $table->index('nama_pemilik'); // Speed up tracking by owner name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_paket', function (Blueprint $table) {
            $table->dropIndex(['ekspedisi_id']);
            $table->dropIndex(['lokasi']);
            $table->dropIndex(['status']);
            $table->dropIndex(['tgl_tiba']);
            $table->dropIndex(['nama_pemilik']);
        });

        Schema::table('histori', function (Blueprint $table) {
            $table->dropIndex(['no_resi']);
            $table->dropIndex(['ekspedisi_id']);
            $table->dropIndex(['lokasi']);
            $table->dropIndex(['status']);
            $table->dropIndex(['tgl_tiba', 'lokasi']);
        });

        Schema::table('lacak_paket', function (Blueprint $table) {
            $table->dropIndex(['no_resi']);
            $table->dropIndex(['ekspedisi_id']);
            $table->dropIndex(['lokasi']);
            $table->dropIndex(['nama_pemilik']);
        });
    }
};
