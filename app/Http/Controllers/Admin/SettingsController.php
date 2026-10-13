<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Shows the account settings form (username/password change) and,
     * for admins, general site settings (clinic contact info, map, etc).
     */
    public function index(): View
    {
        $user = Auth::user();

        $siteSettings = [
            'hospital_phone' => Setting::get('hospital_phone', config('hospital.phone')),
            'hospital_email' => Setting::get('hospital_email', config('hospital.email')),
            'hospital_address' => Setting::get('hospital_address', config('hospital.address')),
            'hospital_whatsapp' => Setting::get('hospital_whatsapp', config('hospital.whatsapp_number')),
            'hospital_emergency' => Setting::get('hospital_emergency', config('hospital.emergency_number')),
            'hospital_map_embed_url' => Setting::get('hospital_map_embed_url', config('hospital.map_embed_url')),
        ];

        return view('admin.settings.index', compact('user', 'siteSettings'));
    }

    /**
     * Update the logged-in user's own username, name, email, and (optionally) password.
     * This is what satisfies the "admin can change default username and password" requirement.
     */
    public function updateAccount(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:60', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'current_password' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password ya sasa si sahihi. / Current password is incorrect.']);
        }

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Once they've changed their credentials, lift the forced-change flag.
        $user->must_change_password = false;
        $user->save();

        ActivityLog::log('updated_account_settings', $user, 'Admin/receptionist updated own username/password');

        return back()->with('success', 'Taarifa za akaunti zimehifadhiwa. / Account settings saved.');
    }

    /**
     * Update general clinic site settings (admin only — enforced via route middleware).
     */
    public function updateSite(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hospital_phone' => ['required', 'string', 'max:40'],
            'hospital_email' => ['required', 'email', 'max:150'],
            'hospital_address' => ['required', 'string', 'max:255'],
            'hospital_whatsapp' => ['required', 'string', 'max:20'],
            'hospital_emergency' => ['required', 'string', 'max:40'],
            'hospital_map_embed_url' => ['nullable', 'string'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        ActivityLog::log('updated_site_settings', null, 'Updated clinic contact/site settings');

        return back()->with('success', 'Mipangilio ya tovuti imehifadhiwa. / Site settings saved.');
    }
}
