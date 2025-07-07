<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function login_action(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        $emailCheck = User::where("email", $request->input('email'))->first();
        if (!$emailCheck) {
            return back()->withErrors([
                'email' => 'Email Tidak ditemukan',
            ])->onlyInput('email');
        }

        $remember = $request->has('remember_me') && $request->remember_me === 'true';
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect(route('user.dashboard'))->with('message', 'Login berhasil');
        }

        return back()->withErrors([
            'password' => 'Password salah.',
        ]);

    }

    public function register_action(Request $request){
        $valid = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = User::create([
                'name' => $valid['name'],
                'email' => $valid['email'],
                'password' => Hash::make($valid['password'])
            ]);
            // event(new Registered($user));
            auth()->login($user);
            return redirect(route('user.dashboard'))->with('message', 'Register Success');
        } catch (\Throwable $th) {
            return back()->with('error', 'Some Errors, please try again');
        }

    }

    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Hapus sesi untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login atau halaman lain sesuai keinginan
        return redirect('/login')->with('message', 'Logout berhasil');
    }
}
