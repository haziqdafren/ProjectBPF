<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure all ekspedisi_id columns are VARCHAR to match ekspedisi.Id_ekpedisi
        // This fixes any previous migration issues

        // Fix data_paket.ekspedisi_id if it's not already VARCHAR
        DB::statement('ALTER TABLE data_paket ALTER COLUMN ekspedisi_id TYPE VARCHAR(255)');

        // Fix histori.ekspedisi_id if it's not already VARCHAR
        DB::statement('ALTER TABLE histori ALTER COLUMN ekspedisi_id TYPE VARCHAR(255)');

        // Fix lacak_paket.ekspedisi_id if it's not already VARCHAR
        DB::statement('ALTER TABLE lacak_paket ALTER COLUMN ekspedisi_id TYPE VARCHAR(255)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to revert, VARCHAR is the correct type
    }
};
