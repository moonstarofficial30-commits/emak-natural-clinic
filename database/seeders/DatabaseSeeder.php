<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed sample data + default admin ONLY on a brand-new database,
        // so restarts never re-create deleted items or the default admin.
        if (User::query()->exists()) {
            return;
        }

        $this->call([
            DepartmentSeeder::class,
            ServiceSeeder::class,
            DoctorSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
