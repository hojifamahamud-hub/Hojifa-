<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Visitor;

class DashboardController extends Controller
{
    public function index()
    {
        $leadCount = Lead::count();
        $newLeads = Lead::where('status', 'new')->count();
        $visitorCount = Visitor::count();
        $userCount = User::count();
        $pendingMembers = User::where('role', 'member')->where('status', 'pending')->count();
        $projectCount = Project::count();
        $postCount = Post::count();
        $activeTasks = Task::whereIn('status', [Task::STATUS_ASSIGNED, Task::STATUS_IN_PROGRESS])->count();
        $unreadChats = Conversation::where('unread', '>', 0)->count();

        $unpaidDue = (clone Invoice::query())->where('status', '!=', Invoice::STATUS_PAID)
            ->get()
            ->sum(fn ($invoice) => $invoice->due);

        $pendingPayments = Payment::query()->with('invoice.user')
            ->where('status', Payment::STATUS_PENDING)
            ->latest('id')
            ->take(10)
            ->get();

        $recentLeads = Lead::query()->latest('id')->take(10)->get();

        return view('admin.dashboard', compact(
            'leadCount', 'newLeads', 'visitorCount', 'userCount', 'pendingMembers',
            'projectCount', 'postCount', 'activeTasks', 'unreadChats',
            'unpaidDue', 'pendingPayments', 'recentLeads'
        ));
    }
}
