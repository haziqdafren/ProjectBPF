<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ekspedisis = [
            [
                'Id_ekpedisi' => 'JNE001',
                'nama_ekspedisi' => 'JNE Express',
                'kontak' => '021-5081111',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Id_ekpedisi' => 'JNET001',
                'nama_ekspedisi' => 'J&T Express',
                'kontak' => '021-80821000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Id_ekpedisi' => 'POS001',
                'nama_ekspedisi' => 'POS Indonesia',
                'kontak' => '1500161',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Id_ekpedisi' => 'SICEPAT001',
                'nama_ekspedisi' => 'SiCepat Express',
                'kontak' => '021-50206000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Id_ekpedisi' => 'NINJA001',
                'nama_ekspedisi' => 'Ninja Xpress',
                'kontak' => '021-80666888',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Id_ekpedisi' => 'ANTERAJA001',
                'nama_ekspedisi' => 'AnterAja',
                'kontak' => '021-50591999',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('ekspedisi')->insert($ekspedisis);
    }
}
