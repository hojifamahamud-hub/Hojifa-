<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function show()
    {
        return view('requirement');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:30'],
            'budget' => ['nullable', 'string', 'max:60'],
            'timeline' => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Lead::create([...$data, 'type' => Lead::TYPE_REQUIREMENT]);

        return back()->with('success', __('site.requirement.success'));
    }
}
