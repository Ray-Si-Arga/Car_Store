<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        $TotalUser = User::count();

        return view('admin.dashboard' , compact('TotalUser'));
    }
}
