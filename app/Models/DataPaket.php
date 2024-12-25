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
        'no_resi', // Assuming this is the correct column name for the tracking number
        'produk', // Product or package details
        'pemilik', // Owner of the package
        'ekspedisi', // Shipping or courier company
        'tgl_tiba', // Arrival date of the package
    ];
}
