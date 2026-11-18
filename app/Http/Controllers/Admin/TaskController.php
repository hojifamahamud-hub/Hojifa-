<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $assignee = $request->query('assignee');

        $tasks = Task::query()->with('assignee')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($assignee, fn ($query) => $query->where('assignee_id', $assignee))
            ->orderByDesc('id')
            ->paginate(50)
            ->withQueryString();

        $members = User::query()->whereIn('role', [User::ROLE_MEMBER, User::ROLE_ADMIN])->orderBy('name')->get();

        return view('admin.tasks.index', compact('tasks', 'members', 'status', 'assignee'));
    }

    public function store(Request $request)
    {
        Task::create($request->validate($this->rules()) + [
            'status' => Task::STATUS_ASSIGNED,
            'progress' => 0,
        ]);

        return redirect()->route('admin.tasks.index')->with('success', __('site.admin.saved'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($this->approvedSet($request));

        return redirect()->back()->with('success', __('site.admin.updated'));
    }

    public function status(Request $request, Task $task)
    {
        $data = $request->validate([
            'status' => ['required', 'in:assigned,in_progress,review,completed'],
            'progress' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        if ($data['status'] === Task::STATUS_COMPLETED) {
            $data['progress'] = 100;
            $data['completed_at'] = now();
        } else {
            unset($data['completed_at']);
        }

        $task->update($data);

        return redirect()->back()->with('success', __('site.admin.updated'));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back()->with('success', __('site.admin.deleted'));
    }

    protected function rules(): array
    {
        return [
            'assignee_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ];
    }

    protected function approvedSet(Request $request): array
    {
        $data = $request->validate([
            'assignee_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:assigned,in_progress,review,completed'],
            'progress' => ['required', 'integer', 'min:0', 'max:100'],
            'due_date' => ['nullable', 'date'],
        ]);

        $data['completed_at'] = $data['status'] === Task::STATUS_COMPLETED ? now() : null;

        return $data;
    }
}
