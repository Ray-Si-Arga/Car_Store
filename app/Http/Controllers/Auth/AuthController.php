<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mengarahkan Ke View login
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function login_aksi(Request $request)
    {
        // Validasi input yang ada pada form login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');

        //  mencoba login dengan data yang sudah diisi oleh user pada form login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Mengecek role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with(
                    'toast',
                    [
                        'status' => 'success',
                        'title' => $user->name . ' ' . $user->role,
                        'text' => 'Selamat Datang ' 
                    ]
                );
            }

            return redirect()->intended('/customer/dashboard')->with(
                'toast',
                [
                    'status' => 'success',
                    'title' => $user->name,
                    'text' => 'Selamat Datang',
                ]
            );

        } else {
            return back()->withErrors([
                'email' => 'Email salah',
                'password' => 'Password salah',
            ]);
        }

    }

    // menampilkan halaman registrasi
    public function registrasi()
    {
        return view('auth.registrasi');
    }

    public function registrasi_aksi(Request $request)
    {
        // Validasi atau mengecek
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ], [
            'email.unique' => 'Email sudah terdaftar, mohon pakai email yang lain'
        ]);

        // Mengambil data dari form registrasi dan menyimpannya ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/login')->with('toast', [
            'status' => 'info',
            'title' => 'Pendaftaran berhasil',
            'text' => 'Silahkan login',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('toast', [
            'status' => 'info',
            'title' => 'Anda Berhasil Logout'
        ]);
    }
}
