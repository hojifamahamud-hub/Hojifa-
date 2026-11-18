@extends('layouts.app')

@section('title', setting('meta_title_bn') ?: site_name().' — '.(setting('tagline_en') ?: 'Digital Marketing Expert'))
@section('meta_desc', setting('meta_desc_bn') ?: setting('meta_desc_en'))

@php
$heroName = setting('hero_name_bn') ?: site_name();
$heroEyebrow = t(setting('hero_eyebrow_bn'), setting('hero_eyebrow_en')) ?: __("site.home.eyebrow");
$heroRole = t(setting('hero_role_bn'), setting('hero_role_en')) ?: __("site.home.role");
$heroTags = collect(preg_split('/\R/', (string) setting('hero_tags')) ?: [])->filter()->values();
$platformList = collect(preg_split('/\R/', (string) setting('platforms')) ?: [])->filter()->values();
$meetingOptions = collect(preg_split('/\R/', (string) setting('meeting_options')) ?: [])
    ->map(fn ($line) => array_pad(array_map('trim', explode('|', $line)), 3, ''))
    ->filter(fn ($parts) => $parts[0] !== '')
    ->values();
$showCalc = setting('show_calculator') !== '';
$showMeet = setting('show_meeting') !== '';
$showNews = setting('show_newsletter') !== '';
$showFaq = setting('show_faqs') !== '';
$currency = setting('currency') ?: '$';
$calcDiscount = (int) (setting('calc_discount_percent') ?: 10);
$calcMinItems = max(1, (int) (setting('calc_discount_min_items') ?: 3));
$videoEmbed = (string) setting('video_embed');
$secTitle = fn (string $key, string $fallback) => t(setting($key.'_bn'), setting($key.'_en')) ?: __($fallback);
$secIntro = fn (string $key, string $fallback) => t(setting($key.'_bn'), setting($key.'_en')) ?: __($fallback);
$aboutIntro = t(setting('about_intro_bn'), setting('about_intro_en')) ?: __('site.home.about_sub');
$aboutLines = collect(preg_split('/\R/', (string) t(setting('about_body_bn'), setting('about_body_en'))))
    ->map(fn ($line) => trim((string) $line))->filter()->values();
$driveItems = collect(preg_split('/\R/', (string) t(setting('about_drives_bn'), setting('about_drives_en'))))
    ->map(fn ($line) => trim((string) $line))->filter()->values();
$videoText = t(setting('video_text_bn'), setting('video_text_en')) ?: __('site.home.video_text');
$achTitle = t(setting('sec_achievements_title_bn'), setting('sec_achievements_title_en'));
$calcPayload = $calcItems->map(fn ($item) => [
    'id' => $item->id,
    'name' => $item->name(),
    'category' => $item->category(),
    'price' => (float) $item->price,
])->values();
@endphp

@section('content')
{{-- ===== Hero ===== --}}
<section class="hp-hero" id="home">
    <div class="container-x hp-hero-grid">
        <div>
            <span class="eyebrow">{{ $heroEyebrow }}</span>
            <h1><span class="gradient-text">{{ $heroName }}</span></h1>
            <h2 class="font-display">{{ $heroRole }}</h2>
            <p class="sub">{{ setting('hero_subtitle_bn') ?: setting('hero_subtitle_en') }}</p>
            <div class="hp-tags">
                @foreach($heroTags as $tag)
                    <span>{{ trim($tag) }}</span>
                @endforeach
            </div>
            <div class="hp-actions-row">
                <a href="{{ setting('hero_cta_url') ?: route('requirement.show') }}" class="btn btn-dark-hp">
                    {{ t(setting('hero_cta_bn'), setting('hero_cta_en')) }} <i data-lucide="arrow-right"></i>
                </a>
                <a href="#portfolio" class="btn btn-outline">{{ __('site.home.view_work') }}</a>
            </div>
        </div>
        <div class="portrait-stage">
            <div class="portrait-back"></div>
            <div class="portrait-art">
                @if(setting('hero_image'))
                    <img src="{{ asset('storage/'.setting('hero_image')) }}" alt="{{ $heroName }}">
                @else
                    <svg viewBox="0 0 390 425" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{{ $heroName }}">
                        <circle cx="195" cy="150" r="78" fill="#7fd6c9"/>
                        <path d="M40 425 C40 305 120 258 195 258 C270 258 350 305 350 425 Z" fill="#94e0d3"/>
                        <circle cx="170" cy="140" r="8" fill="#0f3d38"/>
                        <circle cx="220" cy="140" r="8" fill="#0f3d38"/>
                        <path d="M172 172 Q195 190 218 172" stroke="#0f3d38" stroke-width="5" fill="none" stroke-linecap="round"/>
                        <path d="M150 120 Q195 96 240 120 L240 104 Q195 78 150 104 Z" fill="#123c44"/>
                    </svg>
                @endif
            </div>
            @if($stats->count())
                <div class="float-stat hp-shadow top">
                    <strong>{{ $stats->first()->value }}</strong>
                    {{ $stats->first()->label() }}
                </div>
                @if($stats->count() > 1)
                    <div class="float-stat hp-shadow bottom" style="top:auto;">
                        <strong>{{ $stats->get(1)->value }}</strong>
                        {{ $stats->get(1)->label() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</section>

{{-- ===== Platforms ===== --}}
@if($platformList->count())
<section class="hp-platforms">
    <div class="container-x" style="text-align:center;">
        <span class="eyebrow">{{ __('site.home.platforms') }}</span>
        <div class="hp-platform-list">
            @foreach($platformList as $platform)
                <span>{{ trim($platform) }}</span>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== Achievements / stats ===== --}}
