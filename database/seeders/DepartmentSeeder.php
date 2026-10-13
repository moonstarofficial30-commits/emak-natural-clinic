<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'Natural Consultation', 'Health Screening', 'Herbal Remedies',
            'Nutrition & Diet', 'Wellness Programs',
        ];

        foreach ($departments as $name) {
            Department::firstOrCreate(
                ['slug' => str($name)->slug()],
                ['name' => $name]
            );
        }
    }
}
