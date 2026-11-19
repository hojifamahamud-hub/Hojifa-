<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorLeadController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:190'],
        ]);

        $email = strtolower($data['email']);

        Visitor::query()->updateOrCreate(
            ['email' => $email],
            [
                'ip' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 500),
                'source' => (string) $request->header('referer'),
                'last_visited_at' => now(),
            ]
        )->increment('visits');

        session(['visitor_email' => $email]);

        return cookie('visitor_email', $email, 60 * 24 * 180);
    }
}