@if($stats->count())
<section class="section section-alt">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.achievements') }}</span>
            <h2 class="section-title">@if($achTitle){{ $achTitle }}@else{!! __('site.home.numbers_speak') !!}@endif</h2>
            <p class="section-intro">{{ $secIntro('sec_achievements', 'site.home.achievements_sub') }}</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;">
            @foreach($stats as $i => $stat)
                <article class="card hp-shadow" style="padding:24px;text-align:left;">
                    <span class="iconbox {{ ['c-blue', 'c-purple', 'c-orange', ''][($i % 4)] }}">
                        <span style="font-size:18px;">{{ ['💼', '👥', '🏅', '📈'][$i % 4] }}</span>
                    </span>
                    <span class="stat-value">{{ $stat->value }}</span>
                    <p style="font-size:13px;color:var(--muted);margin:0;">{{ $stat->label() }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== About ===== --}}
<section class="section" id="about">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.about_eyebrow') }}</span>
            <h2 class="section-title">{{ t(setting('about_heading_bn'), setting('about_heading_en')) ?: __('site.home.about_title') }}</h2>
            <p class="section-intro">{{ $aboutIntro }}</p>
        </div>
        <div class="hp-about-grid">
            <div>
                <h3 style="margin-top:0;">{{ __('site.home.about_hi', ['name' => $heroName]) }}</h3>
                @if($aboutLines->count())
                    @foreach($aboutLines as $aboutLine)
                        <p style="color:var(--muted);">{{ $aboutLine }}</p>
                    @endforeach
                @else
                    <p style="color:var(--muted);">{{ setting('hero_subtitle_bn') ?: setting('hero_subtitle_en') }}</p>
                    <p style="color:var(--muted);">{{ setting('footer_text_bn') ?: setting('tagline_bn') }}</p>
                @endif
                <h3>{{ __('site.home.drives_me') }}</h3>
                <ul class="hp-checks">
                    @if($driveItems->count())
                        @foreach($driveItems as $driveItem)
                            <li>{{ $driveItem }}</li>
                        @endforeach
                    @else
                        <li>{{ __('site.home.drive_1') }}</li>
                        <li>{{ __('site.home.drive_2') }}</li>
                        <li>{{ __('site.home.drive_3') }}</li>
                        <li>{{ __('site.home.drive_4') }}</li>
                    @endif
                </ul>
            </div>
            @if($responsibilities->count())
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;">
                    @foreach($responsibilities->take(4) as $i => $item)
                        <article class="card hp-shadow mini-card">
                            <span class="iconbox {{ ['c-purple', 'c-blue', 'c-orange', ''][$i % 4] }}" style="font-size:20px;">{{ $item->icon ?: '⚡' }}</span>
                            <div>
                                <h3>{{ $item->title() }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit((string) $item->description(), 90) }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ===== Skills ===== --}}
