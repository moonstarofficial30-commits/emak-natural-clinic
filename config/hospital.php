<?php

return [
    'phone' => env('HOSPITAL_PHONE', '+255 700 000 000'),
    'email' => env('HOSPITAL_EMAIL', 'info@emaknaturalclinic.co.tz'),
    'address' => env('HOSPITAL_ADDRESS', 'Tanzania'),
    'whatsapp_number' => env('HOSPITAL_WHATSAPP_NUMBER', '255700000000'),
    'emergency_number' => env('HOSPITAL_EMERGENCY_NUMBER', '+255700000000'),
    'map_embed_url' => env('HOSPITAL_MAP_EMBED_URL', ''),

    // Default admin credentials (Phase 2) — admin will be forced
    // to change these from Settings on first login.
    'default_admin' => [
        'username' => env('DEFAULT_ADMIN_USERNAME', 'admin'),
        'password' => env('DEFAULT_ADMIN_PASSWORD', 'ChangeMe@2026'),
        'email' => env('DEFAULT_ADMIN_EMAIL', 'admin@emaknaturalclinic.co.tz'),
    ],
];
