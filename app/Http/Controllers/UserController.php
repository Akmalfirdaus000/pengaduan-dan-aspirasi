<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request){
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function profile_change_name(Request $request){
        $valid = $request->validate([
            'name' => 'required|string',
        ]);

        try {
            Auth::user()->update([
                'name' => $valid['name'],
            ]);
    
            return back()->with('message', 'Password berhasil diperbarui');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan, Coba beberapa saat lagi');
        }
    }

    public function profile_change_password(Request $request){
        $valid = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);

        if (Hash::check($valid['old_password'], Auth::user()->password)) {
            // Update password baru
            Auth::user()->update([
                'password' => Hash::make($valid['new_password']),
            ]);
    
            return back()->with('message', 'Password berhasil diperbarui');
        } else {
            // Jika password lama salah
            return back()->with('error', 'Password lama Anda salah');
        }

    }
}
