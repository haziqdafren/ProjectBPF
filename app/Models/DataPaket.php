<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaket extends Model
{
    use HasFactory;
    protected $table = 'data_pakets';

    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'no_resi',
        'produk',
        'pemilik',
        'ekspedisi',
        'tanggal_tiba',
    ];
}