@if($skills->count())
<section class="section section-alt" id="skills">
    <div class="container-x" style="text-align:center;">
        <span class="eyebrow">{{ __('site.home.expertise') }}</span>
        <h2 class="section-title">{{ $secTitle('sec_skills', 'site.nav.skills') }}</h2>
        <p class="section-intro">{{ $secIntro('sec_skills', 'site.home.skills_sub') }}</p>
        <div class="hp-skills-box">
            @foreach($skills->flatten()->take(8) as $skill)
                <div class="skill">
                    <div class="hp-skill-head">
                        <span>{{ t($skill->name_bn, $skill->name_en) }}</span>
                        <span>{{ $skill->level }}%</span>
                    </div>
                    <div class="hp-track" role="progressbar" aria-label="{{ t($skill->name_bn, $skill->name_en) }}" aria-valuenow="{{ $skill->level }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="hp-fill" style="width:{{ max(5, min(100, $skill->level)) }}%;"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== Services ===== --}}
@if($services->count())
<section class="section" id="services">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.what_i_do') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_services', 'site.nav.services') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_services', 'site.home.services_sub') }}</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
            @foreach($services as $i => $service)
                <article class="card hp-shadow service-card">
                    <span class="iconbox {{ ['c-blue', 'c-purple', '', 'c-orange'][$i % 4] }}">
                        <span style="font-size:20px;">{{ $service->icon ?: '✦' }}</span>
                    </span>
                    <h3>{{ $service->title() }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit((string) $service->description(), 130) }}</p>
                    @if(is_array($service->features))
                        <ul>
                            @foreach(array_slice($service->features, 0, 6) as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('requirement.show') }}" class="btn btn-primary-hp full">{{ __('site.home.get_started') }}</a>
                </article>
            @endforeach
        </div>
        <div class="hp-banner">
            <h3>{{ t(setting('services_banner_title_bn'), setting('services_banner_title_en')) ?: __('site.home.cta_banner') }}</h3>
            <p>{{ t(setting('services_banner_text_bn'), setting('services_banner_text_en')) ?: __('site.home.cta_banner_sub') }}</p>
            <a class="btn btn-primary-hp" href="{{ route('requirement.show') }}">{{ __('site.home.start_project') }}</a>
        </div>
    </div>
</section>
@endif

{{-- ===== Pricing ===== --}}
@if($packages->count())
<section class="section section-alt" id="pricing">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.pricing_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_pricing', 'site.home.pricing_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_pricing', 'site.home.pricing_sub') }}</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
            @foreach($packages as $package)
                <article class="card hp-shadow hp-price-card {{ $package->featured ? 'featured' : '' }}">
                    @if($package->badge())
                        <span class="hp-popular">{{ $package->badge() }}</span>
                    @endif
                    <h3 style="margin:0;font-size:17px;">{{ $package->name() }}</h3>
                    <div class="hp-price">{{ $package->price }}<small>{{ $package->unit() }}</small></div>
                    <p style="font-size:12px;color:var(--muted);">{{ $package->description() }}</p>
                    <ul class="hp-price-list">
                        @foreach($package->features ?? [] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    <a class="btn {{ $package->featured ? 'btn-primary-hp' : 'btn-outline' }} full" href="{{ route('requirement.show') }}">{{ __('site.home.get_started') }}</a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== Pricing calculator ===== --}}
@if($showCalc && $calcItems->count())
<section class="section" id="calculator">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.calc_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_calc', 'site.home.calc_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_calc', 'site.home.calc_sub') }}</p>
        </div>
        <div id="calc-filters" class="hp-filters"></div>
        <div class="hp-calculator">
            <div id="calc-options" class="hp-calc-options"></div>
            <aside class="card hp-shadow hp-calc-summary">
                <h3>{{ __('site.home.calc_your_package') }}</h3>
                <p id="calc-empty" style="color:var(--muted);font-size:13px;">{{ __('site.home.calc_empty') }}</p>
                <ul id="calc-selected" class="hp-selected-list"></ul>
                <p id="calc-discount" class="hp-discount"></p>
                <div class="hp-total-row">
                    <span>{{ __('site.home.calc_total') }}</span>
                    <strong id="calc-total">{{ $currency }}0</strong>
                </div>
                <a class="btn btn-primary-hp full" href="#contact">{{ __('site.home.calc_discuss') }}</a>
                <p style="font-size:11px;color:var(--muted);">{{ __('site.home.calc_note') }}</p>
            </aside>
        </div>
    </div>
</section>
@endif

