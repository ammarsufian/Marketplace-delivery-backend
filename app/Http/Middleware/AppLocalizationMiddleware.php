<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppLocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userLanguage = $request->headers('user-lang') ?? null;
        if (in_array($userLanguage, config('app.allowed_languages')))
            app()->setLocale($userLanguage);
        else
            app()->setLocale('ar');

        return $next($request);
    }
}
