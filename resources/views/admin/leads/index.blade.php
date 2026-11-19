@extends('layouts.admin')

@section('title', __('site.admin.leads'))

@section('content')
<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
    <h1>{{ __('site.admin.leads') }}</h1>
    <a href="{{ route('admin.leads.export') }}" class="btn btn-outline btn-sm" style="margin-left:auto;">⬇ {{ __('site.admin.export') }}</a>
</div>

<form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;margin:14px 0;">
    <input name="q" class="input" style="max-width:220px;" value="{{ $q }}" placeholder="{{ __('site.admin.search') }}">
    <select name="status" class="select" style="max-width:170px;">
        <option value="">{{ __('site.admin.all') }} — {{ __('site.dashboard.status') }}</option>
        @foreach(['new', 'contacted', 'won', 'lost'] as $statusOption)
            <option value="{{ $statusOption }}" @selected($status === $statusOption)>{{ $statusOption }}</option>
        @endforeach
    </select>
    <select name="type" class="select" style="max-width:170px;">
        <option value="">{{ __('site.admin.all') }} — type</option>
        <option value="consult" @selected($type === 'consult')>consult</option>
        <option value="requirement" @selected($type === 'requirement')>requirement</option>
    </select>
    <button class="btn btn-outline btn-sm">{{ __('site.admin.filter') }}</button>
</form>

<div class="card" style="overflow-x:auto;">
    <table class="table-x">
        <tr><th>ID</th><th>Name</th><th>Contact</th><th>Detail</th><th>{{ __('site.dashboard.status') }}</th><th>Notes</th></tr>
        @forelse($leads as $lead)
            <tr>
                <td>{{ $lead->id }}<div class="muted">{{ $lead->type }}<br>{{ $lead->created_at->format('j M y') }}</div></td>
                <td><strong>{{ $lead->name }}</strong></td>
                <td>{{ $lead->email }}<br>{{ $lead->phone }}</td>
                <td style="max-width:280px;">{{ \Illuminate\Support\Str::limit((string) $lead->message, 140) }}
                    @if($lead->budget)<div class="muted">Budget: {{ $lead->budget }} · Timeline: {{ $lead->timeline }}</div>@endif
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.leads.update', $lead) }}" style="display:flex;gap:6px;">
                        @csrf @method('PATCH')
                        <select name="status" class="select" style="width:120px;">
                            @foreach(['new', 'contacted', 'won', 'lost'] as $statusOption)
                                <option value="{{ $statusOption }}" @selected($lead->status === $statusOption)>{{ $statusOption }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline btn-sm">✓</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.leads.update', $lead) }}" style="display:flex;gap:6px;max-width:200px;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $lead->status }}">
                        <input name="admin_notes" class="input" value="{{ $lead->admin_notes }}" placeholder="Notes">
                        <button class="btn btn-outline btn-sm">✓</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $leads->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
