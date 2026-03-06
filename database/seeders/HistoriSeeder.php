<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Skip if data already exists
        if (DB::table('histori')->count() > 0) {
            return;
        }

        $historis = [
            [
                'no_resi' => 'JNE123456789001',
                'nama_produk' => 'Laptop Dell XPS 15',
                'ekspedisi_id' => 'JNE001',
                'no_hpPenerima' => '081234567890',
                'tgl_tiba' => Carbon::now()->subDays(2),
                'lokasi' => 'Pos Security',
                'status' => 'Sudah Diterima',
                'nama_pemilik' => 'Ahmad Rizki',
                'foto_serah_terima' => 'receipt_jne001.jpg',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'no_resi' => 'JNET987654321002',
                'nama_produk' => 'Smartphone Samsung Galaxy S23',
                'ekspedisi_id' => 'JNET001',
                'no_hpPenerima' => '082345678901',
                'tgl_tiba' => Carbon::now()->subDays(1),
                'lokasi' => 'Rumah Tangga',
                'status' => 'Sudah Diterima',
                'nama_pemilik' => 'Siti Nurhaliza',
                'foto_serah_terima' => 'receipt_jnet001.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'no_resi' => 'POS456789123003',
                'nama_produk' => 'Buku Programming Laravel',
                'ekspedisi_id' => 'POS001',
                'no_hpPenerima' => '083456789012',
                'tgl_tiba' => Carbon::now()->subDays(3),
                'lokasi' => 'Pos Security',
                'status' => 'Sudah Diterima',
                'nama_pemilik' => 'Dewi Lestari',
                'foto_serah_terima' => 'receipt_pos001.jpg',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'no_resi' => 'ANTERAJA147258369006',
                'nama_produk' => 'Kamera Canon EOS R5',
                'ekspedisi_id' => 'ANTERAJA001',
                'no_hpPenerima' => '086789012345',
                'tgl_tiba' => Carbon::now()->subDays(5),
                'lokasi' => 'Pos Security',
                'status' => 'Sudah Diterima',
                'nama_pemilik' => 'Fajar Hakim',
                'foto_serah_terima' => 'receipt_anteraja001.jpg',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2)
            ],
            [
                'no_resi' => 'POS111222333010',
                'nama_produk' => 'Keyboard Mechanical Logitech',
                'ekspedisi_id' => 'POS001',
                'no_hpPenerima' => '089012345678',
                'tgl_tiba' => Carbon::now()->subDays(6),
                'lokasi' => 'Rumah Tangga',
                'status' => 'Sudah Diterima',
                'nama_pemilik' => 'Rudi Hermawan',
                'foto_serah_terima' => 'receipt_pos002.jpg',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'no_resi' => 'SICEPAT444555666011',
                'nama_produk' => 'Monitor LG UltraWide 34 inch',
                'ekspedisi_id' => 'SICEPAT001',
                'no_hpPenerima' => '081122334455',
                'tgl_tiba' => Carbon::now()->subDays(2),
                'lokasi' => 'Pos Security',
                'status' => 'Sudah Diterima',
                'nama_pemilik' => 'Citra Dewi',
                'foto_serah_terima' => 'receipt_sicepat001.jpg',
                'created_at' => Carbon::now()->subHours(12),
                'updated_at' => Carbon::now()->subHours(12)
            ],
        ];

        DB::table('histori')->insert($historis);
    }
}
