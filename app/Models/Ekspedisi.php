<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $table = 'ekspedisi';

    protected $primaryKey = 'Id_ekpedisi';

    public $incrementing = false;  // Jika primary key bukan auto increment

    protected $keyType = 'string';  // Jika tipe primary key adalah string

    protected $fillable = [
        'Id_ekpedisi',
        'nama_ekspedisi',
        'kontak',
    ];

    // One Ekspedisi has many DataPaket
    public function dataPakets()
    {
        return $this->hasMany(DataPaket::class, 'ekspedisi_id', 'Id_ekpedisi');
    }

    // One Ekspedisi has many Histori
    public function historis()
    {
        return $this->hasMany(Histori::class, 'ekspedisi_id', 'Id_ekpedisi');
    }

    // One Ekspedisi has many LacakPaket
    public function lacakPakets()
    {
        return $this->hasMany(LacakPaket::class, 'ekspedisi_id', 'Id_ekpedisi');
    }

}

