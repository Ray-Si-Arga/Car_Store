<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // proteksi tabel
    protected $table = 'notifications';

    // Proteksi kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'link',
        'title',
        'message',
        'is_read',
        'category',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
