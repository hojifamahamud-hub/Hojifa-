@extends('layouts.app')

@section('title', t($page?->meta_title_bn, $page?->meta_title_en) ?: __('site.nav.about').' — '.site_name())
@section('meta_desc', t($page?->meta_desc_bn, $page?->meta_desc_en))

@section('content')
<section class="hero-gradient" style="padding:56px 0;">
    <div class="container-x">
        <span class="hero-badge">{{ __('site.nav.about') }}</span>
        <h1 style="margin-top:14px;">{{ t($page?->title_bn, $page?->title_en) ?: site_name() }}</h1>
    </div>
</section>

@if($page)
<section class="section">
    <div class="container-x" style="max-width:840px;">
        {!! $page->content_bn !!}
    </div>
</section>
@endif

@if($stats->count())
<section class="section section-alt">
    <div class="container-x">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;">
            @foreach($stats as $stat)
                <div class="card card-p" style="text-align:center;">
                    <div style="font-size:30px;font-weight:800;color:var(--brand);">{{ $stat->value }}</div>
                    <div class="muted">{{ t($stat->label_bn, $stat->label_en) }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($team->count())
<section class="section">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.team') }}</span>
        <h2>{{ __('site.home.team_sub') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px;margin-top:24px;">
            @foreach($team as $member)
                <div class="card card-p" style="text-align:center;">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" style="width:100px;height:100px;object-fit:cover;border-radius:999px;margin:0 auto 10px;">
                    @else
                        <div style="width:100px;height:100px;border-radius:999px;background:var(--soft);color:var(--brand);display:flex;align-items:center;justify-content:center;font-size:30px;font-weight:800;margin:0 auto 10px;">{{ mb_substr($member->name, 0, 1) }}</div>
                    @endif
                    <h3>{{ $member->name }}</h3>
                    <p class="muted">{{ t($member->role_bn, $member->role_en) }}</p>
                    @if($member->bio_bn)
                        <p class="muted" style="font-size:13.5px;">{{ \Illuminate\Support\Str::limit((string) t($member->bio_bn, $member->bio_en), 120) }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($certificates->count())
<section class="section section-alt">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.certificates') }}</span>
        <h2>{{ __('site.home.certificates_sub') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px;margin-top:24px;">
            @foreach($certificates as $certificate)
                <div class="card" style="overflow:hidden;">
                    @if($certificate->image)
                        <img class="thumb" style="border-radius:0;" src="{{ asset('storage/'.$certificate->image) }}" alt="{{ t($certificate->title_bn, $certificate->title_en) }}" loading="lazy">
                    @endif
                    <div class="card-p" style="padding:14px;">
                        <h3 style="font-size:16px;">{{ t($certificate->title_bn, $certificate->title_en) }}</h3>
                        <p class="muted">{{ $certificate->issuer }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
