<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureMember
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user || !($user->isAdmin() || $user->isMember())) {
            return redirect()->route('login')->with('error', __('auth.member_only'));
        }
        return $next($request);
    }
}
