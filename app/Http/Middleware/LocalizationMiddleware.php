<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalizationMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        $params = explode('/', $request->fullUrl());
        $language = $params[3] ?? null;

        if (in_array($language, config('app.allowed_languages'))) {
            app()->setLocale($language);
        } else {
            return redirect()->to(env('app.url') . '/' . app()->getLocale() . '/' .($params[4]?? 'main'));
        }
        return $next($request);
    }
}
