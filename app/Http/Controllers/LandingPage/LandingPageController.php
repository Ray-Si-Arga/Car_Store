<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Car::with([
            'images' => function ($q) {
                $q->where('is_primary', true);
            }
        ]);

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

        return view('landing_page.car', compact('cars'));
    }
}
