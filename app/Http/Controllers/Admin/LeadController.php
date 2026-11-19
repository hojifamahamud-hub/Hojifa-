<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $type = $request->query('type');
        $q = trim((string) $request->query('q'));

        $leads = Lead::query()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($type, fn ($query) => $query->where('type', $type))
            ->when($q !== '', function ($query) use ($q) {
                $query->where(fn ($w) => $w
                    ->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%"));
            })
            ->latest('id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.leads.index', compact('leads', 'status', 'type', 'q'));
    }

    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,contacted,won,lost'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $lead->update($data);

        return redirect()->back()->with('success', __('site.admin.updated'));
    }

    public function export(): StreamedResponse
    {
        $filename = 'leads-'.now()->format('Y-m-d-His').'.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['id', 'type', 'name', 'email', 'phone', 'budget', 'timeline', 'message', 'status', 'created_at']);

            Lead::query()->orderBy('id')->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $row) {
                    fputcsv($out, [
                        $row->id, $row->type, $row->name, $row->email, $row->phone,
                        $row->budget, $row->timeline, $row->message, $row->status, $row->created_at,
                    ]);
                }
            });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
