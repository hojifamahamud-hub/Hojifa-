@extends('layouts.app')

@section('title', $project->title().' — '.site_name())
@section('meta_desc', \Illuminate\Support\Str::limit((string) $project->description(), 155))

@section('content')
<section class="section">
    <div class="container-x" style="max-width:900px;">
        <a href="{{ route('portfolio.index') }}" class="muted">← {{ __('site.nav.portfolio') }}</a>
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-top:12px;">
            @if($project->category)<span class="pill">{{ t($project->category->name_bn, $project->category->name_en) }}</span>@endif
            @if($project->client)<span class="muted">👤 {{ $project->client }}</span>@endif
        </div>
        <h1 style="margin-top:10px;">{{ $project->title() }}</h1>

        <div class="card" style="margin-top:20px;overflow:hidden;">
            @if($project->images->count())
                <div style="display:grid;grid-template-columns:1fr;gap:2px;">
                    @foreach($project->images as $image)
                        <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $project->title() }}" style="width:100%;">
                    @endforeach
                </div>
            @elseif(data_get($project->before_after, 'after'))
                <img src="{{ asset('storage/'.data_get($project->before_after, 'after')) }}" alt="{{ $project->title() }}" style="width:100%;">
            @endif
        </div>

        @if(is_array($project->before_after) && ($project->before_after['before'] ?? null))
            <h2 style="margin-top:32px;">Before / After</h2>
            <div class="before-after">
                <div class="card" style="overflow:hidden;">
                    <div class="pill pill-warn" style="margin:10px;">Before</div>
                    <img src="{{ asset('storage/'.data_get($project->before_after, 'before')) }}" style="width:100%;" alt="before">
                </div>
                <div class="card" style="overflow:hidden;">
                    <div class="pill pill-good" style="margin:10px;">After</div>
                    @if(data_get($project->before_after, 'after'))
                        <img src="{{ asset('storage/'.data_get($project->before_after, 'after')) }}" style="width:100%;" alt="after">
                    @endif
                </div>
            </div>
        @endif

        @if(is_array($project->metrics) && $project->metrics)
            <h2 style="margin-top:32px;">📊 Results</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;margin-top:14px;">
                @foreach($project->metrics as $metric)
                    <div class="card card-p" style="text-align:center;">
                        <div style="font-size:26px;font-weight:800;color:var(--brand);">{{ $metric['value'] ?? '' }}</div>
                        <div class="muted">{{ $metric['label'] ?? '' }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="card card-p" style="margin-top:32px;">
            <h3>{{ __('site.requirement.details') }}</h3>
            {!! nl2br(e((string) $project->description())) !!}
            @if($project->live_url)
                <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="btn btn-gradient btn-sm" style="margin-top:12px;">🔗 Live</a>
            @endif
        </div>

        @if($related->count())
            <h2 style="margin-top:40px;">{{ __('site.home.portfolio') }}</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;margin-top:14px;">
                @foreach($related as $r)
                    <a href="{{ route('portfolio.show', $r) }}" class="card card-p" style="text-decoration:none;">
                        <h3>{{ $r->title() }}</h3>
                        <p class="muted">{{ \Illuminate\Support\Str::limit((string) $r->description(), 80) }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
