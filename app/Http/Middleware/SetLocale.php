<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SetLocale
{
    public const SUPPORTED = ['bn', 'en'];

    public function handle(Request $request, Closure $next)
    {
        $locale = $request->cookie('locale');

        if (!in_array($locale, self::SUPPORTED, true)) {
            $locale = 'bn';
        }

        app()->setLocale($locale);

        $response = $next($request);

        if (method_exists($response, 'withCookie')) {
            $response->withCookie(Cookie::forever('locale', $locale));
        }

        return $response;
    }
}
