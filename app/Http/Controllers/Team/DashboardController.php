<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $tasks = $user->tasks()->latest('id')->get();

        return view('dashboards.team', [
            'user' => $user,
            'tasks' => $tasks,
            'completedCount' => $tasks->where('status', 'completed')->count(),
            'activeCount' => $tasks->where('status', '!=', 'completed')->count(),
        ]);
    }
}
