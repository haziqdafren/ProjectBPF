<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Laravel\Socialite\Facades\Socialite; // Import Socialite
use App\Models\User; // Import User model

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return redirect('beranda')->with(['success' => 'Sudah Masuk.']);
        } else {
            return back()->withErrors(['email' => 'Email dan password tidak sesuai.']);
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }

    // Masuk menggunakan Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['google' => 'Gagal login dengan Google.']);
        }

        // Check if $googleUser is null
        if (!$googleUser) {
            return redirect('/login')->withErrors(['google' => 'Gagal Mengambil data dari Google.']);
        }

        // Jika user sudah ada email google
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Jika user belum ada, buat user baru
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(bin2hex(random_bytes(8))), // Menghasilkan password acak
            ]);
        }

        // Masukkan user ke halaman login
        Auth::login($user, true);

        // Redirect to your desired location
        return redirect('beranda')->with(['success' => 'Sudah Berhasil Login Dengan Google.']);
    }
}
