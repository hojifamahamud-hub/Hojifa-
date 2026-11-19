@extends('layouts.admin')

@section('title', __('site.admin.users'))

@section('content')
<h1>{{ __('site.admin.users') }}</h1>

<form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;margin:14px 0;">
    <input name="q" class="input" style="max-width:220px;" value="{{ $q }}" placeholder="{{ __('site.admin.search') }}">
    <select name="role" class="select" style="max-width:150px;">
        <option value="">{{ __('site.admin.all') }}</option>
        @foreach(['client', 'member', 'admin'] as $r)<option value="{{ $r }}" @selected($role === $r)>{{ $r }}</option>@endforeach
    </select>
    <select name="status" class="select" style="max-width:150px;">
        <option value="">{{ __('site.admin.all') }}</option>
        @foreach(['active', 'pending', 'suspended'] as $s)<option value="{{ $s }}" @selected($status === $s)>{{ $s }}</option>@endforeach
    </select>
    <button class="btn btn-outline btn-sm">{{ __('site.admin.filter') }}</button>
</form>

<div class="card" style="overflow-x:auto;">
    <table class="table-x">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>{{ __('site.admin.role') }}</th><th>{{ __('site.admin.status') }}</th><th>Joined</th><th></th></tr>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><strong>{{ $user->name }}</strong>@if($user->phone)<div class="muted">{{ $user->phone }}</div>@endif</td>
                <td>{{ $user->email }}</td>
                <td class="pill">{{ $user->role }}</td>
                <td><span class="pill {{ $user->status === 'active' ? 'pill-good' : ($user->status === 'pending' ? 'pill-warn' : 'pill-bad') }}">{{ $user->status }}</span></td>
                <td class="muted">{{ $user->created_at->format('j M y') }}</td>
                <td style="display:flex;gap:6px;">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" style="display:flex;gap:6px;">
                        @csrf @method('PATCH')
                        <select name="role" class="select" style="width:110px;">
                            @foreach(['client', 'member', 'admin'] as $r)<option value="{{ $r }}" @selected($user->role === $r)>{{ $r }}</option>@endforeach
                        </select>
                        <select name="status" class="select" style="width:110px;">
                            @foreach(['active', 'pending', 'suspended'] as $s)<option value="{{ $s }}" @selected($user->status === $s)>{{ $s }}</option>@endforeach
                        </select>
                        <button class="btn btn-outline btn-sm">✓</button>
                    </form>
                    @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('{{ __('site.admin.delete') }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $users->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
