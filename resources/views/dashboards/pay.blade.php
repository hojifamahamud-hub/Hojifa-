@extends('layouts.app')

@section('title', __('site.payment.title').' — '.$invoice->number)

@section('content')
<section class="section">
    <div class="container-x" style="max-width:680px;">
        <a href="{{ route('client.invoice.show', $invoice) }}" class="muted">← {{ $invoice->number }}</a>
        <div class="card card-p" style="margin-top:16px;">
            <h1>{{ __('site.payment.title') }}</h1>
            <p class="muted">{{ __('site.payment.instructions') }}</p>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin:16px 0;">
                @if($bkashNumber)
                    <div class="pill" style="padding:12px 16px;">📌 {{ __('site.payment.method_bkash') }}: <strong>{{ $bkashNumber }}</strong></div>
                @endif
                @if($nagadNumber)
                    <div class="pill" style="padding:12px 16px;">📌 {{ __('site.payment.method_nagad') }}: <strong>{{ $nagadNumber }}</strong></div>
                @endif
            </div>

            @if($whatsappNumber)
                <a class="btn btn-good" style="margin-bottom:16px;"
                   href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}?text={{ rawurlencode(__('site.payment.title').' — '.$invoice->number) }}"
                   target="_blank" rel="noopener">{{ __('site.payment.wa_btn') }}</a>
            @endif

            <form method="POST" action="{{ route('client.pay.store', $invoice) }}" style="display:flex;flex-direction:column;gap:14px;">
                @csrf
                <div>
                    <label class="label">{{ __('site.payment.method') }}</label>
                    <select name="method" class="select">
                        <option value="bkash">{{ __('site.payment.method_bkash') }}</option>
                        <option value="nagad">{{ __('site.payment.method_nagad') }}</option>
                        <option value="bank">Bank</option>
                        <option value="intl">International</option>
                    </select>
                </div>
                <div>
                    <label class="label">{{ __('site.payment.amount') }} ({{ __('site.dashboard.due') }}: ৳ {{ number_format($invoice->due, 2) }})</label>
                    <input type="number" name="amount" step="0.01" min="1" max="{{ $invoice->due }}" class="input" required>
                    @error('amount')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">{{ __('site.payment.your_number') }} *</label>
                    <input name="sender_number" class="input" required>
                </div>
                <div>
                    <label class="label">{{ __('site.payment.trx_id') }} *</label>
                    <input name="trx_id" class="input" required>
                </div>
                <button class="btn btn-gradient">{{ __('site.payment.submit') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
