<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $table = 'ekspedisis';

    protected $primaryKey = 'Id_ekpedisi';

    public $incrementing = false;  // Jika primary key bukan auto increment
    
    protected $keyType = 'string';  // Jika tipe primary key adalah string

    protected $fillable = [
        'Id_ekpedisi',
        'nama_ekspedisi',
        'kontak',
    ];
}

