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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;600;700;800&family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="site-header">
    <div class="container-x" style="display:flex;align-items:center;gap:12px;min-height:64px;">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:8px;font-weight:800;font-size:17px;text-decoration:none;">
            @if(setting('logo'))
                <img src="{{ asset('storage/'.setting('logo')) }}" alt="{{ site_name() }}" style="height:30px;">
            @else
                <span style="background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;border-radius:10px;padding:2px 10px;">{{ mb_substr(site_name(), 0, 1) }}</span>
            @endif
            <span>{{ site_name() }}</span>
        </a>

        <nav id="navLinks" class="max-sm:!hidden" style="display:flex;align-items:center;gap:2px;margin-left:12px;">
            <a class="nav-link" data-nav href="{{ route('home') }}">{{ __('site.nav.home') }}</a>
            <a class="nav-link" data-nav href="{{ route('services') }}">{{ __('site.nav.services') }}</a>
            <a class="nav-link" data-nav href="{{ route('portfolio.index') }}">{{ __('site.nav.portfolio') }}</a>
            <a class="nav-link" data-nav href="{{ route('about') }}">{{ __('site.nav.about') }}</a>
            <a class="nav-link" data-nav href="{{ route('blog.index') }}">{{ __('site.nav.blog') }}</a>
            <a class="nav-link" data-nav href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
        </nav>

        <div style="margin-left:auto;display:flex;align-items:center;gap:8px;">
            <select id="langSwitch" data-base-url="{{ url('') }}"
                    style="border:1px solid var(--line);border-radius:999px;padding:6px 10px;font-size:13px;background:#fff;">
                <option value="bn" @selected(app()->getLocale() === 'bn')>বাংলা</option>
                <option value="en" @selected(app()->getLocale() === 'en')>English</option>
            </select>

            <a href="{{ route('requirement.show') }}" class="btn btn-gradient btn-sm max-sm:hidden">{{ __('site.nav.hire') }}</a>

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
                <a href="{{ route('login') }}" class="btn btn-outline btn-sm max-sm:hidden">{{ __('site.nav.login') }}</a>
            @endauth

            <button id="navToggle" class="btn btn-outline btn-sm sm:hidden" aria-label="menu">☰</button>
        </div>
    </div>
</header>

<main>
    @if(session('success'))
        <div style="background:#ecfdf5;border-bottom:1px solid #a7f3d0;color:var(--good);padding:10px 20px;font-size:14.5px;text-align:center;">
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
