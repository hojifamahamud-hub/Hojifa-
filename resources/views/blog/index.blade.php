@extends('layouts.app')

@section('title', __('site.nav.blog').' — '.site_name())
@section('meta_desc', __('site.nav.blog'))

@section('content')
<section class="hero-gradient" style="padding:56px 0;">
    <div class="container-x">
        <span class="hero-badge">{{ __('site.nav.blog') }}</span>
        <h1 style="margin-top:14px;">{{ __('site.nav.blog') }}</h1>
        <form method="GET" action="{{ route('blog.index') }}" style="margin-top:18px;display:flex;gap:8px;max-width:480px;">
            <input name="q" class="input" value="{{ $search }}" placeholder="{{ __('site.admin.search') }}...">
            <button class="btn btn-gradient">🔍</button>
        </form>
    </div>
</section>

<section class="section">
    <div class="container-x">
        @if($posts->count())
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;">
                @foreach($posts as $post)
                    <a class="card" href="{{ route('blog.show', $post) }}" style="text-decoration:none;overflow:hidden;display:block;">
                        @if($post->image)
                            <img class="thumb" style="border-radius:0;" src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title() }}" loading="lazy">
                        @endif
                        <div class="card-p" style="padding:18px;">
                            @if($post->category())<span class="pill">{{ $post->category() }}</span>@endif
                            <h3 style="margin-top:6px;">{{ $post->title() }}</h3>
                            <p class="muted">{{ \Illuminate\Support\Str::limit((string) $post->excerpt(), 100) }}</p>
                            @if($post->published_at)<p class="muted">📅 {{ $post->published_at->format('j M Y') }} · 👁 {{ $post->views }}</p>@endif
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="pagination-x" style="margin-top:28px;">{{ $posts->onEachSide(1)->links('vendor.pagination.custom') }}</div>
        @else
            <div class="card card-p" style="text-align:center;color:var(--muted);">{{ __('site.admin.no_data') }}</div>
        @endif
    </div>
</section>
@endsection
