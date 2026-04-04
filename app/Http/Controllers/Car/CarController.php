<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\CarImage;
use App\Models\Car;
use App\Models\GlobalPricing;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function index()
    {
        $cars = Car::with([
            'images' => function ($q) {
                $q->where('is_primary', true);
            }
        ])->get();

        $globalPricings = GlobalPricing::all();

        if(Auth()->user()->role == 'admin'){
            return view('admin.car.index', compact('cars', 'globalPricings'));
        }else{
            return view('customer.car.index', compact('cars', 'globalPricings'));
        }
    }

    // tambah mobil
    public function store(Request $request)
    {
        // 1. Simpan Data Mobil
        $car = Car::create([
            'nama_mobil' => $request->nama_mobil,
            'plat_nomor' => $request->plat_nomor,
            'kasta' => $request->kasta,
            'harga_biasa' => $request->harga_biasa,
            'harga_weekend' => $request->harga_weekend ?? $request->harga_biasa, // Logika No. 1
            'status' => 'Tersedia',
            'deskripsi' => $request->deskripsi,
        ]);

        // 2. Simpan Foto (Maksimal 4)
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $foto) {
                $path = $foto->store('mobil', 'public'); // Simpan ke folder storage/app/public/mobil

                CarImage::create([
                    'car_id' => $car->id,
                    'file_path' => $path,
                    'is_primary' => ($index === 0) ? true : false, // Foto pertama jadi sampul
                ]);
            }
        }

        return redirect()->back()->with('success', 'Mobil berhasil ditambahkan!');
    }

    // Hapus mobil beserta foto-fotonya di dalam database dan di file image public
    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        // Perulangan untuk menghapus gambar yang ada di database dan di file image public
        foreach ($car->images as $image) {
            if (Storage::disk('public')->exists($image->file_path)) {
                Storage::disk('public')->delete($image->file_path);
            }
        }

        $car->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');

    }
}
