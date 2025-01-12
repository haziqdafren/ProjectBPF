<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;


    protected $table = 'histori';

    protected $primaryKey = 'id';

    protected $fillable = [
        'no_resi',
        'nama_produk',
        'nama_ekspedisi',
        'no_hpPenerima',
        'tgl_tiba',
        'lokasi',
        'status',
        'nama_pemilik', // Tambahkan kolom nama pemilik
    ];

    public function dataPaket()
    {
        return $this->belongsTo(DataPaket::class, 'no_resi', 'no_resi'); // Pastikan kolom yang digunakan untuk relasi benar
    }


}
