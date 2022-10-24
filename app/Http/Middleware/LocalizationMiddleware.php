<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalizationMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $params = explode('/', $request->fullUrl());
        // post request
        if (isset($params[3]) && in_array($params[3], config('app.allowed_languages'))) {
            app()->setLocale($params[3]);
        }
        else {
            if (isset($params[3]) && ($params[3] == 'provider' || $params[3]=='api'))
                return $next($request);
            return redirect()->to(env('app.url') . '/' . app()->getLocale());
        }
        return $next($request);
    }
}
