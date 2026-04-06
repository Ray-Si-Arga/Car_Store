<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        $TotalUser = User::count();
        $bookings = Booking::all();
        $cars = Car::all();

        // Data Grafik: Keuntungan & Sewa per Bulan (Tahun Berjalan)
        $monthlyData = Booking::where('status', 'selesai')
            ->whereYear('created_at', date('Y'))
            ->selectRaw('MONTH(created_at) as month, SUM(total_harga) as profit, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $profits = [];
        $counts = [];
        for ($m = 1; $m <= 12; $m++) {
            $profits[] = $monthlyData->has($m) ? (float) $monthlyData->get($m)->profit : 0;
            $counts[] = $monthlyData->has($m) ? (int) $monthlyData->get($m)->count : 0;
        }

        return view('admin.dashboard', compact('TotalUser', 'bookings', 'cars', 'profits', 'counts'));
    }

    // Menampilkan dashboard customer
    public function indexCustomer()
    {
        $activeBookings = Booking::with(['car.images'])
            ->where('customer_id', Auth::id())
            ->whereIn('status', ['disetujui', 'dibayar'])
            ->get()
            ->map(function ($booking) {
                $now = Carbon::now();
                $kembali = Carbon::parse($booking->tanggal_kembali);

                // 1. Cek apakah waktu sekarang sudah melewati batas kembali
                $is_overdue = $now->greaterThan($kembali);

                if ($is_overdue) {
                    // Hitung selisih jam secara total
                    $totalHoursOverdue = $now->diffInHours($kembali);

                    // Logika Denda: 
                    // Jika lewat 1 jam saja sudah kena denda 1 hari, gunakan ceil($totalHoursOverdue / 24)
                    // Atau jika ingin lebih presisi (misal: denda per hari):
                    $booking->overdue_days = ceil($totalHoursOverdue / 24);
                    if ($booking->overdue_days == 0)
                        $booking->overdue_days = 1; // Minimal denda 1 hari jika sudah lewat menit/jam
    
                    $booking->remaining_days = 0;
                } else {
                    $booking->overdue_days = 0;
                    // Sisa hari tetap gunakan diffInDays untuk tampilan "X Hari Lagi"
                    $booking->remaining_days = $now->diffInDays($kembali);
                }

                $booking->is_overdue = $is_overdue;
                $booking->fine = $booking->overdue_days * $booking->car->harga_biasa;

                return $booking;
            });

        return view('customer.dashboard', compact('activeBookings'));
    }
}
