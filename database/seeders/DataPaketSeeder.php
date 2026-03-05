<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataPaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Skip if data already exists
        if (DB::table('data_paket')->count() > 0) {
            return;
        }

        $dataPakets = [
            [
                'no_resi' => 'JNE123456789001',
                'nama_produk' => 'Laptop Dell XPS 15',
                'ekspedisi_id' => 'JNE001',
                'no_hpPenerima' => '081234567890',
                'tgl_tiba' => Carbon::now()->subDays(2),
                'lokasi' => 'Pos Security',
                'status' => 'Belum Diterima',
                'nama_pemilik' => 'Ahmad Rizki',
                'bukti_serah_terima' => null,
                'security_name' => 'Budi Santoso',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2)
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
                'bukti_serah_terima' => 'receipt_1234.jpg',
                'security_name' => 'Agus Wijaya',
                'created_at' => Carbon::now()->subDays(1),
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
                'bukti_serah_terima' => 'receipt_5678.jpg',
                'security_name' => 'Budi Santoso',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'no_resi' => 'SICEPAT789456123004',
                'nama_produk' => 'Headphone Sony WH-1000XM5',
                'ekspedisi_id' => 'SICEPAT001',
                'no_hpPenerima' => '084567890123',
                'tgl_tiba' => Carbon::now(),
                'lokasi' => 'Pos Security',
                'status' => 'Belum Diterima',
                'nama_pemilik' => 'Andi Pratama',
                'bukti_serah_terima' => null,
                'security_name' => 'Agus Wijaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'no_resi' => 'NINJA321654987005',
                'nama_produk' => 'Sepatu Nike Air Jordan',
                'ekspedisi_id' => 'NINJA001',
                'no_hpPenerima' => '085678901234',
                'tgl_tiba' => Carbon::now()->subDays(4),
                'lokasi' => 'Rumah Tangga',
                'status' => 'Belum Diterima',
                'nama_pemilik' => 'Rina Kusuma',
                'bukti_serah_terima' => null,
                'security_name' => 'Budi Santoso',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4)
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
                'bukti_serah_terima' => 'receipt_9012.jpg',
                'security_name' => 'Agus Wijaya',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(2)
            ],
            [
                'no_resi' => 'JNE555666777008',
                'nama_produk' => 'Smartwatch Apple Watch Series 9',
                'ekspedisi_id' => 'JNE001',
                'no_hpPenerima' => '087890123456',
                'tgl_tiba' => Carbon::now()->subDays(1),
                'lokasi' => 'Rumah Tangga',
                'status' => 'Belum Diterima',
                'nama_pemilik' => 'Maya Indah',
                'bukti_serah_terima' => null,
                'security_name' => 'Budi Santoso',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'no_resi' => 'JNET888999000009',
                'nama_produk' => 'Tablet iPad Pro 12.9',
                'ekspedisi_id' => 'JNET001',
                'no_hpPenerima' => '088901234567',
                'tgl_tiba' => Carbon::now(),
                'lokasi' => 'Pos Security',
                'status' => 'Belum Diterima',
                'nama_pemilik' => 'Irfan Setiawan',
                'bukti_serah_terima' => null,
                'security_name' => 'Agus Wijaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
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
                'bukti_serah_terima' => 'receipt_3456.jpg',
                'security_name' => 'Budi Santoso',
                'created_at' => Carbon::now()->subDays(6),
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
                'bukti_serah_terima' => 'receipt_7890.jpg',
                'security_name' => 'Agus Wijaya',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subHours(12)
            ],
        ];

        DB::table('data_paket')->insert($dataPakets);
    }
}
