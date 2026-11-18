<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientProject;
use Illuminate\Http\Request;

class ClientProjectController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $projects = ClientProject::query()->with('user')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderByDesc('id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.client-projects.index', compact('projects', 'status'));
    }

    public function store(Request $request)
    {
        ClientProject::create($request->validate($this->rules() + [
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:pending,active,completed,cancelled'],
        ]));

        return redirect()->route('admin.client-projects.index')->with('success', __('site.admin.saved'));
    }

    public function update(Request $request, ClientProject $clientProject)
    {
        $clientProject->update($request->validate($this->rules() + [
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:pending,active,completed,cancelled'],
        ]));

        return redirect()->back()->with('success', __('site.admin.updated'));
    }

    public function destroy(ClientProject $clientProject)
    {
        $clientProject->delete();

        return redirect()->back()->with('success', __('site.admin.deleted'));
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'due_date' => ['nullable', 'date'],
        ];
    }
}
