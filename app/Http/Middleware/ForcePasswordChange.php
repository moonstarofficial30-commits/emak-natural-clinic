<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * If the logged-in user still has the default admin credentials
     * (must_change_password = true), force them to the Settings page
     * before they can use any other part of the dashboard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->must_change_password && ! $request->routeIs('admin.settings.*', 'admin.logout')) {
            return redirect()
                ->route('admin.settings.index')
                ->with('warning', 'Kwa usalama, tafadhali badilisha username na password ya default kabla ya kuendelea. / For security, please change the default username and password before continuing.');
        }

        return $next($request);
    }
}
