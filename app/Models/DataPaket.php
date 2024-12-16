<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaket extends Model
{
    use HasFactory;
    protected $table = 'data_pakets';

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'no_resi',  // Nomor resi
        'produk',   // Produk atau detail paket
        'pemilik',  // Pemilik paket
        'ekspedisi',// Ekspedisi pengiriman
        'tgl_tiba', // Tanggal tiba paket
        'lokasi',   // Lokasi pengiriman
    ];
}
