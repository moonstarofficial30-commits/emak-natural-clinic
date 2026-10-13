<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Login by username (not email) — matches the "default username/password"
     * requirement, and how receptionists/admins will think of their account.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'username' => 'Taarifa za kuingia si sahihi. / The provided credentials are incorrect.',
            ]);
        }

        $request->session()->regenerate();

        if (! Auth::user()->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'username' => 'Akaunti yako imezimwa. Wasiliana na msimamizi. / Your account has been deactivated.',
            ]);
        }

        ActivityLog::log('login', null, Auth::user()->name.' logged in');

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        ActivityLog::log('logout', null, Auth::user()?->name.' logged out');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
