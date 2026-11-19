<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role');
        $status = $request->query('status');
        $q = trim((string) $request->query('q'));

        $users = User::query()
            ->when($role, fn ($query) => $query->where('role', $role))
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($q !== '', function ($query) use ($q) {
                $query->where(fn ($w) => $w
                    ->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%"));
            })
            ->orderByDesc('id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'role', 'status', 'q'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', 'in:client,member,admin'],
            'status' => ['required', 'in:active,pending,suspended'],
        ]);

        if ($user->id === $request->user()->id && ($data['role'] !== 'admin' || $data['status'] !== 'active')) {
            return redirect()->back()->with('error', __('site.admin.cant_edit_self'));
        }

        $user->update($data);

        return redirect()->back()->with('success', __('site.admin.updated'));
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return redirect()->back()->with('error', __('site.admin.cant_edit_self'));
        }

        $user->delete();

        return redirect()->back()->with('success', __('site.admin.deleted'));
    }
}
