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
        Schema::table('data_paket', function (Blueprint $table) {
            $table->string('security_name')->nullable(); // Kolom untuk menyimpan nama security
        });
    }

    public function down()
    {
        Schema::table('data_paket', function (Blueprint $table) {
            $table->dropColumn('security_name'); // Menghapus kolom jika rollback
        });
    }
};
