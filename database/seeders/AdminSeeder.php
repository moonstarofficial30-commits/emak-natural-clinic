<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Creates the default administrator account using values from .env
     * (DEFAULT_ADMIN_USERNAME / DEFAULT_ADMIN_PASSWORD / DEFAULT_ADMIN_EMAIL).
     *
     * must_change_password is set to true, so the ForcePasswordChange
     * middleware will redirect the admin straight to Settings on first
     * login until they change the username/password themselves.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => config('hospital.default_admin.username')],
            [
                'name' => 'Administrator',
                'email' => config('hospital.default_admin.email'),
                'password' => Hash::make(config('hospital.default_admin.password')),
                'role' => 'admin',
                'is_active' => true,
                'must_change_password' => true,
            ]
        );
    }
}
