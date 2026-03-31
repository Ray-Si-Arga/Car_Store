<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    // perlihatkan page notification
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.notification.index', compact('notifications'));
    }
}
