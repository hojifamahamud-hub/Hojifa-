@extends('layouts.admin')

@section('title', __('site.admin.projects'))

@section('content')
<a href="{{ route('admin.projects.index') }}" class="muted">← {{__('site.admin.back')}}</a>
<h1 style="margin-top:8px;">{{ $project ? __('site.admin.edit') : __('site.admin.add') }}</h1>

<form method="POST" enctype="multipart/form-data"
      action="{{ $project ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
      class="card card-p" style="max-width:820px;margin-top:14px;">
    @csrf
    @if($project) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px;">
        <div><label class="label">শিরোনাম (বাংলা) *</label><input name="title_bn" class="input" value="{{ old('title_bn', $project?->title_bn) }}" required></div>
        <div><label class="label">শিরোনাম (ইংরেজি)</label><input name="title_en" class="input" value="{{ old('title_en', $project?->title_en) }}"></div>
        <div><label class="label">স্লাগ (খালি রাখলে অটো)</label><input name="slug" class="input" value="{{ old('slug', $project?->slug) }}"></div>
        <div>
            <label class="label">ক্যাটাগরি</label>
            <select name="portfolio_category_id" class="select">
                <option value="">—</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('portfolio_category_id', $project?->portfolio_category_id) == $category->id)>{{ t($category->name_bn, $category->name_en) }}</option>
                @endforeach
            </select>
        </div>
        <div><label class="label">ক্লায়েন্ট</label><input name="client" class="input" value="{{ old('client', $project?->client) }}"></div>
        <div><label class="label">লাইভ URL</label><input name="live_url" class="input" value="{{ old('live_url', $project?->live_url) }}"></div>
        <div><label class="label">সর্ট</label><input type="number" name="sort" class="input" value="{{ old('sort', $project?->sort ?? 0) }}"></div>
        <div style="display:flex;flex-direction:column;gap:6px;">
            <label><input type="checkbox" name="featured" value="1" @checked($project?->featured ?? false)> Featured</label>
            <label><input type="checkbox" name="active" value="1" @checked($project?->active ?? true)> দৃশ্যমান</label>
        </div>
    </div>

    <div style="margin-top:14px;">
        <label class="label">বিবরণ (বাংলা)</label>
        <textarea name="description_bn" class="textarea" rows="4">{{ old('description_bn', $project?->description_bn) }}</textarea>
    </div>
    <div style="margin-top:14px;">
        <label class="label">বিবরণ (ইংরেজি)</label>
        <textarea name="description_en" class="textarea" rows="4">{{ old('description_en', $project?->description_en) }}</textarea>
    </div>

    <h3 style="margin-top:20px;">📊 Results / Metrics</h3>
    <div id="metricRows" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:10px;">
        @php $metricRows = old('metric_label') ?: ($project?->metrics ?? []); @endphp
        @foreach($metricRows as $i => $row)
            <div style="display:flex;gap:8px;">
                <input name="metric_label[{{ $i }}]" class="input" placeholder="Label" value="{{ is_array($row) ? ($row['label'] ?? '') : $row }}">
                <input name="metric_value[{{ $i }}]" class="input" placeholder="120+" value="{{ is_array($row) ? ($row['value'] ?? '') : (old('metric_value')[$i] ?? '') }}">
            </div>
        @endforeach
        <div style="display:flex;gap:8px;">
            <input name="metric_label[]" class="input" placeholder="Label">
            <input name="metric_value[]" class="input" placeholder="120+">
        </div>
    </div>

    <h3 style="margin-top:20px;">🖼 Before / After</h3>
    @if(is_array($project?->before_after) && ($project->before_after['before'] ?? null))
        <img src="{{ asset('storage/'.$project->before_after['before']) }}" style="height:70px;border-radius:6px;margin-right:8px;">
    @endif
    @if(is_array($project?->before_after) && ($project->before_after['after'] ?? null))
        <img src="{{ asset('storage/'.$project->before_after['after']) }}" style="height:70px;border-radius:6px;">
    @endif
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-top:10px;">
        <div><label class="label">Before ছবি</label><input type="file" name="before_image" accept="image/*" class="input" style="padding:8px;"></div>
        <div><label class="label">After ছবি</label><input type="file" name="after_image" accept="image/*" class="input" style="padding:8px;"></div>
    </div>

    <h3 style="margin-top:20px;">🖼 {{ __('site.admin.images') }}</h3>
    <input type="file" name="images[]" accept="image/*" multiple class="input" style="padding:8px;">

    <div style="display:flex;gap:10px;margin-top:18px;">
        <button class="btn btn-gradient">{{ __('site.admin.save') }}</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">{{ __('site.admin.cancel') }}</a>
    </div>
</form>

@if($project && $project->images->count())
    <h3 style="margin-top:24px;">🖼 {{ __('site.admin.images') }}</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;margin-top:10px;">
        @foreach($project->images as $image)
            <div class="card" style="padding:8px;">
                <img src="{{ asset('storage/'.$image->path) }}" class="thumb">
                <form method="POST" action="{{ route('admin.project-images.destroy', $image) }}" style="margin-top:8px;" onsubmit="return confirm('{{ __('site.admin.delete_image') }}?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" style="width:100%;">{{ __('site.admin.delete_image') }}</button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection
