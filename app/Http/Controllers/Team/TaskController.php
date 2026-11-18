<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __invoke(Request $request, Task $task)
    {
        abort_unless($task->assignee_id === auth()->id(), 404);

        $data = $request->validate([
            'status' => ['required', 'in:assigned,in_progress,review,completed'],
            'progress' => ['required', 'integer', 'min:0', 'max:100'],
            'member_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $task->update([
            ...$data,
            'completed_at' => $data['status'] === 'completed' ? now() : null,
        ]);

        return back()->with('success', __('site.dashboard.save').' ✓');
    }
}
