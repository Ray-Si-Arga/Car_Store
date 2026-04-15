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

    public function index(Request $request)
    {
        $query = Car::with([
            'images' => function ($q) {
                $q->where('is_primary', true);
            }
        ]);

        if (!$request->has('harga')) {
            $query->latest();
        }

        // Filter by Kasta
        if ($request->has('kasta') && $request->kasta != '') {
            $query->where('kasta', $request->kasta);
        }

        // Filter by Transmisi
        if ($request->has('transmisi') && $request->transmisi != '') {
            $query->where('transmisi', $request->transmisi);
        }

        $cars = $query->get();

        // Sort by Harga (Since harga_aktif is an accessor, sort the collection)
        if ($request->has('harga') && $request->harga != '') {
            if ($request->harga == 'low') {
                $cars = $cars->sortBy('harga_aktif');
            } elseif ($request->harga == 'high') {
                $cars = $cars->sortByDesc('harga_aktif');
            }
        }

        // Paginasi
        $perPage = 8;
        $currentPage = (int) ($request->input('page', 1));

        $offset = ($currentPage - 1) * $perPage;
        $currentItems = $cars->slice($offset, $perPage)->values();

        $cars = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $cars->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $globalPricings = GlobalPricing::all();

        if (Auth()->user()->role == 'admin') {
            return view('admin.car.index', compact('cars', 'globalPricings'));
        } else {
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
            'penumpang' => $request->penumpang,
            'transmisi' => $request->transmisi,
            'bahan_bakar' => $request->bahan_bakar,
            'stok' => $request->stok,
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

    // update mobil
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $car->update([
            'nama_mobil' => $request->nama_mobil,
            'plat_nomor' => $request->plat_nomor,
            'kasta' => $request->kasta,
            'harga_biasa' => $request->harga_biasa,
            'harga_weekend' => $request->harga_weekend ?? $request->harga_biasa,
            'status' => $request->status ?? $car->status,
            'penumpang' => $request->penumpang,
            'transmisi' => $request->transmisi,
            'bahan_bakar' => $request->bahan_bakar,
            'stok' => $request->stok,
        ]);

        return redirect()->back()->with('success', 'Data mobil berhasil diperbarui!');
    }

    // update stok mobil
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
