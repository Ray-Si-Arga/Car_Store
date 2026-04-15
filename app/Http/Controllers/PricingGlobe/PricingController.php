<?php

namespace App\Http\Controllers\PricingGlobe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GlobalPricing;

class PricingController extends Controller
{
    // Fungsi harga global
    public function pricing_globe(Request $request)
    {
        $value = str_replace('.', '', $request->value);
        $type = $request->type;

        // Validasi: Cek apakah ada harga mobil yang menjadi di bawah 100rb atau minus
        $cars = \App\Models\Car::all();
        foreach ($cars as $car) {
            $hargaBiasa = $car->harga_biasa;
            $hargaWeekend = $car->harga_weekend ?? $car->harga_biasa;

            if ($type == 'percentage') {
                $finalBiasa = $hargaBiasa - ($hargaBiasa * ($value / 100));
                $finalWeekend = $hargaWeekend - ($hargaWeekend * ($value / 100));
            } else {
                $finalBiasa = $hargaBiasa - $value;
                $finalWeekend = $hargaWeekend - $value;
            }

            if ($finalBiasa < 100000 || $finalWeekend < 100000) {
                return redirect()->back()->with('toast', [
                    'status' => 'error',
                    'title' => 'Gagal Mengaktifkan!',
                    'text' => "Mobil '{$car->nama_mobil}' akan memiliki harga di bawah Rp 100.000. Silakan ganti nominal/persentase lain.",
                ]);
            }
        }

        GlobalPricing::create([
            'nama_event' => $request->nama_event,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'value' => $value,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->back()->with('toast', [
            'status' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Harga Musim Telah Aktif',
        ]);
    }

    public function destroy_price($id)
    {
        $pricing = GlobalPricing::findOrFail($id);
        $pricing->delete();

        return redirect()->back()->with('toast', [
            'status' => 'success',
            'title' => 'Dihapus!',
            'text' => 'Harga telah kembali normal',
        ]);
    }
}
