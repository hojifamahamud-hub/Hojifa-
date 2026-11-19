@extends('layouts.app')

@section('title', $invoice->number.' — '.site_name())

@section('content')
<section class="section">
    <div class="container-x" style="max-width:760px;">
        <a href="{{ route('client.dashboard') }}" class="muted">← {{ __('site.dashboard.client') }}</a>
        <div class="card card-p" style="margin-top:16px;">
            <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                <div>
                    <h1>{{ $invoice->number }}</h1>
                    @if($invoice->clientProject)<p class="muted">{{ $invoice->clientProject->title }}</p>@endif
                </div>
                <div style="text-align:right;">
                    @if($invoice->status === 'paid')<span class="pill pill-good">{{ __('site.dashboard.paid') }}</span>
                    @elseif($invoice->status === 'partial')<span class="pill pill-warn">Partial</span>
                    @else<span class="pill pill-bad">{{ __('site.dashboard.due') }}</span>@endif
                </div>
            </div>
            <table class="table-x" style="margin-top:14px;">
                <tr><th>{{ __('site.dashboard.amount') }}</th><td>৳ {{ number_format((float) $invoice->amount, 2) }}</td></tr>
                <tr><th>{{ __('site.dashboard.paid') }}</th><td>৳ {{ number_format((float) $invoice->paid_amount, 2) }}</td></tr>
                <tr><th>{{ __('site.dashboard.due') }}</th><td style="font-weight:700;">৳ {{ number_format($invoice->due, 2) }}</td></tr>
                @if($invoice->due_date)<tr><th>{{ __('site.dashboard.deadline') }}</th><td>{{ $invoice->due_date->format('j M Y') }}</td></tr>@endif
            </table>
            @if($invoice->note)<p class="muted" style="margin-top:10px;">{{ $invoice->note }}</p>@endif

            @if($invoice->due > 0)
                <a href="{{ route('client.pay.show', $invoice) }}" class="btn btn-gradient" style="margin-top:16px;">{{ __('site.payment.title') }}</a>
            @endif
        </div>

        <h3 style="margin-top:24px;">{{ __('site.dashboard.payments') }}</h3>
        <div class="card card-p">
            @if($invoice->payments->count())
                <table class="table-x">
                    <tr><th>{{ __('site.payment.voucher_no') }}</th><th>{{ __('site.payment.method') }}</th><th>{{ __('site.dashboard.amount') }}</th><th>{{ __('site.dashboard.status') }}</th><th></th></tr>
                    @foreach($invoice->payments as $payment)
                        <tr>
                            <td>{{ $payment->voucher_no }}</td>
                            <td>{{ $payment->method }}</td>
                            <td>৳ {{ number_format((float) $payment->amount, 2) }}</td>
                            <td>
                                @if($payment->status === 'approved')<span class="pill pill-good">{{ __('site.dashboard.approved') }}</span>
                                @elseif($payment->status === 'rejected')<span class="pill pill-bad">{{ __('site.dashboard.rejected') }}</span>
                                @else<span class="pill pill-warn">{{ __('site.dashboard.pending') }}</span>@endif
                            </td>
                            <td><a class="btn btn-outline btn-sm" href="{{ route('client.voucher.show', $payment) }}">{{ __('site.dashboard.view_voucher') }}</a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="muted">{{ __('site.admin.no_data') }}</p>
            @endif
        </div>
    </div>
</section>
@endsection
