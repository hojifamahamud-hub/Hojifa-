<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.login', ['mode' => $request->boolean('member') ? 'member' : 'client']);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages(['email' => __('site.auth.failed')]);
        }

        $user = Auth::user();

        if ($user->isMember() && $user->status !== 'active') {
            Auth::logout();
            throw ValidationException::withMessages(['email' => __('site.auth.account_pending')]);
        }

        if (!$user->isActive()) {
            Auth::logout();
            throw ValidationException::withMessages(['email' => __('site.auth.account_suspended')]);
        }

        $request->session()->regenerate();

        return redirect()->intended(
            $user->isAdmin() ? route('admin.dashboard')
                : ($user->isMember() ? route('team.dashboard') : route('client.dashboard'))
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
