@extends('layouts.admin')

@section('title', __('site.admin.visitors'))

@section('content')
<h1>{{ __('site.admin.visitors') }} <span class="muted">({{ $visitors->total() }})</span></h1>

<form method="GET" style="display:flex;gap:8px;margin:14px 0;">
    <input name="q" class="input" style="max-width:260px;" value="{{ $q }}" placeholder="Email {{ __('site.admin.search') }}">
    <button class="btn btn-outline btn-sm">{{ __('site.admin.search') }}</button>
</form>

<div class="card" style="overflow-x:auto;">
    <table class="table-x">
        <tr><th>Email</th><th>Visits</th><th>IP</th><th>First</th><th>Last</th><th>Source</th><th></th></tr>
        @forelse($visitors as $visitor)
            <tr>
                <td><strong>{{ $visitor->email }}</strong></td>
                <td><span class="pill">{{ $visitor->visits }}</span></td>
                <td class="muted">{{ $visitor->ip }}</td>
                <td class="muted">{{ $visitor->first_visited_at?->format('j M y H:i') }}</td>
                <td class="muted">{{ $visitor->last_visited_at?->format('j M y H:i') }}</td>
                <td class="muted" style="max-width:220px;">{{ \Illuminate\Support\Str::limit((string) $visitor->source, 50) }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.visitors.destroy', $visitor) }}" onsubmit="return confirm('?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">{{ __('site.admin.delete') }}</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $visitors->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