{{-- ===== Portfolio ===== --}}
@if($portfolios->count())
<section class="section section-alt" id="portfolio">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.portfolio_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_portfolio', 'site.nav.portfolio') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_portfolio', 'site.home.portfolio_sub') }}</p>
        </div>
        <div class="hp-filters">
            <button type="button" class="hp-filter active" data-filter="all">{{ __('site.admin.all') }}</button>
            @foreach($categories as $category)
                <button type="button" class="hp-filter" data-filter="{{ $category->slug }}">{{ t($category->name_bn, $category->name_en) }}</button>
            @endforeach
        </div>
        <div id="portfolio-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
            @foreach($portfolios as $project)
                <article class="card hp-shadow portfolio-card portfolio-item" data-category="{{ $project->category?->slug }}">
                    @php $cover = $project->images->first()?->path ?: data_get($project->before_after, 'after'); @endphp
                    @if($cover)
                        <div class="portfolio-visual">
                            <img src="{{ asset('storage/'.$cover) }}" alt="{{ $project->title() }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:1;">
                        </div>
                    @else
                        <div class="portfolio-visual" aria-hidden="true"><span style="font-size:40px;">🖼️</span></div>
                    @endif
                    <div class="portfolio-body">
                        @if($project->category)
                            <span class="hp-chips" style="margin-bottom:8px;"><span>{{ t($project->category->name_bn, $project->category->name_en) }}</span></span>
                        @endif
                        <h3>{{ $project->title() }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit((string) $project->description(), 110) }}</p>
                        <a href="{{ route('portfolio.show', $project) }}" class="btn btn-outline small full">{{ __('site.home.view_project') }}</a>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="hp-banner">
            <h3>{{ t(setting('portfolio_banner_title_bn'), setting('portfolio_banner_title_en')) ?: __('site.home.like_what_you_see') }}</h3>
            <p>{{ t(setting('portfolio_banner_text_bn'), setting('portfolio_banner_text_en')) ?: __('site.home.like_sub') }}</p>
            <a href="{{ route('portfolio.index') }}" class="btn btn-primary-hp">{{ __('site.home.all_portfolio') }}</a>
        </div>
    </div>
</section>
@endif

{{-- ===== Case studies ===== --}}
@if($caseStudies->count())
<section class="section" id="case-studies">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.case_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_case', 'site.home.case_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_case', 'site.home.case_sub') }}</p>
        </div>
        <div style="display:grid;gap:20px;">
            @foreach($caseStudies as $study)
                <article class="card hp-shadow case-card">
                    <div>
                        <span class="eyebrow">{{ $study->client ?: $study->category?->name() }}</span>
                        <h3>{{ $study->title() }}</h3>
                        @if($study->description())
                            <p><strong>{{ __('site.home.case_result') }}</strong><br>{{ $study->description() }}</p>
                        @endif
                        <a href="{{ route('portfolio.show', $study) }}" class="text-link">{{ __('site.home.view_case') }} →</a>
                    </div>
                    <div class="case-grid">
                        @foreach(collect($study->metrics ?? [])->take(4) as $metric)
                            <div class="case-metric">
                                <strong>{{ $metric['value'] ?? '' }}</strong>
                                <small>{{ $metric['label'] ?? '' }}</small>
                            </div>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== Testimonials ===== --}}
@if($testimonials->count())
<section class="section section-alt" id="testimonials">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.testimonial_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_testi', 'site.home.testimonials_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_testi', 'site.home.testimonials_sub') }}</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
            @foreach($testimonials as $testimonial)
                <article class="card hp-shadow quote-card" style="padding:24px;">
                    <div class="stars" aria-label="{{ $testimonial->rating }}/5">{{ str_repeat('★', (int) $testimonial->rating) }}{{ str_repeat('☆', max(0, 5 - (int) $testimonial->rating)) }}</div>
                    <blockquote>“{{ t((string) $testimonial->text_bn, (string) $testimonial->text_en) }}”</blockquote>
                    <strong>{{ $testimonial->name }}</strong>
                    <small>{{ $testimonial->role }}@if($testimonial->company) · {{ $testimonial->company }}@endif</small>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== Video introduction ===== --}}
