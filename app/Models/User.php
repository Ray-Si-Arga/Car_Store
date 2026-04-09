<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'avatar',
        'nama_orang_terdekat',
        'alamat_orang_terdekat',
        'no_telepon_terdekat',
        'foto_rumah',
        'ktp',
        'provider',
        'provider_id',
        'google_id',
        'google_token',
        'google_refresh_token',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id')->latest()->get();
    }

    /**
     * Check if user has completed their accountability information.
     */
    public function isProfileComplete(): bool
    {
        return !empty($this->nama_orang_terdekat) &&
               !empty($this->alamat_orang_terdekat) &&
               !empty($this->no_telepon_terdekat) &&
               !empty($this->foto_rumah) &&
               !empty($this->ktp);
    }
}
