<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Department;

class DoctorSeeder extends Seeder
{
    /**
     * PLACEHOLDER profiles only. Replace them in Admin > Specialists with the
     * real, verified practitioners and their confirmed qualifications.
     */
    public function run(): void
    {
        $consult = Department::where('slug', 'natural-consultation')->first();
        $screen = Department::where('slug', 'health-screening')->first();
        $nutrition = Department::where('slug', 'nutrition-diet')->first();

        $doctors = [
            [
                'name' => 'Specialist Name 1 (sample)',
                'specialization' => 'Natural Health Consultant',
                'department_id' => $consult?->id,
                'experience_years' => 0,
                'working_days' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                'bio' => 'Sample profile — replace with the verified practitioner details.',
            ],
            [
                'name' => 'Specialist Name 2 (sample)',
                'specialization' => 'Health Screening Specialist',
                'department_id' => $screen?->id,
                'experience_years' => 0,
                'working_days' => ['Mon', 'Wed', 'Fri'],
                'bio' => 'Sample profile — replace with the verified practitioner details.',
            ],
            [
                'name' => 'Specialist Name 3 (sample)',
                'specialization' => 'Nutrition & Diet Counsellor',
                'department_id' => $nutrition?->id,
                'experience_years' => 0,
                'working_days' => ['Tue', 'Thu', 'Sat'],
                'bio' => 'Sample profile — replace with the verified practitioner details.',
            ],
        ];

        foreach ($doctors as $d) {
            Doctor::firstOrCreate(['name' => $d['name']], $d);
        }
    }
}
