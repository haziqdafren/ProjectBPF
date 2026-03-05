<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Only insert if user doesn't exist
        $exists = DB::table('users')->where('email', 'admin@softui.com')->exists();

        if (!$exists) {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@softui.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
