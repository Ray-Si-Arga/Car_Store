<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalPricing extends Model
{
    protected $table = 'global_pricing';
    //
    protected $fillable = [
        'nama_event',
        'start_date',
        'end_date',
        'type',
        'value',
        'is_active',
    ];
}

// harga tidak berubah pada tampilan index mobil, perbaiki, untuk data harga global data masuk ke database