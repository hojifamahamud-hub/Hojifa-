@extends('layouts.app')

@section('title', setting('hero_title_bn') ?: site_name().' — '.(setting('tagline_bn') ?: 'Portfolio & Agency'))
@section('meta_desc', setting('meta_desc_bn') ?: setting('hero_subtitle_bn'))

@section('content')
<section class="hero-gradient" style="padding:80px 0 90px;">
    <div class="container-x" style="text-align:center;">
        <span class="hero-badge">✨ {{ setting('hero_badge_bn') ?: __('site.home.hero_badge') }}</span>
        <h1 style="margin:18px auto 12px;max-width:840px;">{{ setting('hero_title_bn') ?: 'আপনার ব্যবসার জন্য আধুনিক ডিজিটাল সমাধান' }}</h1>
        <p style="max-width:680px;margin:0 auto 26px;font-size:17.5px;">
            {{ setting('hero_subtitle_bn') ?: 'ওয়েব ডিজাইন, মার্কেটিং ও অটোমেশন — সব এক জায়গায়।' }}
        </p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ setting('hero_cta_url') ?: route('requirement.show') }}" class="btn" style="background:#fff;color:var(--brand);">
                {{ __('site.home.hero_cta1') }}
            </a>
            <a href="{{ route('contact') }}" class="btn" style="border-color:rgba(255,255,255,.4);color:#fff;">{{ __('site.home.hero_cta2') }}</a>
        </div>

        @if($stats->count())
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:14px;margin-top:52px;">
                @foreach($stats as $stat)
                    <div style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.16);border-radius:14px;padding:18px;">
                        <div style="font-size:28px;font-weight:800;">{{ $stat->value }}</div>
                        <div style="font-size:13.5px;color:rgba(255,255,255,.75);">{{ t($stat->label_bn, $stat->label_en) }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@if($services->count())
<section class="section" id="services">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.services') }}</span>
        <h2>{{ __('site.home.services') }}</h2>
        <p class="section-sub" style="margin-bottom:32px;">{{ __('site.home.services_sub') }}</p>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;">
            @foreach($services as $service)
                <div class="card card-p" style="text-align:left;">
                    <div style="font-size:30px;margin-bottom:8px;">{{ $service->icon ?: '⚡' }}</div>
                    <h3>{{ t($service->title_bn, $service->title_en) }}</h3>
                    <p class="muted" style="min-height:44px;">{{ \Illuminate\Support\Str::limit((string) t($service->description_bn, $service->description_en), 110) }}</p>
                    @if(is_array($service->features))
                        <ul style="list-style:none;padding:0;margin:12px 0 0;display:flex;flex-direction:column;gap:6px;">
                            @foreach(array_slice($service->features, 0, 4) as $feature)
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

@if($skills->count())
<section class="section section-alt" id="skills">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.skills') }}</span>
        <h2>{{ __('site.nav.skills') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:32px;margin-top:28px;">
            @foreach($skills as $categoryName => $items)
                <div>
                    <h3 style="margin-bottom:16px;">{{ $categoryName }}</h3>
                    <div style="display:flex;flex-direction:column;gap:14px;">
                        @foreach($items as $skill)
                            <div>
                                <div style="display:flex;justify-content:space-between;font-size:14.5px;font-weight:600;">
                                    <span>{{ t($skill->name_bn, $skill->name_en) }}</span>
                                    <span class="muted">{{ $skill->level }}%</span>
                                </div>
                                <div class="skill-bar" style="margin-top:6px;">
                                    <span style="width:{{ max(5, min(100, $skill->level)) }}%;"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($responsibilities->count())
<section class="section" id="responsibility">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.responsibility') }}</span>
        <h2>{{ __('site.nav.experience') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:18px;margin-top:28px;">
            @foreach($responsibilities as $item)
                <div class="card card-p">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
                        <span style="font-size:26px;">{{ $item->icon ?: '🛠️' }}</span>
                        <h3>{{ t($item->title_bn, $item->title_en) }}</h3>
                    </div>
                    <p class="muted">{{ t($item->description_bn, $item->description_en) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($portfolios->count())
<section class="section section-alt" id="portfolio">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.portfolio') }}</span>
        <h2>{{ __('site.home.experience') }}</h2>
        <div style="display:flex;gap:8px;flex-wrap:wrap;margin:20px 0;">
            @foreach($categories as $category)
                <a class="pill" href="{{ route('portfolio.index', $category->slug) }}">{{ t($category->name_bn, $category->name_en) }}</a>
            @endforeach
            <a class="pill pill-good" href="{{ route('portfolio.index') }}">{{ __('site.admin.all') }}</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;">
            @foreach($portfolios as $project)
                <a href="{{ route('portfolio.show', $project) }}" class="card" style="text-decoration:none;overflow:hidden;display:block;">
                    @php $cover = $project->images->first()?->path ?: data_get($project->before_after, 'after'); @endphp
                    @if($cover)
                        <img class="thumb" style="border-radius:14px 14px 0 0;" loading="lazy"
                             src="{{ asset('storage/'.$cover) }}" alt="{{ $project->title() }}">
                    @else
                        <div class="thumb" style="border-radius:14px 14px 0 0;display:flex;align-items:center;justify-content:center;font-size:40px;">🖼️</div>
                    @endif
                    <div class="card-p" style="padding:16px;">
                        @if($project->category)
                            <span class="pill" style="margin-bottom:6px;">{{ t($project->category->name_bn, $project->category->name_en) }}</span>
                        @endif
                        <h3>{{ $project->title() }}</h3>
                        <p class="muted">{{ \Illuminate\Support\Str::limit((string) $project->description(), 90) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($team->count())
<section class="section" id="team">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.team') }}</span>
        <h2>{{ __('site.home.team_sub') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:18px;margin-top:28px;">
            @foreach($team as $member)
                <div class="card card-p" style="text-align:center;">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" style="width:110px;height:110px;object-fit:cover;border-radius:999px;margin:0 auto 12px;">
                    @else
                        <div style="width:110px;height:110px;border-radius:999px;background:var(--soft);color:var(--brand);display:flex;align-items:center;justify-content:center;font-size:34px;font-weight:800;margin:0 auto 12px;">{{ mb_substr($member->name, 0, 1) }}</div>
                    @endif
                    <h3>{{ $member->name }}</h3>
                    <p class="muted">{{ t($member->role_bn, $member->role_en) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($certificates->count())
<section class="section section-alt" id="certificates">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.certificates') }}</span>
        <h2>{{ __('site.home.certificates_sub') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px;margin-top:28px;">
            @foreach($certificates as $certificate)
                <div class="card" style="overflow:hidden;">
                    @if($certificate->image)
                        <img class="thumb" style="border-radius:0;" src="{{ asset('storage/'.$certificate->image) }}" alt="{{ t($certificate->title_bn, $certificate->title_en) }}" loading="lazy">
                    @endif
                    <div class="card-p" style="padding:14px;">
                        <h3 style="font-size:16px;">{{ t($certificate->title_bn, $certificate->title_en) }}</h3>
                        <p class="muted">{{ $certificate->issuer }} @if($certificate->issued_at) · {{ $certificate->issued_at->format('M Y') }} @endif</p>
                        @if($certificate->url)
                            <a class="pill pill-good" href="{{ $certificate->url }}" target="_blank" rel="noopener">🔍 Verify</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($testimonials->count())
<section class="section" id="testimonials">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.testimonials') }}</span>
        <h2>{{ __('site.home.testimonials_sub') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;margin-top:28px;">
            @foreach($testimonials as $testimonial)
                <div class="card card-p">
                    <div style="color:#f59e0b;letter-spacing:2px;">{{ str_repeat('★', (int) $testimonial->rating).str_repeat('☆', max(0, 5 - (int) $testimonial->rating)) }}</div>
                    <p style="margin:10px 0;">“{{ t($testimonial->text_bn, $testimonial->text_en) }}”</p>
                    <div style="font-weight:700;">{{ $testimonial->name }}</div>
                    <div class="muted">{{ $testimonial->role }} @if($testimonial->company) — {{ $testimonial->company }} @endif</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($posts->count())
<section class="section section-alt" id="blog">
    <div class="container-x">
        <span class="section-label">{{ __('site.home.blog') }}</span>
        <h2>{{ __('site.nav.blog') }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;margin-top:28px;">
            @foreach($posts as $post)
                <a class="card" href="{{ route('blog.show', $post) }}" style="text-decoration:none;overflow:hidden;display:block;">
                    @if($post->image)
                        <img class="thumb" style="border-radius:0;" src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title() }}" loading="lazy">
                    @endif
                    <div class="card-p" style="padding:18px;">
                        @if($post->category())<span class="pill">{{ $post->category() }}</span>@endif
                        <h3>{{ $post->title() }}</h3>
                        <p class="muted">{{ \Illuminate\Support\Str::limit((string) $post->excerpt(), 100) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($faqs->count())
<section class="section" id="faq">
    <div class="container-x" style="max-width:820px;">
        <span class="section-label">{{ __('site.home.faq') }}</span>
        <h2>FAQ</h2>
        <div style="display:flex;flex-direction:column;gap:12px;margin-top:24px;">
            @foreach($faqs as $faq)
                <details class="faq-item">
                    <summary>{{ t($faq->question_bn, $faq->question_en) }}</summary>
                    <div class="faq-a">{{ t($faq->answer_bn, $faq->answer_en) }}</div>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="hero-gradient" style="padding:64px 0;">
    <div class="container-x" style="max-width:820px;">
        <div style="text-align:center;margin-bottom:24px;">
            <h2>{{ __('site.home.cta_title') }}</h2>
            <p>{{ __('site.home.cta_text') }}</p>
        </div>
        <form method="POST" action="{{ route('contact.store') }}" class="card card-p">
            @csrf
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
                <div>
                    <label class="label">{{ __('site.consult.name') }}</label>
                    <input name="name" class="input" required>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">{{ __('site.consult.phone') }}</label>
                    <input name="phone" class="input">
                </div>
                <div>
                    <label class="label">{{ __('site.consult.email') }}</label>
                    <input type="email" name="email" class="input" required>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div style="margin-top:14px;">
                <label class="label">{{ __('site.consult.message') }}</label>
                <textarea name="message" class="textarea" rows="3" required></textarea>
                @error('message')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <button class="btn btn-gradient" style="margin-top:14px;">{{ __('site.consult.submit') }}</button>
        </form>
    </div>
</section>
@endsection
