@extends('layouts.app')

@section('title', __('site.dashboard.team').' — '.site_name())

@section('content')
<section class="section">
    <div class="container-x">
        <h1>{{ __('site.dashboard.team') }}</h1>
        <span class="pill">{{ $user->name }}</span>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;margin-top:20px;">
            <div class="card card-p"><div class="muted">{{ __('site.admin.pending') }}</div><div style="font-size:26px;font-weight:800;color:var(--warn);">{{ $activeCount }}</div></div>
            <div class="card card-p"><div class="muted">{{ __('site.dashboard.approved') }}</div><div style="font-size:26px;font-weight:800;color:var(--good);">{{ $completedCount }}</div></div>
            <div class="card card-p"><div class="muted">{{ __('site.admin.tasks') }}</div><div style="font-size:26px;font-weight:800;">{{ $tasks->count() }}</div></div>
        </div>

        <div style="display:flex;flex-direction:column;gap:14px;margin-top:24px;">
            @forelse($tasks as $task)
                <div class="card card-p">
                    <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                        <div>
                            <h3>{{ $task->title }}</h3>
                            <p class="muted">{{ $task->description }}</p>
                            @if($task->due_date)<p class="muted">{{ __('site.dashboard.deadline') }}: {{ $task->due_date->format('j M Y') }}</p>@endif
                        </div>
                        <span class="pill {{ $task->status === 'completed' ? 'pill-good' : 'pill-warn' }}">{{ $task->status }}</span>
                    </div>

                    <div class="skill-bar" style="margin:10px 0;"><span style="width:{{ $task->progress }}%;"></span></div>

                    <form method="POST" action="{{ route('team.tasks.update', $task) }}" style="display:grid;grid-template-columns:140px 120px 1fr auto;gap:10px;align-items:end;">
                        @csrf @method('PATCH')
                        <div>
                            <label class="label">{{ __('site.dashboard.status') }}</label>
                            <select name="status" class="select">
                                @foreach(['assigned' => 'Assigned', 'in_progress' => 'In Progress', 'review' => 'Review', 'completed' => 'Completed'] as $status => $label)
                                    <option value="{{ $status }}" @selected($task->status === $status)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="label">% {{ __('site.dashboard.progress') }}</label>
                            <input type="number" name="progress" min="0" max="100" value="{{ $task->progress }}" class="input">
                        </div>
                        <div>
                            <label class="label">{{ __('site.dashboard.note') }}</label>
                            <input name="member_notes" class="input" value="{{ $task->member_notes }}">
                        </div>
                        <button class="btn btn-gradient">{{ __('site.dashboard.save') }}</button>
                    </form>
                </div>
            @empty
                <div class="card card-p" style="text-align:center;color:var(--muted);">{{ __('site.admin.no_data') }}</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
