<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Events\AdminNotification;

// event(new AdminNotification("User baru bergabung: " . $user->name, "info"));

class UserController extends Controller
{
    // Menampilkan page user
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.user.index', compact('users'));
    }

    public function edit_aksi(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,customer',
        ]);

        $user = User::findOrFail($id);
        $user -> update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return back()->with('success', 'User Berhasil Di Edit');

    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Admin Tidak Boleh Menghapus Dirinya');
        }

        $user->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
