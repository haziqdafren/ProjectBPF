<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaket extends Model
{
    use HasFactory;

    protected $table = 'data_paket';

    protected $primaryKey = 'no_resi';

    public $incrementing = false;

    protected $fillable = [
        'no_resi',
        'nama_produk',
        'nama_ekspedisi',
        'no_hpPenerima',
        'tgl_tiba',
        'lokasi',
        'status',
        'nama_pemilik', // Tambahkan kolom nama pemilik
        'bukti_serah_terima', // Tambahkan kolom bukti serah terima
        'security_name', // Tambahkan kolom security_name
    ];

    public function histories()
    {
        return $this->hasMany(Histori::class, 'no_resi', 'no_resi');
    }

   // Define the relationship with the User model
       public function user()
       {
           return $this->belongsTo(User::class);
       }
}

