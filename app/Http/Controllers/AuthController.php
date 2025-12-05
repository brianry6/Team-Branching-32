<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('register');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['Email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->withInput();
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:Customer,Email',
            'password' => 'required|min:6|confirmed', // password_confirmation required
        ]);

        Customer::create([
            'Email' => $request->email,
            'Password' => $request->password,
        ]);

        return redirect()->route('registration_success')->with('success', 'Account created! Please login.');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}