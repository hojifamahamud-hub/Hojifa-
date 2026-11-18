<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $visitors = Visitor::query()
            ->when($q !== '', fn ($query) => $query->where('email', 'like', "%{$q}%"))
            ->orderByDesc('last_visited_at')
            ->paginate(50)
            ->withQueryString();

        return view('admin.visitors.index', compact('visitors', 'q'));
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->back()->with('success', __('site.admin.deleted'));
    }
}
