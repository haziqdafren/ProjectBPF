<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LacakPaket extends Model
{
    use HasFactory;

    protected $table = 'lacak_paket';

    protected $primaryKey = 'id_lacak';

    protected $fillable = [
        'no_resi',
        'nama_produk',
        'nama_ekspedisi',
        'tgl_tiba',
        'lokasi',
        'status',
        'nama_pemilik', // Tambahkan kolom nama pemilik
    ];

    public function dataPaket()
    {
        return $this->belongsTo(DataPaket::class, 'no_resi', 'no_resi');
    }
}
