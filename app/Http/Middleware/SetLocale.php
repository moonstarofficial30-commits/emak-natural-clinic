<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

/**
 * Applies the visitor's chosen language (Swahili, English, French, Chinese)
 * on every request. The language is chosen once by the visitor from the
 * language menu / settings and remembered via session + cookie so it
 * persists across visits.
 */
class SetLocale
{
    /**
     * Supported locales for the public website.
     */
    public const SUPPORTED = ['sw', 'en', 'fr', 'zh'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale')
            ?? $request->cookie('pp_locale')
            ?? config('app.locale');

        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = config('app.fallback_locale', 'en');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
