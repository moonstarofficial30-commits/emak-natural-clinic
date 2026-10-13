<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Manages staff accounts (admins + receptionists). Restricted to admins
 * via the 'admin' route middleware.
 */
class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:60', 'unique:users,username'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'role' => ['required', 'in:admin,receptionist'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;

        $user = User::create($validated);

        ActivityLog::log('created_user', $user, "Created staff account: {$user->username} ({$user->role})");

        return redirect()->route('admin.users.index')->with('success', 'Mtumiaji ameongezwa. / User created.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:60', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', 'in:admin,receptionist'],
            'is_active' => ['nullable', 'boolean'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Prevent an admin from locking themselves out by deactivating their own account.
        if ($user->id === Auth::id()) {
            $validated['is_active'] = true;
            $validated['role'] = 'admin';
        }

        $user->update($validated);

        ActivityLog::log('updated_user', $user, "Updated staff account: {$user->username}");

        return redirect()->route('admin.users.index')->with('success', 'Mtumiaji amesasishwa. / User updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->withErrors(['user' => 'Huwezi kujiondoa mwenyewe. / You cannot delete your own account.']);
        }

        $username = $user->username;
        $user->delete();

        ActivityLog::log('deleted_user', null, "Deleted staff account: {$username}");

        return back()->with('success', 'Mtumiaji ameondolewa. / User removed.');
    }
}
