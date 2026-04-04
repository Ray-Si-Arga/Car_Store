<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'customer_id',
        'car_id',
        'no_telepon',
        'lokasi_customer',
        'tanggal_mulai',
        'tanggal_kembali',
        'durasi_hari',
        'total_harga',
        'bukti_bayar',
        'status',
        'catatan',
        'alasan_tolak',
    ];

    // Relasi ke Customer (User)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relasi ke Mobil
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
