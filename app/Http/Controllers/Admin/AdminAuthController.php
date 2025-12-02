<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\TblAdmin;

class AdminAuthController extends Controller
{
    /**
     * Display the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');

        // Use the 'admin' guard here
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $admin = Auth::guard('admin')->user();

            // Optional: Check for role or permission
            if ($admin->role_id !== 1) { // assuming 1 = admin
                Auth::guard('admin')->logout();
                return back()->with('error', 'Unauthorized access. Admin credentials required.');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Handle admin logout request.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('control.login');
    }
}
