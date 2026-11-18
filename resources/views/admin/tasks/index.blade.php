@extends('layouts.admin')

@section('title', __('site.admin.tasks'))

@section('content')
<h1>{{ __('site.admin.tasks') }}</h1>

<div class="card card-p" style="max-width:860px;margin-top:14px;">
    <h3>+ {{ __('site.admin.add') }}</h3>
    <form method="POST" action="{{ route('admin.tasks.store') }}" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;margin-top:10px;">
        @csrf
        <select name="assignee_id" class="select" required>
            <option value="">— {{ __('site.admin.assigned_to') }} —</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->role }})</option>
            @endforeach
        </select>
        <input name="title" class="input" placeholder="{{ __('site.admin.tasks') }}" required>
        <input name="due_date" type="date" class="input">
        <button class="btn btn-gradient">{{ __('site.admin.save') }}</button>
    </form>
    @error('assignee_id')<p class="field-error">{{ $message }}</p>@enderror
    @error('title')<p class="field-error">{{ $message }}</p>@enderror
</div>

<form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;margin:16px 0;">
    <select name="assignee" class="select" style="max-width:200px;">
        <option value="">{{ __('site.admin.all') }}</option>
        @foreach($members as $member)
            <option value="{{ $member->id }}" @selected($assignee == $member->id)>{{ $member->name }}</option>
        @endforeach
    </select>
    <button class="btn btn-outline btn-sm">{{ __('site.admin.filter') }}</button>
</form>

<div style="display:flex;flex-direction:column;gap:12px;">
    @forelse($tasks as $task)
        <div class="card card-p">
            <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                <div>
                    <h3>{{ $task->title }}</h3>
                    <p class="muted">{{ $task->description }} <strong>👤 {{ $task->assignee?->name }}</strong> @if($task->due_date) · 📅 {{ $task->due_date->format('j M Y') }} @endif</p>
                </div>
                <div style="display:flex;gap:8px;align-items:flex-start;">
                    <span class="pill {{ $task->status === 'completed' ? 'pill-good' : 'pill-warn' }}">{{ $task->status }} {{ $task->progress }}%</span>
                    <form method="POST" action="{{ route('admin.tasks.destroy', $task) }}" onsubmit="return confirm('{{ __('site.admin.delete') }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑</button>
                    </form>
                </div>
            </div>
            <div class="skill-bar" style="margin:10px 0;"><span style="width:{{ $task->progress }}%;"></span></div>
            <form method="POST" action="{{ route('admin.tasks.status', $task) }}" style="display:flex;gap:8px;flex-wrap:wrap;">
                @csrf @method('PATCH')
                <select name="status" class="select" style="max-width:160px;">
                    @foreach(['assigned', 'in_progress', 'review', 'completed'] as $s)
                        <option value="{{ $s }}" @selected($task->status === $s)>{{ $s }}</option>
                    @endforeach
                </select>
                <input type="number" name="progress" min="0" max="100" value="{{ $task->progress }}" class="input" style="max-width:110px;">
                <button class="btn btn-outline btn-sm">✓</button>
            </form>
            @if($task->member_notes)<p class="muted" style="margin-top:8px;">📝 {{ $task->member_notes }}</p>@endif
        </div>
    @empty
        <div class="card card-p" style="text-align:center;color:var(--muted);">{{ __('site.admin.no_data') }}</div>
    @endforelse
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $tasks->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
