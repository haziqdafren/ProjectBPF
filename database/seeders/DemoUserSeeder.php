<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo user for portfolio showcase
        User::updateOrCreate(
            ['email' => 'demo@surpa.com'],
            [
                'name' => 'Demo User',
                'email' => 'demo@surpa.com',
                'password' => Hash::make('demo123'),
                'is_demo' => true, // Flag to identify demo account
            ]
        );

        $this->command->info('Demo user created successfully!');
        $this->command->info('Email: demo@surpa.com');
        $this->command->info('Password: demo123');
    }
}
