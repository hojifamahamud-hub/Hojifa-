@extends('layouts.admin')

@section('title', __('site.payment.voucher').' — '.$invoice->number)

@section('content')
<div style="max-width:660px;">
    <div class="card card-p no-print" style="display:flex;gap:10px;flex-wrap:wrap;">
        <button onclick="window.print()" class="btn btn-gradient">{{ __('site.payment.print') }}</button>
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline">{{ __('site.admin.back') }}</a>
    </div>

    <div class="card card-p" style="border-top:6px solid var(--brand);margin-top:14px;">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
            <div style="font-weight:800;font-size:20px;">{{ site_name() }}</div>
            <span class="pill" style="font-size:15px;">INVOICE / {{ __('site.payment.voucher') }}</span>
        </div>
        <hr style="border:none;border-top:1px solid var(--line);margin:14px 0;">
        <table class="table-x">
            <tr><th>Invoice</th><td><strong>{{ $invoice->number }}</strong></td></tr>
            <tr><th>Client</th><td>{{ $invoice->user?->name }} ({{ $invoice->user?->email }})</td></tr>
            <tr><th>{{ __('site.dashboard.amount') }}</th><td>{{ $invoice->currency }} {{ number_format((float) $invoice->amount, 2) }}</td></tr>
            <tr><th>{{ __('site.dashboard.paid') }}</th><td>{{ number_format((float) $invoice->paid_amount, 2) }}</td></tr>
            <tr><th>{{ __('site.dashboard.due') }}</th><td><strong>{{ number_format($invoice->due, 2) }}</strong></td></tr>
        </table>

        <h3 style="margin-top:18px;">Approved Payments</h3>
        <table class="table-x">
            @forelse($invoice->payments as $payment)
                <tr><th>{{ $payment->voucher_no }} · {{ $payment->method }} · {{ $payment->trx_id }}</th><td>{{ number_format((float) $payment->amount, 2) }}</td></tr>
            @empty
                <p class="muted">{{ __('site.admin.no_data') }}</p>
            @endforelse
        </table>
        <p class="muted" style="margin-top:12px;">{{ now()->format('j M Y, h:i A') }} — {{ site_name() }}</p>
    </div>
</div>
@endsection
