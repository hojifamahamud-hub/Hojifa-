<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Page;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact', [
            'page' => Page::where('slug', 'contact')->where('active', true)->first(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        Lead::create([...$data, 'type' => Lead::TYPE_CONSULT]);

        return back()->with('success', __('site.consult.success'));
    }
}
