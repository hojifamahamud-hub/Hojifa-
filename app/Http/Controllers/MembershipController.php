<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MembershipController extends Controller
{
    public function show()
    {
        return view('membership');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30'],
            'skills' => ['nullable', 'string', 'max:400'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'skills' => array_values(array_filter(array_map('trim', explode(',', (string) $data['skills'])))),
            'role' => User::ROLE_MEMBER,
            'status' => 'pending',
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success', __('site.auth.account_pending'));
    }
}
