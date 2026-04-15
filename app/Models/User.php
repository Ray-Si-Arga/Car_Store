<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\KirimGmail;

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

    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return asset('images/profile.webp');
        }

        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        return asset('storage/' . $this->avatar);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id')->latest()->get();
    }

    /**
     * Cek jika user belum memenuhi
     */
    public function isProfileComplete(): bool
    {
        return !empty($this->nama_orang_terdekat) &&
            !empty($this->alamat_orang_terdekat) &&
            !empty($this->no_telepon_terdekat) &&
            !empty($this->foto_rumah) &&
            !empty($this->ktp);
    }

    /**
     * Kirim Notifikasi via App (Database) dan Email (Gmail)
     */
    public function sendAppNotification($title, $message, $category = 'system', $link = '#')
    {
        // 1. Kirim Email via Gmail
        $this->notify(new KirimGmail($title, $message));

        // 2. Simpan ke database agar muncul di daftar notifikasi app
        return Notification::create([
            'user_id' => $this->id,
            'title' => $title,
            'message' => $message,
            'category' => $category,
            'link' => $link,
            'is_read' => false,
        ]);
    }
}
