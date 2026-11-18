@extends('layouts.admin')

@section('title', __('site.admin.client_projects'))

@section('content')
<h1>{{ __('site.admin.client_projects') }}</h1>

<div class="card card-p" style="max-width:860px;margin-top:14px;">
    <h3>+ {{ __('site.admin.add') }}</h3>
    <form method="POST" action="{{ route('admin.client-projects.store') }}" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:10px;margin-top:10px;">
        @csrf
        <input name="user_id" type="number" class="input" placeholder="User ID" required>
        <input name="title" class="input" placeholder="{{ __('site.dashboard.task_title') }}" required>
        <input name="category" class="input" placeholder="Category">
        <input name="budget" type="number" step="0.01" class="input" placeholder="Budget">
        <select name="status" class="select">
            @foreach(['pending', 'active', 'completed', 'cancelled'] as $s)<option value="{{ $s }}">{{ $s }}</option>@endforeach
        </select>
        <button class="btn btn-gradient">{{ __('site.admin.save') }}</button>
    </form>
    <textarea name="description" class="textarea" rows="2" form="noop" style="display:none;"></textarea>
</div>

<div class="card" style="overflow-x:auto;margin-top:16px;">
    <table class="table-x">
        <tr><th>ID</th><th>Client</th><th>Title</th><th>Budget</th><th>Status</th><th>{{ __('site.admin.actions') }}</th></tr>
        @forelse($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->user?->name }}</td>
                <td><strong>{{ $project->title }}</strong><div class="muted">{{ \Illuminate\Support\Str::limit((string) $project->description, 80) }}</div></td>
                <td>৳ {{ number_format((float) $project->budget, 2) }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.client-projects.update', $project) }}" style="display:flex;gap:6px;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="user_id" value="{{ $project->user_id }}">
                        <input type="hidden" name="title" value="{{ $project->title }}">
                        <select name="status" class="select" style="width:120px;">
                            @foreach(['pending', 'active', 'completed', 'cancelled'] as $s)<option value="{{ $s }}" @selected($project->status === $s)>{{ $s }}</option>@endforeach
                        </select>
                        <button class="btn btn-outline btn-sm">✓</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.client-projects.destroy', $project) }}" onsubmit="return confirm('{{ __('site.admin.delete') }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>
<div class="pagination-x" style="margin-top:18px;">{{ $projects->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
