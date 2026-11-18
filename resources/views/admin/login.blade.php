<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('site.admin.panel') }} — {{ site_name() }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hero-gradient" style="display:flex;align-items:center;justify-content:center;min-height:100vh;">
    <div style="width:min(420px,92vw);">
        <div class="card card-p">
            <h1 style="font-size:22px;margin-bottom:14px;">🔐 {{ __('site.admin.panel') }}</h1>
            <form method="POST" action="{{ route('admin.login.store') }}" style="display:flex;flex-direction:column;gap:14px;">
                @csrf
                <div>
                    <label class="label">{{ __('site.consult.email') }}</label>
                    <input type="email" name="email" class="input" value="{{ old('email') }}" required autofocus>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">Password</label>
                    <input type="password" name="password" class="input" required>
                </div>
                <button class="btn btn-gradient">{{ __('site.nav.login') }}</button>
            </form>
            <p class="muted" style="margin-top:12px;"><a href="{{ route('home') }}">← {{ __('site.nav.home') }}</a></p>
        </div>
    </div>
</body>
</html>
