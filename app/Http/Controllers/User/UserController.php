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
        $users = User::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.user.index', compact('users'));
    }

    public function edit_aksi(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,customer',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('toast', [
            'type' => 'info',
            'title' => $user->name,
            'text' => 'Berhasil Di Edit'
        ]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return back()->with('toast', [
                'type' => 'error',
                'text' => 'Admin Tidak Boleh Menghapus Dirinya'
            ]);
        }

        $user->delete();

        return back()->with('toast', [
            'type' => 'success',
            'title' => $user->name ,
            'text' => 'Data Berhasil Dihapus'
        ]);
    }
}
