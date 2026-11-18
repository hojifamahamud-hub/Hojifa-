@extends('layouts.admin')

@section('title', __('site.admin.dashboard'))

@section('content')
<h1>{{ __('site.admin.dashboard') }}</h1>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px;margin-top:20px;">
    @foreach([
        [__('site.admin.leads'), $leadCount, '📥', ''],
        ['New Leads', $newLeads, '🔔', 'pill-warn'],
        [__('site.admin.visitors'), $visitorCount, '👁', ''],
        [__('site.admin.users'), $userCount, '👥', ''],
        ['Pending Members', $pendingMembers, '⏳', 'pill-warn'],
        [__('site.admin.projects'), $projectCount, '🖼', ''],
        [__('site.admin.blog'), $postCount, '✍️', ''],
        ['Active Tasks', $activeTasks, '✅', ''],
        ['Unread Chats', $unreadChats, '💬', 'pill-bad'],
    ] as $card)
        <div class="card card-p">
            <div style="font-size:22px;">{{ $card[2] }}</div>
            <div style="font-size:26px;font-weight:800;color:var(--brand);">{{ number_format($card[1]) }}</div>
            <div class="muted">{{ $card[0] }}</div>
        </div>
    @endforeach
    <div class="card card-p">
        <div style="font-size:22px;">💰</div>
        <div style="font-size:22px;font-weight:800;color:var(--bad);">৳ {{ number_format((float) $unpaidDue, 2) }}</div>
        <div class="muted">Total Due (unpaid invoices)</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:16px;margin-top:24px;">
    <div class="card card-p">
        <h3>💳 Pending Payments</h3>
        @if($pendingPayments->count())
            <table class="table-x" style="margin-top:10px;">
                @foreach($pendingPayments as $payment)
                    <tr>
                        <td><a href="{{ route('admin.payments.index') }}"><strong>{{ $payment->voucher_no }}</strong></a><br>
                            <span class="muted">{{ $payment->invoice->number }} · {{ $payment->invoice->user?->name }}</span></td>
                        <td>৳ {{ number_format((float) $payment->amount, 2) }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p class="muted">{{ __('site.admin.no_data') }}</p>
        @endif
    </div>

    <div class="card card-p">
        <h3>📥 {{ __('site.admin.leads') }}</h3>
        @if($recentLeads->count())
            <table class="table-x" style="margin-top:10px;">
                @foreach($recentLeads as $lead)
                    <tr>
                        <td><strong>{{ $lead->name }}</strong><br><span class="muted">{{ $lead->email }} · {{ $lead->phone }}</span></td>
                        <td><span class="pill {{ $lead->status === 'new' ? 'pill-warn' : '' }}">{{ $lead->status }}</span></td>
                    </tr>
                @endforeach
            </table>
            <a class="btn btn-outline btn-sm" style="margin-top:10px;" href="{{ route('admin.leads.index') }}">{{ __('site.admin.view') }}</a>
        @else
            <p class="muted">{{ __('site.admin.no_data') }}</p>
        @endif
    </div>
</div>
@endsection
