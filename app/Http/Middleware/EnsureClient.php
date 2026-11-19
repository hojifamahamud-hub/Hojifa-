<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureClient
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login')->with('error', __('auth.please_login'));
        }
        if (!$user->isActive()) {
            auth()->logout();
            return redirect()->route('login')->with('error', __($user->status === 'pending' ? 'auth.account_pending' : 'auth.account_suspended'));
        }
        return $next($request);
    }
}
