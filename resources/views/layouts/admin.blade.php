<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('site.admin.panel').' — '.site_name())</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ setting('favicon') ? asset('storage/'.setting('favicon')) : asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#f8fafc;">
<div style="display:flex;min-height:100vh;">
    <aside class="admin-sidebar no-print" style="width:250px;flex-shrink:0;padding:18px 14px;display:flex;flex-direction:column;gap:4px;position:sticky;top:0;height:100vh;overflow-y:auto;">
        <a href="{{ route('admin.dashboard') }}" style="color:#fff;font-weight:800;font-size:16px;padding:6px 10px 16px;display:flex;align-items:center;gap:8px;">
            <span style="background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:8px;padding:2px 8px;">{{ mb_substr(site_name(), 0, 1) }}</span>
            {{ __('site.admin.panel') }}
        </a>

        @php
            $menu = [
                [route('admin.dashboard'), '🏠 '.__('site.admin.dashboard')],
                [route('admin.settings.edit'), '⚙️ '.__('site.admin.settings')],
                [route('admin.leads.index'), '📥 '.__('site.admin.leads')],
                [route('admin.visitors.index'), '👁 '.__('site.admin.visitors')],
                [route('admin.users.index'), '👥 '.__('site.admin.users')],
                [route('admin.chats.index'), '💬 '.__('site.admin.chats')],
                [route('admin.tasks.index'), '✅ '.__('site.admin.tasks')],
                [route('admin.client-projects.index'), '📁 '.__('site.admin.client_projects')],
                [route('admin.invoices.index'), '🧾 '.__('site.admin.invoices')],
                [route('admin.payments.index'), '💳 '.__('site.admin.payments')],
                [route('admin.services.index'), '🛠 '.__('site.admin.services')],
                [route('admin.skills.index'), '🎯 '.__('site.admin.skills')],
                [route('admin.responsibilities.index'), '📋 '.__('site.nav.experience')],
                [route('admin.projects.index'), '🖼 '.__('site.admin.projects')],
                [route('admin.portfolio-categories.index'), '🗂 Portfolio Categories'],
                [route('admin.team-members.index'), '🧑‍🤝‍🧑 '.__('site.admin.team')],
                [route('admin.certificates.index'), '🏅 Certificates'],
                [route('admin.testimonials.index'), '⭐ Testimonials'],
                [route('admin.faqs.index'), '❓ FAQ'],
                [route('admin.stats.index'), '📊 Stats'],
                [route('admin.posts.index'), '✍️ '.__('site.admin.blog')],
                [route('admin.pages.index'), '📄 Pages'],
            ];
    @endphp
        @foreach($menu as $item)
            <a class="admin-link" href="{{ $item[0] }}">{{ $item[1] }}</a>
        @endforeach

        <a href="{{ route('home') }}" class="admin-link" style="margin-top:auto;">🌐 {{ __('site.nav.home') }}</a>
    </aside>

    <div style="flex:1;min-width:0;overflow-x:hidden;">
        <div class="site-header no-print" style="position:sticky;">
            <div class="container-x" style="display:flex;align-items:center;gap:10px;min-height:56px;max-width:100%;">
                <strong>{{ auth()->user()?->name }}</strong>
                <span class="muted">{{ auth()->user()?->email }}</span>
                <form method="POST" action="{{ route('admin.logout') }}" style="margin-left:auto;">
                    @csrf
                    <button class="btn btn-outline btn-sm">{{ __('site.nav.logout') }}</button>
                </form>
            </div>
        </div>

        <main style="padding:24px;">
            @if(session('success'))<div class="pill pill-good" style="font-size:14px;padding:10px 16px;margin-bottom:16px;display:block;">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="pill pill-bad" style="font-size:14px;padding:10px 16px;margin-bottom:16px;display:block;">{{ session('error') }}</div>@endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
