@extends('layouts.app')

@section('title', $post->metaTitle().' — '.site_name())
@section('meta_desc', $post->metaDesc())

@section('content')
<article class="section">
    <div class="container-x" style="max-width:780px;">
        <a href="{{ route('blog.index') }}" class="muted">← {{ __('site.nav.blog') }}</a>
        @if($post->category())<span class="pill" style="margin-left:10px;">{{ $post->category() }}</span>@endif
        <h1 style="margin-top:12px;">{{ $post->title() }}</h1>
        <p class="muted">
            📅 {{ $post->published_at?->format('j M Y') }} · 👁 {{ $post->views }} {{ __('site.home.blog') }}
        </p>
        @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title() }}" style="width:100%;border-radius:14px;margin:16px 0;">
        @endif
        <div class="card card-p" style="font-size:16.5px;">
            {!! nl2br(e((string) $post->content())) !!}
        </div>

        @if($related->count())
            <h2 style="margin-top:40px;">{{ __('site.home.blog') }}</h2>
            <div style="display:flex;flex-direction:column;gap:10px;margin-top:14px;">
                @foreach($related as $r)
                    <a class="card card-p" href="{{ route('blog.show', $r) }}" style="text-decoration:none;">
                        <h3 style="font-size:16px;">{{ $r->title() }}</h3>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</article>
@endsection
