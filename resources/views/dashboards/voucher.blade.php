@extends('layouts.app')

@section('title', __('site.payment.voucher').' — '.$payment->voucher_no)

@section('content')
<section class="section" style="background:#f8fafc;">
    <div class="container-x" style="max-width:640px;">
        <div class="card card-p" id="voucherBox" style="border-top:6px solid var(--brand);">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
                <div style="font-weight:800;font-size:20px;">{{ site_name() }}</div>
                <span class="pill" style="font-size:15px;">{{ __('site.payment.voucher') }}</span>
            </div>
            <hr style="border:none;border-top:1px solid var(--line);margin:14px 0;">
            <table class="table-x">
                <tr><th>{{ __('site.payment.voucher_no') }}</th><td><strong>{{ $payment->voucher_no }}</strong></td></tr>
                <tr><th>{{ __('site.payment.invoice') }}</th><td>{{ $payment->invoice->number }}</td></tr>
                <tr><th>{{ __('site.consult.name') }}</th><td>{{ $payment->invoice->user?->name }}</td></tr>
                <tr><th>{{ __('site.payment.method') }}</th><td>{{ $payment->method }}</td></tr>
                <tr><th>{{ __('site.payment.amount') }}</th><td><strong>৳ {{ number_format((float) $payment->amount, 2) }}</strong></td></tr>
                <tr><th>{{ __('site.payment.your_number') }}</th><td>{{ $payment->sender_number }}</td></tr>
                <tr><th>{{ __('site.payment.trx_id') }}</th><td>{{ $payment->trx_id }}</td></tr>
                <tr><th>{{ __('site.dashboard.status') }}</th>
                    <td>
                        @if($payment->status === 'approved')<span class="pill pill-good">{{ __('site.dashboard.approved') }}</span>
                        @elseif($payment->status === 'rejected')<span class="pill pill-bad">{{ __('site.dashboard.rejected') }}</span>
                        @else<span class="pill pill-warn">{{ __('site.dashboard.pending') }}</span>@endif
                    </td>
                </tr>
            </table>
            <p class="muted" style="margin-top:12px;">{{ now()->format('j M Y, h:i A') }}</p>
        </div>

        <div class="no-print" style="display:flex;gap:10px;margin-top:16px;">
            <button onclick="window.print()" class="btn btn-gradient">{{ __('site.payment.print') }}</button>
            @if($whatsappNumber)
                <a class="btn btn-good" target="_blank" rel="noopener"
                   href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}?text={{ rawurlencode(__('site.payment.voucher_no').': '.$payment->voucher_no.' — '.__('site.dashboard.amount').': ৳ '.number_format((float) $payment->amount, 2).' — '.$payment->trx_id) }}">
                    {{ __('site.payment.wa_btn') }}</a>
            @endif
            <a href="{{ route('client.invoice.show', $payment->invoice) }}" class="btn btn-outline">{{ __('site.admin.back') }}</a>
        </div>
    </div>
</section>
@endsection
