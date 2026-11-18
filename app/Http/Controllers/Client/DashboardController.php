<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $invoices = $user->invoices()->latest('id')->get();

        return view('dashboards.client', [
            'user' => $user,
            'projects' => $user->clientProjects()->latest('id')->get(),
            'invoices' => $invoices,
            'totalAmount' => (float) $invoices->sum('amount'),
            'totalPaid' => (float) $invoices->sum('paid_amount'),
            'totalDue' => (float) $invoices->sum(fn ($i) => $i->due),
        ]);
    }

    public function invoice(Invoice $invoice)
    {
        abort_unless($invoice->user_id === auth()->id(), 404);

        return view('dashboards.invoice', ['invoice' => $invoice->load('payments', 'clientProject')]);
    }
}
