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
        // Use raw SQL for PostgreSQL compatibility
        DB::statement('ALTER TABLE lacak_paket ALTER COLUMN ekspedisi_id TYPE BIGINT USING ekspedisi_id::bigint');
    }

    public function down()
    {
        // Use raw SQL for PostgreSQL compatibility
        DB::statement('ALTER TABLE lacak_paket ALTER COLUMN ekspedisi_id TYPE INTEGER USING ekspedisi_id::integer');
    }
};
