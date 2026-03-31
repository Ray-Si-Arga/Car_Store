<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Service\NotificationService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingUserController extends Controller
{
    // Halaman form booking
    public function create($car_id)
    {
        $car = Car::with('images')->findOrFail($car_id);

        return view('customer.booking.create', compact('car'));
    }

    // Simpan booking baru (status: pending)
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'no_telepon' => 'required|string|max:20',
            'lokasi_customer' => 'required|string|max:255',
            'tanggal_sewa' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'catatan' => 'nullable|string',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Hitung durasi dan total harga
        $tanggalSewa = Carbon::parse($request->tanggal_sewa);
        $tanggalKembali = Carbon::parse($request->tanggal_kembali);
        $durasi = $tanggalSewa->diffInDays($tanggalKembali);
        $totalHarga = $durasi * $car->harga_aktif;

        $booking = Booking::create([
            'customer_id' => Auth::id(),
            'car_id' => $car->id,
            'no_telepon' => $request->no_telepon,
            'lokasi_customer' => $request->lokasi_customer,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'durasi_hari' => $durasi,
            'total_harga' => $totalHarga,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);

        // TODO: Trigger notifikasi ke admin (Fase 3)
        $notifService = new NotificationService();
        $notifService->sendNotification(
            User::where('role', 'admin')->first()->id,

            route('admin.bookings.show', $booking->id),
            'Pesanan Baru',
            'Ada pesanan baru dari ' . Auth::user()->name,
            'sewa'
        );

        return redirect()->route('customer.bookings')->with('toast', [
            'status' => 'success',
            'title' => 'Pesanan Berhasil',
            'text' => 'Menunggu persetujuan admin.',
        ]);
    }

    // Halaman riwayat pesanan customer
    public function riwayat()
    {
        $bookings = Booking::where('customer_id', Auth::id())
            ->with('car.images')
            ->latest()
            ->get();

        return view('customer.booking.riwayat', compact('bookings'));
    }

    // Halaman upload bukti bayar
    public function formBayar($id)
    {
        $booking = Booking::where('customer_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'disetujui')
            ->firstOrFail();

        return view('customer.booking.bayar', compact('booking'));
    }

    // Simpan bukti bayar
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $booking = Booking::where('customer_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'disetujui')
            ->firstOrFail();

        // Simpan file bukti bayar
        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        $booking->update([
            'bukti_bayar' => $path,
            'status' => 'dibayar',
        ]);

        // TODO: Trigger notifikasi ke admin (Fase 3)
        $notifService = new NotificationService();
        $notifService->sendNotification(
            User::where('role', 'admin')->first()->id,

            route('admin.bookings.show', $booking->id),
            'Bukti Bayar Diterima',
            'Bukti bayar dari ' . Auth::user()->name,
            'sewa'
        );
        return redirect()->route('customer.bookings')->with('toast', [
            'status' => 'success',
            'title' => 'Bukti Bayar Terkirim',
            'text' => 'Terima kasih! Sewa Anda aktif.',
        ]);
    }
}
