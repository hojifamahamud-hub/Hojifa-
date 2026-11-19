<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:190'],
            'description' => ['required', 'string', 'max:5000'],
            'category' => ['nullable', 'string', 'max:80'],
            'budget' => ['nullable', 'numeric', 'min:0'],
        ]);

        auth()->user()->clientProjects()->create($data);

        return back()->with('success', __('site.dashboard.add_project').' ✓');
    }
}
