<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if demo user already exists
        $demoExists = DB::table('users')->where('email', 'demo@surpa.com')->exists();

        if (!$demoExists) {
            DB::table('users')->insert([
                'name' => 'Demo User',
                'email' => 'demo@surpa.com',
                'password' => Hash::make('demo123'),
                'is_demo' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            echo "Demo user created successfully!\n";
        } else {
            // Update existing demo user to ensure correct password
            DB::table('users')
                ->where('email', 'demo@surpa.com')
                ->update([
                    'password' => Hash::make('demo123'),
                    'is_demo' => true,
                    'updated_at' => now(),
                ]);

            echo "Demo user updated successfully!\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove demo user
        DB::table('users')->where('email', 'demo@surpa.com')->delete();
    }
};
