@extends('layouts.admin')

@section('title', __('site.admin.chats'))

@section('content')
<h1>{{ __('site.admin.chats') }}</h1>

<div class="card" style="margin-top:14px;overflow-x:auto;">
    <table class="table-x">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Type</th><th>Messages</th><th>{{ __('site.dashboard.status') }}</th><th></th></tr>
        @forelse($conversations as $conversation)
            <tr>
                <td>{{ $conversation->id }}</td>
                <td>{{ $conversation->name ?? 'Guest' }}</td>
                <td class="muted">{{ $conversation->email }}</td>
                <td><span class="pill">{{ $conversation->type }}</span></td>
                <td>{{ $conversation->messages_count }}</td>
                <td>@if($conversation->unread)<span class="pill pill-warn">Unread</span>@else<span class="pill pill-good">Read</span>@endif</td>
                <td><a class="btn btn-outline btn-sm" href="{{ route('admin.chats.show', $conversation) }}">{{ __('site.admin.view') }}</a></td>
            </tr>
        @empty
            <tr><td colspan="7" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $conversations->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
