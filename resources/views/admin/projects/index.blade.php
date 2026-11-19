@extends('layouts.admin')

@section('title', __('site.admin.projects'))

@section('content')
<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
    <h1>{{ __('site.admin.projects') }}</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-gradient btn-sm" style="margin-left:auto;">+ {{ __('site.admin.add') }}</a>
</div>

<div style="display:flex;gap:8px;flex-wrap:wrap;margin:14px 0;">
    <a class="pill {{ !$categoryId ? 'pill-good' : '' }}" href="{{ route('admin.projects.index') }}">{{ __('site.admin.all') }}</a>
    @foreach($categories as $category)
        <a class="pill {{ $categoryId == $category->id ? 'pill-good' : '' }}" href="{{ route('admin.projects.index', ['category' => $category->id]) }}">{{ t($category->name_bn, $category->name_en) }}</a>
    @endforeach
</div>

<div class="card" style="overflow-x:auto;">
    <table class="table-x">
        <tr><th>ID</th><th>{{ __('site.dashboard.task_title') }}</th><th>Category</th><th>Featured</th><th>Active</th><th>{{ __('site.admin.actions') }}</th></tr>
        @forelse($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td><strong>{{ $project->title_bn }}</strong><br><span class="muted">{{ $project->title_en }}</span></td>
                <td>{{ $project->category?->name_bn }}</td>
                <td>{{ $project->featured ? '✔' : '✖' }}</td>
                <td>{{ $project->active ? '✔' : '✖' }}</td>
                <td style="display:flex;gap:6px;">
                    <a class="btn btn-outline btn-sm" href="{{ route('admin.projects.edit', $project) }}">{{ __('site.admin.edit') }}</a>
                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('{{ __('site.admin.delete') }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">{{ __('site.admin.delete') }}</button>
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
