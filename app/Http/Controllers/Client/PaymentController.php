<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Invoice $invoice)
    {
        abort_unless($invoice->user_id === auth()->id(), 404);

        return view('dashboards.pay', [
            'invoice' => $invoice,
            'bkashNumber' => (string) setting('payment_bkash_number'),
            'nagadNumber' => (string) setting('payment_nagad_number'),
            'whatsappNumber' => (string) setting('contact_whatsapp'),
        ]);
    }

    public function store(Request $request, Invoice $invoice)
    {
        abort_unless($invoice->user_id === auth()->id(), 404);

        $data = $request->validate([
            'method' => ['required', 'in:bkash,nagad,bank,intl'],
            'amount' => ['required', 'numeric', 'min:1', 'max:'.$invoice->due],
            'sender_number' => ['required', 'string', 'max:40'],
            'trx_id' => ['required', 'string', 'max:80'],
        ]);

        $payment = Payment::create([
            ...$data,
            'invoice_id' => $invoice->id,
            'voucher_no' => 'VCH-'.strtoupper(\Illuminate\Support\Str::random(8)),
            'status' => Payment::STATUS_PENDING,
        ]);

        return redirect()
            ->route('client.voucher.show', $payment)
            ->with('success', __('site.payment.submitted'));
    }

    public function voucher(Payment $payment)
    {
        abort_unless($payment->invoice->user_id === auth()->id(), 404);

        return view('dashboards.voucher', [
            'payment' => $payment->load('invoice.user'),
            'whatsappNumber' => (string) setting('contact_whatsapp'),
        ]);
    }
}
