<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', setting('meta_title_bn') ?: site_name().' — '.(setting('tagline_bn') ?: ''))</title>
    <meta name="description" content="@yield('meta_desc', setting('meta_desc_bn') ?: setting('meta_desc_en'))">
    <meta name="keywords" content="{{ setting('meta_keywords') }}">
    <meta property="og:title" content="@yield('title', site_name())">
    <meta property="og:description" content="@yield('meta_desc', setting('meta_desc_bn') ?? '')">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(setting('favicon'))
        <link rel="icon" href="{{ asset('storage/'.setting('favicon')) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif
    <script>(function(){try{var t=localStorage.getItem('theme');if(t==='dark'||(!t&&window.matchMedia('(prefers-color-scheme: dark)').matches))document.documentElement.setAttribute('data-theme','dark');}catch(e){}})();</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="hp-header">
    <div class="container-x hp-nav">
        <a href="{{ route('home') }}" class="hp-logo">
            @if(setting('logo'))
                <span class="hp-logo-mark"><img src="{{ asset('storage/'.setting('logo')) }}" alt="{{ site_name() }}"></span>
            @else
                <span class="hp-logo-mark">{{ mb_substr(site_name(), 0, 1) }}</span>
            @endif
            <span>{{ site_name() }}</span>
        </a>

        <nav id="navLinks" class="hp-links">
            <a data-nav href="{{ route('home') }}">{{ __('site.nav.home') }}</a>
            <a data-nav href="{{ route('services') }}">{{ __('site.nav.services') }}</a>
            <a data-nav href="{{ route('portfolio.index') }}">{{ __('site.nav.portfolio') }}</a>
            <a data-nav href="{{ route('about') }}">{{ __('site.nav.about') }}</a>
            <a data-nav href="{{ route('blog.index') }}">{{ __('site.nav.blog') }}</a>
            <a data-nav href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
        </nav>

        <div class="hp-actions">
            <button id="themeToggle" class="theme-toggle" type="button" aria-label="Toggle dark mode">
                <svg class="theme-icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                <svg class="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
            </button>

            <select id="langSwitch" data-base-url="{{ url('') }}" aria-label="Language"
                    style="border:1px solid var(--line);border-radius:999px;padding:6px 10px;font-size:13px;background:var(--card);color:var(--ink);">
                <option value="bn" @selected(app()->getLocale() === 'bn')>বাংলা</option>
                <option value="en" @selected(app()->getLocale() === 'en')>English</option>
            </select>

            @auth
                @php $u = auth()->user(); @endphp
                @if($u->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm">{{ __('site.nav.admin') }}</a>
                @elseif($u->isMember())
                    <a href="{{ route('team.dashboard') }}" class="btn btn-outline btn-sm">{{ __('site.nav.dashboard') }}</a>
                @else
                    <a href="{{ route('client.dashboard') }}" class="btn btn-outline btn-sm">{{ __('site.nav.dashboard') }}</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-ghost btn-sm">{{ __('site.nav.logout') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm max-sm:hidden">{{ __('site.nav.login') }}</a>
            @endauth

            <a href="{{ route('requirement.show') }}" class="btn btn-primary-hp btn-sm max-sm:hidden">{{ __('site.nav.hire') }}</a>

            <button id="navToggle" class="theme-toggle sm:hidden" type="button" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>
        </div>
    </div>
</header>

<main>
    @if(session('success'))
        <div style="background:rgba(5,150,105,.1);border-bottom:1px solid rgba(5,150,105,.3);color:var(--good);padding:10px 20px;font-size:14.5px;text-align:center;">
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</main>

@include('partials.footer')
@include('partials.popup')
@include('partials.chat-widget')

@if(setting('live_chat_script'))
    {!! setting('live_chat_script') !!}
@endif
</body>
</html>
