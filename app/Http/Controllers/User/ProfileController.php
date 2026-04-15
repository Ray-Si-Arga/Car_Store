<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Update technical information for accountability.
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            'nama_orang_terdekat' => 'required|string|max:255',
            'alamat_orang_terdekat' => 'required|string',
            'no_telepon_terdekat' => 'required|string|max:20',
            'foto_rumah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $user = Auth::user();

            // Handle File Uploads
            if ($request->hasFile('foto_rumah')) {
                // Delete old file if exists
                if ($user->foto_rumah) {
                    Storage::disk('public')->delete($user->foto_rumah);
                }
                $user->foto_rumah = $request->file('foto_rumah')->store('user_accountability/foto_rumah', 'public');
            }

            if ($request->hasFile('ktp')) {
                // Delete old file if exists
                if ($user->ktp) {
                    Storage::disk('public')->delete($user->ktp);
                }
                $user->ktp = $request->file('ktp')->store('user_accountability/ktp', 'public');
            }

            $user->nama_orang_terdekat = $request->nama_orang_terdekat;
            $user->alamat_orang_terdekat = $request->alamat_orang_terdekat;
            $user->no_telepon_terdekat = $request->no_telepon_terdekat;

            /** @var \App\Models\User $user */
            $user->save();

            return redirect()->back()->with('success', 'Informasi pertanggungjawaban berhasil diperbarui. Selamat datang di layanan kami!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
}
