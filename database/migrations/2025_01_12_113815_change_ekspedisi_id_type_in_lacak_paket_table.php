<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Change from ENUM to VARCHAR to match ekspedisi.Id_ekpedisi type
        // Skip for SQLite as it doesn't need this migration
        if (DB::connection()->getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE lacak_paket ALTER COLUMN ekspedisi_id TYPE VARCHAR(255)');
        }
    }

    public function down()
    {
        // Revert back to original type if needed
        // Note: Cannot easily revert to ENUM, so keeping as VARCHAR is acceptable
        DB::statement('ALTER TABLE lacak_paket ALTER COLUMN ekspedisi_id TYPE VARCHAR(255)');
    }
};
