<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', Payment::STATUS_PENDING);

        $payments = Payment::query()->with('invoice.user')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderByDesc('id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.payments.index', compact('payments', 'status'));
    }

    public function approve(Request $request, Payment $payment)
    {
        if ($payment->status !== Payment::STATUS_PENDING) {
            return redirect()->back()->with('error', __('site.admin.payment_processed'));
        }

        $payment->update([
            'status' => Payment::STATUS_APPROVED,
            'approved_at' => now(),
        ]);

        InvoiceController::recalculate($payment->invoice);

        return redirect()->back()->with('success', __('site.admin.approved'));
    }

    public function reject(Request $request, Payment $payment)
    {
        if ($payment->status !== Payment::STATUS_PENDING) {
            return redirect()->back()->with('error', __('site.admin.payment_processed'));
        }

        $payment->update([
            'status' => Payment::STATUS_REJECTED,
            'admin_note' => $request->input('admin_note'),
        ]);

        InvoiceController::recalculate($payment->invoice);

        return redirect()->back()->with('success', __('site.admin.rejected'));
    }
}
