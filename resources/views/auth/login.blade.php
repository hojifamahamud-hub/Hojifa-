@extends('layouts.app')

@section('title', __('site.nav.login').' — '.site_name())

@section('content')
<section class="hero-gradient" style="padding:70px 0;">
    <div class="container-x" style="max-width:460px;">
        <div class="card card-p" style="color:var(--ink);">
            <h1 style="font-size:24px;margin-bottom:16px;">{{ __('site.nav.login') }}</h1>
            <form method="POST" action="{{ route('login.store') }}" style="display:flex;flex-direction:column;gap:14px;">
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
                <label style="font-size:14px;display:flex;gap:6px;align-items:center;">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <button class="btn btn-gradient">{{ __('site.nav.login') }}</button>
            </form>
            <p class="muted" style="margin-top:14px;">
                {{ __('site.nav.register') }} নেই?
                <a href="{{ route('register') }}" style="color:var(--brand);font-weight:600;">{{ __('site.nav.register') }}</a>
                · <a href="{{ route('membership.show') }}" style="color:var(--brand);font-weight:600;">{{ __('site.footer.membership') }}</a>
            </p>
        </div>
    </div>
</section>
@endsection
