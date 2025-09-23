<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    // --- WEB AUTHENTICATION METHODS ---

    /**
     * Show the registration form.
     */
    public function createRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request from the web.
     */
    public function storeRegister(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    /**
     * Show the login form.
     */
    public function createLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request from the web.
     */
    public function storeLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (auth()->user()->is_admin) {
                // If they are, redirect to the admin dashboard route
                return redirect()->intended(route('admin.dashboard'));
            }
            $request->session()->regenerate();
            return redirect()->intended('/'); // Redirect to home or intended page
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session (logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}