<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Sample services — edit/replace them from Admin > Services.
     * Wording is intentionally careful: no guaranteed cures are claimed.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Natural Health Consultation', 'icon' => 'bi-chat-heart', 'short_desc' => 'One-to-one consultation with a specialist to discuss your health concerns and natural care options.'],
            ['name' => 'Health Screening Tests', 'icon' => 'bi-clipboard2-pulse', 'short_desc' => 'Basic health tests that help guide proper advice and the right natural care plan.'],
            ['name' => 'Herbal Remedies', 'icon' => 'bi-flower1', 'short_desc' => 'Natural herbal preparations recommended after consultation, with clear guidance on use.'],
            ['name' => 'Nutrition & Diet Counselling', 'icon' => 'bi-egg-fried', 'short_desc' => 'Practical advice on healthy eating habits that support your overall wellbeing.'],
            ['name' => 'Wellness & Detox Programs', 'icon' => 'bi-droplet-half', 'short_desc' => 'Guided wellness programs to support a healthier lifestyle, planned together with our team.'],
            ['name' => 'Follow-up & Monitoring', 'icon' => 'bi-calendar2-check', 'short_desc' => 'Regular follow-up visits to review your progress and adjust your care plan.'],
        ];

        foreach ($services as $s) {
            Service::firstOrCreate(
                ['slug' => str($s['name'])->slug()],
                [
                    'name' => $s['name'],
                    'icon' => $s['icon'],
                    'short_desc' => $s['short_desc'],
                    'description' => $s['short_desc'].' Natural therapies support wellbeing and do not replace medical diagnosis. Book an appointment to learn what suits you.',
                    'is_active' => true,
                ]
            );
        }
    }
}
