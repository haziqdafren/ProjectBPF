<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaket extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = 'data_pakets';

    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'no_resi',
        'produk',
        'pemilik',
        'ekspedisi',
        'tanggal_tiba',
    ];
=======
    
>>>>>>> bf8a7a6c211956420fb8ed0edf97fe8b6ccdb254
}
