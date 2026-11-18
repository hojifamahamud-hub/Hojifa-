@extends('layouts.app')

@section('title', t($page?->meta_title_bn, $page?->meta_title_en) ?: __('site.nav.services').' — '.site_name())
@section('meta_desc', t($page?->meta_desc_bn, $page?->meta_desc_en) ?: __('site.home.services_sub'))

@section('content')
<section class="hero-gradient" style="padding:56px 0;">
    <div class="container-x">
        <span class="hero-badge">{{ __('site.nav.services') }}</span>
        <h1 style="margin-top:14px;">{{ t($page?->title_bn, $page?->title_en) ?: __('site.nav.services') }}</h1>
        @if($page)
            <div style="max-width:760px;">{!! $page->content_bn !!}</div>
        @endif
    </div>
</section>

@if($services->count())
<section class="section">
    <div class="container-x">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:18px;">
            @foreach($services as $service)
                <div class="card card-p">
                    <div style="font-size:30px;margin-bottom:8px;">{{ $service->icon ?: '⚡' }}</div>
                    <h3>{{ t($service->title_bn, $service->title_en) }}</h3>
                    <p class="muted">{!! nl2br(e((string) t($service->description_bn, $service->description_en))) !!}</p>
                    @if(is_array($service->features))
                        <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:6px;margin-top:12px;">
                            @foreach($service->features as $feature)
                                <li style="font-size:14px;">✅ {{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($responsibilities->count())
<section class="section section-alt">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.responsibility') }}</span>
        <h2>{{ __('site.nav.experience') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:18px;margin-top:24px;">
            @foreach($responsibilities as $item)
                <div class="card card-p">
                    <span style="font-size:26px;">{{ $item->icon ?: '🛠️' }}</span>
                    <h3>{{ t($item->title_bn, $item->title_en) }}</h3>
                    <p class="muted">{{ t($item->description_bn, $item->description_en) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($skills->count())
<section class="section">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.skills') }}</span>
        <h2>{{ __('site.nav.skills') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:32px;margin-top:24px;">
            @foreach($skills as $categoryName => $items)
                <div class="card card-p">
                    <h3 style="margin-bottom:14px;">{{ $categoryName }}</h3>
                    @foreach($items as $skill)
                        <div style="margin-bottom:12px;">
                            <div style="display:flex;justify-content:space-between;font-size:14.5px;font-weight:600;">
                                <span>{{ t($skill->name_bn, $skill->name_en) }}</span>
                                <span class="muted">{{ $skill->level }}%</span>
                            </div>
                            <div class="skill-bar" style="margin-top:5px;"><span style="width:{{ max(5, min(100, $skill->level)) }}%;"></span></div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<div class="section section-alt" style="text-align:center;">
    <div class="container-x">
        <h2>{{ __('site.home.cta_title') }}</h2>
        <p class="section-sub" style="margin:8px auto 18px;">{{ __('site.home.cta_text') }}</p>
        <a href="{{ route('requirement.show') }}" class="btn btn-gradient">{{ __('site.nav.hire') }}</a>
    </div>
</div>
@endsection
