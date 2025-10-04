<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.auth.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Rate limiting
        $key = 'login-attempts:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'username' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        // Attempt authentication with username or email
        $credentials = $request->only('username', 'password');
        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $user = User::where($loginField, $request->username)->first();

        if ($user && Hash::check($request->password, $user->password) && $user->isAdmin()) {
            Auth::login($user, $request->filled('remember'));
            RateLimiter::clear($key);
            
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back, ' . $user->name . '!');
        }

        RateLimiter::hit($key, 300); // 5 minutes lockout

        throw ValidationException::withMessages([
            'username' => 'Invalid credentials or insufficient privileges.',
        ]);
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
