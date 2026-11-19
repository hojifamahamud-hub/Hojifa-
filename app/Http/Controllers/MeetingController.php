<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'meeting_type' => ['nullable', 'string', 'max:120'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'message' => ['nullable', 'string', 'max:3000'],
        ]);

        Lead::create([
            'type' => Lead::TYPE_MEETING,
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'] ?? null,
            'meeting_type' => $data['meeting_type'] ?? null,
            'preferred_date' => $data['preferred_date'] ?? null,
        ]);

        return back()->with('success', __('site.home.meeting_success'));
    }
}
