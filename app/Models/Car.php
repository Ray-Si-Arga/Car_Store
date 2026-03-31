<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GlobalPricing;
use Carbon\Carbon;

class Car extends Model
{
    protected $table = 'cars'; 

    protected $fillable = [
    'nama_mobil',
    'plat_nomor', 
    'kasta', 
    'harga_biasa', 
    'harga_weekend', 
    'status', 
    'deskripsi'];

    // Relasi ke foto
    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function getHargaAktifAttribute()
    {
        $hariIni = \Carbon\Carbon::now();

        // Tentukan harga dasar: Jika weekend pakai harga_weekend, jika tidak pakai harga_biasa
        // Jika harga_weekend kosong, fallback ke harga_biasa
        $isWeekend = $hariIni->isWeekend();
        $hargaDasar = ($isWeekend && $this->harga_weekend) ? $this->harga_weekend : $this->harga_biasa;

        // Cari Harga Global yang aktif hari ini
        $global = \App\Models\GlobalPricing::where('is_active', true)
            ->whereDate('start_date', '<=', $hariIni)
            ->whereDate('end_date', '>=', $hariIni)
            ->first();

        if ($global) {
            return ($global->type == 'percentage')
                ? $hargaDasar + ($hargaDasar * ($global->value / 100))
                : $hargaDasar + $global->value;
        }

        return $hargaDasar;
    }

    public function getEventAktifAttribute()
    {
        $hariIni = \Carbon\Carbon::now();

        return GlobalPricing::where('is_active', true)
            ->whereDate('start_date', '<=', $hariIni)
            ->whereDate('end_date', '>=', $hariIni)
            ->first();
    }
}
