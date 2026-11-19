@extends('layouts.admin')

@section('title', __('site.admin.invoices'))

@section('content')
<h1>{{ __('site.admin.invoices') }}</h1>

<div class="card card-p" style="max-width:880px;margin-top:14px;">
    <h3>+ {{ __('site.admin.add') }}</h3>
    <form method="POST" action="{{ route('admin.invoices.store') }}" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:10px;margin-top:10px;">
        @csrf
        <input name="user_id" type="number" class="input" placeholder="Client User ID" required>
        <input name="amount" type="number" step="0.01" min="0" class="input" placeholder="{{ __('site.dashboard.amount') }}" required>
        <input name="due_date" type="date" class="input">
        <input name="note" class="input" placeholder="Note">
        <button class="btn btn-gradient">{{ __('site.admin.save') }}</button>
    </form>
</div>

<div class="card" style="overflow-x:auto;margin-top:16px;">
    <table class="table-x">
        <tr><th>Number</th><th>Client</th><th>{{ __('site.dashboard.amount') }}</th><th>{{ __('site.dashboard.paid') }}</th><th>{{ __('site.dashboard.due') }}</th><th>Status</th><th></th></tr>
        @forelse($invoices as $invoice)
            <tr>
                <td><strong>{{ $invoice->number }}</strong>@if($invoice->clientProject)<div class="muted">{{ $invoice->clientProject->title }}</div>@endif</td>
                <td>{{ $invoice->user?->name }}</td>
                <td>৳ {{ number_format((float) $invoice->amount, 2) }}</td>
                <td>৳ {{ number_format((float) $invoice->paid_amount, 2) }}</td>
                <td>৳ {{ number_format($invoice->due, 2) }}</td>
                <td><span class="pill {{ $invoice->status === 'paid' ? 'pill-good' : ($invoice->status === 'partial' ? 'pill-warn' : 'pill-bad') }}">{{ $invoice->status }}</span></td>
                <td style="display:flex;gap:6px;">
                    <a class="btn btn-outline btn-sm" href="{{ route('admin.invoices.voucher', $invoice) }}">{{ __('site.payment.print') }}</a>
                    <form method="POST" action="{{ route('admin.invoices.destroy', $invoice) }}" onsubmit="return confirm('{{ __('site.admin.delete') }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $invoices->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
