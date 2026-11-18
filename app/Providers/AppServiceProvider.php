<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        RateLimiter::for('chat', fn (Request $request) => Limit::perMinute(10)->by($request->ip()));
        RateLimiter::for('leads', fn (Request $request) => Limit::perMinute(6)->by($request->ip()));
    }
}
