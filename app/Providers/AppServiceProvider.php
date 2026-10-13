<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Behind Render's proxy the app must generate https:// links (avoids mixed-content/CSS blocked).
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();
        Schema::defaultStringLength(191);

        // Share clinic contact info (editable by admin in Settings) and footer services with every view.
        // try/catch keeps `php artisan` working before migrations have run.
        View::composer('*', function ($view) {
            try {
                $view->with('hospitalSettings', [
                    'phone' => Setting::get('hospital_phone', config('hospital.phone')),
                    'email' => Setting::get('hospital_email', config('hospital.email')),
                    'address' => Setting::get('hospital_address', config('hospital.address')),
                    'whatsapp' => Setting::get('hospital_whatsapp', config('hospital.whatsapp_number')),
                    'emergency' => Setting::get('hospital_emergency', config('hospital.emergency_number')),
                    'map_embed_url' => Setting::get('hospital_map_embed_url', config('hospital.map_embed_url')),
                ]);
                $view->with('footerServices', Service::active()->take(4)->get());
            } catch (\Throwable $e) {
                $view->with('hospitalSettings', [
                    'phone' => config('hospital.phone'),
                    'email' => config('hospital.email'),
                    'address' => config('hospital.address'),
                    'whatsapp' => config('hospital.whatsapp_number'),
                    'emergency' => config('hospital.emergency_number'),
                    'map_embed_url' => config('hospital.map_embed_url'),
                ]);
                $view->with('footerServices', collect());
            }
        });
    }
}
