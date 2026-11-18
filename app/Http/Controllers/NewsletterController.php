<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Visitor;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:190'],
        ]);

        $email = strtolower($data['email']);

        Lead::create([
            'type' => Lead::TYPE_NEWSLETTER,
            'name' => $email,
            'email' => $email,
        ]);

        Visitor::query()->updateOrCreate(
            ['email' => $email],
            [
                'ip' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 500),
                'source' => 'newsletter',
                'last_visited_at' => now(),
            ]
        );

        return back()->with('success', __('site.home.newsletter_success'));
    }
}
