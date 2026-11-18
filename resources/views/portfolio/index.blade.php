@extends('layouts.app')

@section('title', __('site.nav.portfolio').($category ? ' — '.$category->name_bn : '').' — '.site_name())
@section('meta_desc', __('site.home.portfolio_sub'))

@section('content')
<section class="hero-gradient" style="padding:56px 0;">
    <div class="container-x">
        <span class="hero-badge">{{ __('site.nav.portfolio') }}</span>
        <h1 style="margin-top:14px;">{{ $category ? t($category->name_bn, $category->name_en) : __('site.home.portfolio') }}</h1>
        <p>{{ __('site.home.portfolio_sub') }}</p>
    </div>
</section>

<section class="section">
    <div class="container-x">
        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px;">
            <a class="pill {{ !$category ? 'pill-good' : '' }}" href="{{ route('portfolio.index') }}">{{ __('site.admin.all') }}</a>
            @foreach($categories as $cat)
                <a class="pill {{ $category?->id === $cat->id ? 'pill-good' : '' }}" href="{{ route('portfolio.index', $cat->slug) }}">{{ t($cat->name_bn, $cat->name_en) }}</a>
            @endforeach
        </div>

        @if($projects->count())
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;">
                @foreach($projects as $project)
                    <a href="{{ route('portfolio.show', $project) }}" class="card" style="text-decoration:none;overflow:hidden;display:block;">
                        @php $cover = $project->images->first()?->path ?: data_get($project->before_after, 'after'); @endphp
                        @if($cover)
                            <img class="thumb" style="border-radius:14px 14px 0 0;" loading="lazy" src="{{ asset('storage/'.$cover) }}" alt="{{ $project->title() }}">
                        @else
                            <div class="thumb" style="border-radius:14px 14px 0 0;display:flex;align-items:center;justify-content:center;font-size:40px;">🖼️</div>
                        @endif
                        <div class="card-p" style="padding:16px;">
                            @if($project->category)<span class="pill">{{ t($project->category->name_bn, $project->category->name_en) }}</span>@endif
                            <h3 style="margin-top:6px;">{{ $project->title() }}</h3>
                            <p class="muted">{{ \Illuminate\Support\Str::limit((string) $project->description(), 90) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="pagination-x" style="margin-top:28px;">{{ $projects->onEachSide(1)->links('vendor.pagination.custom') }}</div>
        @else
            <div class="card card-p" style="text-align:center;color:var(--muted);">{{ __('site.admin.no_data') }}</div>
        @endif
    </div>
</section>
@endsection
