<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{

    protected $table = 'cars_images';
    //
    protected $fillable = [
        'car_id',
        'file_path',
        'is_primary',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

}
