<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;


    protected $table = 'histori';

    protected $primaryKey = 'id_histori';

    protected $fillable = [
        'no_resi',
        'nama_produk',
        'nama_ekspedisi',
        'no_hpPenerima',
        'tgl_tiba',
        'lokasi',
        'status',
    ];


}
