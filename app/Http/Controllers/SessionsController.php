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
            return redirect('beranda')->with(['success' => 'You are logged in.']);
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }

    // Redirect to Google for authentication
    public function redirectToGoogle()
    {
        // Get the Google configuration from services.php
        $googleConfig = config('services.google');

        return Socialite::driver('google')
            ->scopes($googleConfig['scopes']) // Use the scopes from the config
            ->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['google' => 'Failed to login with Google.']);
        }

        // Check if $googleUser is null
        if (!$googleUser) {
            return redirect('/login')->withErrors(['google' => 'Failed to retrieve user information from Google.']);
        }

        // Check if the user already exists in your database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // If the user does not exist, create a new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(bin2hex(random_bytes(8))), // Generate a random password
            ]);
        }

        // Log the user in
        Auth::login($user, true);

        // Redirect to your desired location
        return redirect('beranda')->with(['success' => 'You are logged in with Google.']);
    }
}
