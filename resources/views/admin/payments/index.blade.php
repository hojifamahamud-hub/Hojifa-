@extends('layouts.admin')

@section('title', __('site.admin.payments'))

@section('content')
<h1>{{ __('site.admin.payments') }}</h1>

<div style="display:flex;gap:8px;margin:14px 0;">
    @foreach([null => __('site.admin.all'), 'pending' => __('site.admin.pending'), 'approved' => __('site.dashboard.approved'), 'rejected' => __('site.dashboard.rejected')] as $s => $label)
        <a class="pill {{ $status === $s ? 'pill-good' : '' }}" href="{{ route('admin.payments.index', $s ? ['status' => $s] : []) }}">{{ $label }}</a>
    @endforeach
</div>

<div class="card" style="overflow-x:auto;">
    <table class="table-x">
        <tr><th>Voucher</th><th>Client</th><th>Invoice</th><th>{{ __('site.payment.method') }}</th><th>{{ __('site.dashboard.amount') }}</th><th>TRX</th><th>Status</th><th>{{ __('site.admin.actions') }}</th></tr>
        @forelse($payments as $payment)
            <tr>
                <td><strong>{{ $payment->voucher_no }}</strong></td>
                <td>{{ $payment->invoice->user?->name }}</td>
                <td>{{ $payment->invoice->number }}</td>
                <td>{{ $payment->method }}</td>
                <td>৳ {{ number_format((float) $payment->amount, 2) }}</td>
                <td class="muted">{{ $payment->trx_id }}<br>{{ $payment->sender_number }}</td>
                <td><span class="pill {{ $payment->status === 'approved' ? 'pill-good' : ($payment->status === 'rejected' ? 'pill-bad' : 'pill-warn') }}">{{ $payment->status }}</span></td>
                <td style="display:flex;gap:6px;">
                    @if($payment->status === 'pending')
                        <form method="POST" action="{{ route('admin.payments.approve', $payment) }}">
                            @csrf @method('PATCH')
                            <button class="btn btn-good btn-sm">✔ {{ __('site.admin.approve') }}</button>
                        </form>
                        <form method="POST" action="{{ route('admin.payments.reject', $payment) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="admin_note" value="">
                            <button class="btn btn-danger btn-sm">✖ {{ __('site.admin.reject') }}</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $payments->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
