<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaket extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======

    // Specify the table name if it does not follow Laravel's naming conventions
>>>>>>> bec937a998c5f48ffe82336305fe73ec1c21d77e
    protected $table = 'data_pakets';

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'no_resi', // Assuming this is the correct column name for the tracking number
        'produk', // Product or package details
        'pemilik', // Owner of the package
        'ekspedisi', // Shipping or courier company
        'tgl_tiba', // Arrival date of the package
    ];
<<<<<<< HEAD
=======

    // Optionally, define any other properties or relationships if needed in the future
>>>>>>> bec937a998c5f48ffe82336305fe73ec1c21d77e
}
