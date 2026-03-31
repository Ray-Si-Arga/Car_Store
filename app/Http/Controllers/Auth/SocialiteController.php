<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    // Mengarahkan user ke penyedia OAuth (Google)
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->stateless()->redirect();
    }

    // Mengembalikan user ke laravel setelah otentikasi dari penyedia OAuth (Google)
    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // 1. Cek user berdasarkan EMAIL
        $user = User::where('email', $googleUser->getEmail())->first();

        // 2. Kalau belum ada, buat user baru
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'email_verified_at' => now(),
            ]);
        }
        // 3. Kalau user sudah ada tapi belum terhubung ke Google
        else if (!$user->provider) {
            $user->update([
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
            ]);
        }

        Auth::login($user, true);

        // Mengecek role
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard')->with('toast' , [
                'status' => 'success',
                'title' => 'Selamat Datang, ' . $user->name . '!'
            ]);
        }

        return redirect()->intended('/customer/dashboard')->with('toast' , [
            'status' => 'success',
            'title' => 'Selamat Datang, ' . $user->name . '!'
        ]);

    }
}
