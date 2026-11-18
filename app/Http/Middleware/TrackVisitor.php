<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $email = null;
        if ($request->hasSession()) {
            $email = $request->session()->get('visitor_email')
                ?? ($request->user()?->email)
                ?? $request->cookie('visitor_email');
        }

        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && $request->isMethod('GET')) {
            try {
                Visitor::query()->updateOrCreate(
                    ['email' => strtolower($email)],
                    [
                        'ip' => $request->ip(),
                        'user_agent' => substr((string) $request->userAgent(), 0, 500),
                        'last_visited_at' => now(),
                        'visits' => 1,
                    ]
                );
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return $response;
    }
}
