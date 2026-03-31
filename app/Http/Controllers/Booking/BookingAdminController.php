<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Service\NotificationService;
use Illuminate\Support\Facades\Auth;

class BookingAdminController extends Controller
{
    // Daftar semua pesanan
    public function adminIndex(Request $request)
    {
        $query = Booking::with(['customer', 'car']);

        // Filter by status
        if ($request->has('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->get();

        return view('admin.booking.index', compact('bookings'));
    }

    // Detail pesanan
    public function adminShow($id)
    {
        $booking = Booking::with(['customer', 'car.images'])->findOrFail($id);

        return view('admin.booking.show', compact('booking'));
    }

    // Admin setujui pesanan
    public function approve($id)
    {
        $booking = Booking::where('status', 'pending')->findOrFail($id);

        $booking->update(['status' => 'disetujui']);

        // TODO: Trigger notifikasi ke customer (Fase 3)
        $notifService = new NotificationService();
        $notifService->sendNotification(
            $booking->customer_id,

            route('customer.bookings.show', $booking->id),
            'Pesanan Disetujui',
            'Pesanan disetujui oleh ' . Auth::user()->name,
            'sewa'
        );


        return redirect()->route('admin.bookings')->with('toast', [
            'status' => 'success',
            'title' => 'Pesanan Disetujui',
            'text' => 'Customer akan menerima notifikasi.',
        ]);
    }

    // Admin tolak pesanan
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_tolak' => 'required|string|max:500',
        ]);

        $booking = Booking::where('status', 'pending')->findOrFail($id);

        $booking->update([
            'status' => 'ditolak',
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        // TODO: Trigger notifikasi ke customer (Fase 3)
        $notifService = new NotificationService();
        $notifService->sendNotification(
            $booking->customer_id,

            route('customer.bookings.show', $booking->id),
            'Pesanan Ditolak',
            'Pesanan ditolak oleh ' . Auth::user()->name,
            'sewa'
        );


        return redirect()->route('admin.bookings')->with('toast', [
            'status' => 'info',
            'title' => 'Pesanan Ditolak',
            'text' => 'Customer akan menerima notifikasi.',
        ]);
    }

    // Admin tandai selesai
    public function selesai($id)
    {
        $booking = Booking::where('status', 'dibayar')->findOrFail($id);

        $booking->update(['status' => 'selesai']);

        return redirect()->route('admin.bookings')->with('toast', [
            'status' => 'success',
            'title' => 'Sewa Selesai',
            'text' => 'Mobil sudah dikembalikan.',
        ]);
    }
}
