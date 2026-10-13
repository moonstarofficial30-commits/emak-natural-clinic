<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Middleware\SetLocale;

class LanguageController extends Controller
{
    /**
     * Switch the site language. Triggered from the language menu
     * (Kiswahili / English / Français / 中文) visible on every page.
     * Remembers the choice for 1 year via cookie, and for the
     * current session immediately.
     */
    public function switch(string $locale, Request $request): RedirectResponse
    {
        if (! in_array($locale, SetLocale::SUPPORTED, true)) {
            abort(404);
        }

        $request->session()->put('locale', $locale);

        return redirect()->back()
            ->withCookie(cookie('pp_locale', $locale, 60 * 24 * 365));
    }
}
