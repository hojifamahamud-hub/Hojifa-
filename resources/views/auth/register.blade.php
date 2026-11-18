@extends('layouts.app')

@section('title', __('site.nav.register').' — '.site_name())

@section('content')
<section class="hero-gradient" style="padding:70px 0;">
    <div class="container-x" style="max-width:460px;">
        <div class="card card-p" style="color:var(--ink);">
            <h1 style="font-size:24px;margin-bottom:16px;">{{ __('site.nav.register') }}</h1>
            <form method="POST" action="{{ route('register.store') }}" style="display:flex;flex-direction:column;gap:14px;">
                @csrf
                <div>
                    <label class="label">{{ __('site.consult.name') }}</label>
                    <input name="name" class="input" value="{{ old('name') }}" required>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">{{ __('site.consult.email') }}</label>
                    <input type="email" name="email" class="input" value="{{ old('email') }}" required>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">{{ __('site.consult.phone') }}</label>
                    <input name="phone" class="input" value="{{ old('phone') }}">
                </div>
                <div>
                    <label class="label">Password</label>
                    <input type="password" name="password" class="input" required>
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">Confirm password</label>
                    <input type="password" name="password_confirmation" class="input" required>
                </div>
                <button class="btn btn-gradient">{{ __('site.nav.register') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
