<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // perlihatkan page notification
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::user()->id)->latest()->get();

        if (Auth::user()->role == 'admin') {
            return view('admin.notification.index', compact('notifications'));
        } else {
            return view('customer.notification.index', compact('notifications'));
        }
    }

    public function destroy($id)
    {
        $notif = Notification::find($id);
        $notif->delete();
        return redirect()->back()->with('toast', [
            'status' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Notifikasi berhasil dihapus.',
        ]);
    }
}