<section class="section" id="video">
    <div class="container-x" style="text-align:center;">
        <span class="eyebrow">{{ __('site.home.video_eyebrow') }}</span>
        <h2 class="section-title">{{ $secTitle('sec_video', 'site.home.video_title') }}</h2>
        <p class="section-intro">{{ $secIntro('sec_video', 'site.home.video_sub') }}</p>
        <div class="hp-intro-panel">
            <div>
                @if($videoEmbed && str_contains($videoEmbed, 'youtu'))
                    <iframe src="{{ config('services.youtube.embed_base', 'https://www.youtube.com/embed/').preg_replace('/.*(?:v=|youtu\.be\/|shorts\/|embed\/)([A-Za-z0-9_-]{6,}).*/', '$1', $videoEmbed) }}"
                            title="{{ __('site.home.video_title') }}" loading="lazy"
                            allow="accelerometer; clipboard-write; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                @else
                    <div class="iconbox"><span style="font-size:26px;">🎬</span></div>
                    <h3>{{ __('site.home.video_heading', ['name' => $heroName]) }}</h3>
                    <p>{{ $videoText }}</p>
                @endif
                <a href="#contact" class="btn btn-primary-hp" style="margin-top:20px;">{{ __('site.home.video_cta') }}</a>
            </div>
        </div>
    </div>
</section>

{{-- ===== Insights ===== --}}
@if($posts->count())
<section class="section section-alt" id="insights">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.insights_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_insights', 'site.home.insights_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_insights', 'site.home.insights_sub') }}</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
            @foreach($posts as $post)
                <article class="card hp-shadow hp-insight" style="padding:24px;">
                    @if($post->category_bn)
                        <span class="tag" style="background:rgba(10,175,154,.12);color:var(--teal);border-radius:30px;padding:5px 10px;font-size:11px;font-weight:800;">{{ t((string) $post->category_bn, (string) $post->category_en) }}</span>
                    @endif
                    <h3>{{ $post->title() }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit((string) t((string) $post->excerpt_bn, (string) $post->excerpt_en), 120) }}</p>
                    <a href="{{ route('blog.show', $post) }}" class="text-link">{{ __('site.home.read_more') }} →</a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== FAQ ===== --}}
@if($showFaq && $faqs->count())
<section class="section" id="faq" @if(app()->getLocale() === 'bn') lang="bn" @endif>
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.faq_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_faq', 'site.home.faq_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_faq', 'site.home.faq_sub') }}</p>
        </div>
        <div class="faq-list">
            @foreach($faqs as $faq)
                <details class="faq-item">
                    <summary>{{ t((string) $faq->question_bn, (string) $faq->question_en) }}</summary>
                    <p>{{ t((string) $faq->answer_bn, (string) $faq->answer_en) }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== Meeting booking ===== --}}
@if($showMeet && $meetingOptions->count())
<section class="section section-alt" id="meeting">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.meeting_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_meeting', 'site.home.meeting_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_meeting', 'site.home.meeting_sub') }}</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;" id="meeting-choices">
            @foreach($meetingOptions as $i => $option)
                <article class="card hp-shadow meeting-card {{ $i === 0 ? 'selected' : '' }}">
                    <div class="iconbox {{ ['', 'c-purple', 'c-blue'][$i % 3] }}" style="margin:auto;font-size:20px;">{{ ['💬', '🎥', '🚀'][$i % 3] }}</div>
                    <h3>{{ $option[0] }}</h3>
                    <p>{{ $option[1] }}</p>
                    <strong>{{ $option[2] ?: __('site.free') }}</strong>
                    <button class="btn {{ $i === 0 ? 'btn-primary-hp' : 'btn-outline' }} full meeting-choice" data-meeting="{{ $option[0] }}" type="button">{{ __('site.home.select') }}</button>
                </article>
            @endforeach
        </div>
        <form id="meeting-form" class="card hp-shadow hp-meeting-form" method="POST" action="{{ route('meeting.store') }}">
            @csrf
            <h3>{{ __('site.home.meeting_form_title') }}</h3>
            <p style="font-size:12px;color:var(--muted);">{{ __('site.home.meeting_selected') }}: <strong id="meeting-selected">{{ $meetingOptions->first()[0] }}</strong>. {{ __('site.home.meeting_note') }}</p>
            <input type="hidden" name="meeting_type" id="meeting-type-input" value="{{ $meetingOptions->first()[0] }}">
            <div class="form-grid">
                <div class="field">
                    <label for="meeting-name">{{ __('site.form.name') }} *</label>
                    <input id="meeting-name" name="name" class="input" required autocomplete="name">
                </div>
                <div class="field">
                    <label for="meeting-email">{{ __('site.form.email') }} *</label>
                    <input id="meeting-email" name="email" type="email" class="input" required autocomplete="email">
                </div>
            </div>
            <div class="field">
                <label for="meeting-date">{{ __('site.home.meeting_date') }} *</label>
                <input id="meeting-date" name="preferred_date" type="date" class="input" required>
            </div>
            <div class="field">
                <label for="meeting-notes">{{ __('site.home.meeting_notes') }}</label>
                <textarea id="meeting-notes" name="message" class="textarea"></textarea>
            </div>
            <button class="btn btn-primary-hp" type="submit">{{ __('site.home.meeting_submit') }}</button>
        </form>
    </div>
