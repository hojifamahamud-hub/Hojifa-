@extends('layouts.admin')

@section('title', __('site.admin.chats'))

@section('content')
<a href="{{ route('admin.chats.index') }}" class="muted">← {{ __('site.admin.chats') }}</a>
<h1 style="margin-top:8px;">{{ $conversation->name ?? 'Guest' }} <span class="muted">{{ $conversation->email }}</span></h1>

<div class="card" style="max-width:720px;margin-top:14px;">
    <div class="chat-body" style="max-height:60vh;">
        @foreach($conversation->messages as $message)
            <div class="chat-msg {{ $message->sender === 'visitor' ? 'ai' : 'user' }}">
                <span class="muted" style="font-size:11.5px;">{{ $message->sender }}</span><br>{{ $message->body }}
            </div>
        @endforeach
    </div>
    <form method="POST" action="{{ route('admin.chats.reply', $conversation) }}" style="display:flex;gap:8px;padding:12px;border-top:1px solid var(--line);">
        @csrf
        <input name="body" class="input" placeholder="{{ __('site.chat.send') }}..." required>
        <button class="btn btn-gradient btn-sm">➤</button>
    </form>
</div>
@endsection
