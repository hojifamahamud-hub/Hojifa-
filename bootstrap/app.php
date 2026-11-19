<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\TrackVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            SetLocale::class,
            TrackVisitor::class,
        ]);
        $middleware->alias([
            'locale' => App\Http\Middleware\SetLocale::class,
            'admin' => App\Http\Middleware\EnsureAdmin::class,
            'member' => App\Http\Middleware\EnsureMember::class,
            'client' => App\Http\Middleware\EnsureClient::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, \Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('auth.unauthenticated')], 401);
            }
        });
    })->create();