</section>
@endif

{{-- ===== Newsletter ===== --}}
@if($showNews)
<section class="hp-newsletter" id="newsletter">
    <div class="container-x" style="text-align:center;">
        <div class="iconbox" style="margin:auto;font-size:20px;">✉️</div>
        <h2 class="section-title">{{ $secTitle('sec_news', 'site.home.newsletter_title') }}</h2>
        <p class="section-intro">{{ $secIntro('sec_news', 'site.home.newsletter_sub') }}</p>
        <form id="newsletter-form" class="hp-newsletter-form" method="POST" action="{{ route('newsletter.store') }}">
            @csrf
            <label for="newsletter-email" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);">{{ __('site.form.email') }}</label>
            <input id="newsletter-email" name="email" type="email" class="input" placeholder="{{ __('site.home.newsletter_placeholder') }}" required autocomplete="email">
            <button class="btn btn-primary-hp" type="submit">→ {{ __('site.home.subscribe') }}</button>
        </form>
    </div>
</section>
@endif

{{-- ===== Contact ===== --}}
<section class="section" id="contact">
    <div class="container-x">
        <div style="text-align:center;">
            <span class="eyebrow">{{ __('site.home.contact_eyebrow') }}</span>
            <h2 class="section-title">{{ $secTitle('sec_contact', 'site.home.contact_title') }}</h2>
            <p class="section-intro">{{ $secIntro('sec_contact', 'site.home.contact_sub') }}</p>
        </div>
        <div class="contact-grid">
            <div>
                <h3>{{ __('site.home.connect') }}</h3>
                <p style="color:var(--muted);font-size:14px;">{{ t(setting('sec_contact_intro_bn'), setting('sec_contact_intro_en')) ?: __('site.home.contact_intro') }}</p>
                @if(setting('contact_email'))
                    <div class="card hp-shadow contact-detail">
                        <span class="iconbox" style="font-size:18px;">✉️</span>
                        <div>
                            <strong>{{ __('site.form.email') }}</strong>
                            <a href="mailto:{{ setting('contact_email') }}">{{ setting('contact_email') }}</a>
                        </div>
                    </div>
                @endif
                @if(setting('contact_phone'))
                    <div class="card hp-shadow contact-detail">
                        <span class="iconbox c-blue" style="font-size:18px;">📞</span>
                        <div>
                            <strong>{{ __('site.footer.phone') }}</strong>
                            <span>{{ setting('contact_phone') }}</span>
                        </div>
                    </div>
                @endif
                @if(setting('address_bn'))
                    <div class="card hp-shadow contact-detail">
                        <span class="iconbox c-orange" style="font-size:18px;">📍</span>
                        <div>
                            <strong>{{ __('site.footer.location') }}</strong>
                            <span>{{ t((string) setting('address_bn'), (string) setting('address_en')) }}</span>
                        </div>
                    </div>
                @endif
                <h3 style="margin-top:22px;">{{ __('site.footer.follow') }}</h3>
                <div class="social-row">
                    @foreach(['facebook_url' => 'Facebook', 'linkedin_url' => 'LinkedIn', 'github_url' => 'GitHub', 'youtube_url' => 'YouTube', 'x_url' => 'X'] as $key => $label)
                        @if(setting($key))
                            <a href="{{ setting($key) }}" target="_blank" rel="noopener">{{ $label }}</a>
                        @endif
                    @endforeach
                    <a href="{{ route('blog.index') }}">{{ __('site.nav.blog') }}</a>
                </div>
            </div>
            <form class="card hp-shadow hp-meeting-form" style="margin:0;max-width:none;" method="POST" action="{{ route('contact.store') }}">
                @csrf
                <h3 style="margin-top:0;">{{ __('site.home.send_message') }}</h3>
                <div class="form-grid">
                    <div class="field">
                        <label for="contact-name">{{ __('site.form.name') }} *</label>
                        <input id="contact-name" name="name" class="input" required autocomplete="name">
                    </div>
                    <div class="field">
                        <label for="contact-email">{{ __('site.form.email') }} *</label>
                        <input id="contact-email" name="email" type="email" class="input" required autocomplete="email">
                    </div>
                </div>
                <div class="field">
                    <label for="contact-message">{{ __('site.form.message') }} *</label>
                    <textarea id="contact-message" name="message" class="textarea" required></textarea>
                </div>
                <button class="btn btn-primary-hp full" type="submit">{{ __('site.home.send_message') }} →</button>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const currency = @json($currency);
    const discountPercent = {{ $calcDiscount }};
    const discountMinItems = {{ $calcMinItems }};
    const calcItems = @json($calcPayload);
    const chosen = new Set();
    let calcCategory = 'all';

    const categories = [...new Set(calcItems.map((item) => item.category).filter(Boolean))];

    const renderFilters = () => {
        document.getElementById('calc-filters').innerHTML = ['all', ...categories].map((category) => {
            const label = category === 'all' ? '@lang('site.admin.all')' : category;
            return `<button type="button" class="hp-filter ${category === calcCategory ? 'active' : ''}" data-category="${category}">${label}</button>`;
        }).join('');
    };

    const renderCalc = () => {
        renderFilters();
        document.getElementById('calc-options').innerHTML = calcItems
            .map((item, index) => ({ item, index }))
            .filter(({ item }) => calcCategory === 'all' || item.category === calcCategory)
            .map(({ item, index }) => `
                <button type="button" class="hp-calc-option ${chosen.has(index) ? 'selected' : ''}" data-index="${index}" aria-pressed="${chosen.has(index)}">
                    <span><strong>${item.name}</strong><small>${item.category || ''}</small><em>${currency}${item.price}</em></span>
                    <span class="circle" aria-hidden="true"></span>
                </button>`).join('');

        const picked = [...chosen].sort((a, b) => a - b);
        const sum = picked.reduce((total, index) => total + calcItems[index].price, 0);
        const discount = picked.length >= discountMinItems ? Math.round(sum * discountPercent / 100) : 0;

        document.getElementById('calc-selected').innerHTML = picked
            .map((index) => `<li><span>${calcItems[index].name}</span><b>${currency}${calcItems[index].price}</b></li>`).join('');
        document.getElementById('calc-empty').hidden = picked.length > 0;
        document.getElementById('calc-discount').textContent = discount
            ? '@lang('site.home.bundle_discount')'.replace(':percent', String(discountPercent)).replace(':amount', `${currency}${discount}`) : '';
        document.getElementById('calc-total').textContent = `${currency}${Math.round(sum - discount)}`;
    };

    document.getElementById('calc-filters').addEventListener('click', (event) => {
        const button = event.target.closest('[data-category]');
        if (button) {
            calcCategory = button.dataset.category;
            renderCalc();
        }
    });
    document.getElementById('calc-options').addEventListener('click', (event) => {
        const button = event.target.closest('[data-index]');
        if (button) {
            const index = Number(button.dataset.index);
            if (chosen.has(index)) chosen.delete(index); else chosen.add(index);
            renderCalc();
        }
    });
    renderCalc();

    document.querySelectorAll('.hp-filters [data-filter]').forEach((button) => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.hp-filters [data-filter]').forEach((other) => other.classList.remove('active'));
            button.classList.add('active');
            const filter = button.dataset.filter;
            document.querySelectorAll('.portfolio-item').forEach((card) => {
                card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
            });
        });
    });

    document.querySelectorAll('.meeting-choice').forEach((button) => {
        button.addEventListener('click', () => {
            document.getElementById('meeting-selected').textContent = button.dataset.meeting;
            document.getElementById('meeting-type-input').value = button.dataset.meeting;
            document.querySelectorAll('.meeting-card').forEach((card) => {
                const active = card.contains(button);
                card.classList.toggle('selected', active);
                const btn = card.querySelector('button');
                btn.classList.toggle('btn-primary-hp', active);
                btn.classList.toggle('btn-outline', !active);
            });
            document.getElementById('meeting-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

    const datePicker = document.getElementById('meeting-date');
    if (datePicker) datePicker.min = new Date().toISOString().slice(0, 10);

    if (window.lucide) lucide.createIcons();
});
</script>
@endpush
@endsection
