<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        $cars = Car::with('images')->where('status', 'tersedia')->get();
        return view('landing_page.car', compact('cars'));
    }
}
