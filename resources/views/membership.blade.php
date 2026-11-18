@extends('layouts.app')

@section('title', __('site.footer.membership').' — '.site_name())
@section('meta_desc', __('site.footer.membership_text'))

@section('content')
<section class="hero-gradient" style="padding:56px 0;">
    <div class="container-x">
        <span class="hero-badge">🤝 {{ __('site.footer.membership') }}</span>
        <h1 style="margin-top:14px;">{{ __('site.footer.membership') }}</h1>
        <p style="max-width:620px;">{{ __('site.footer.membership_text') }}</p>
    </div>
</section>

<section class="section">
    <div class="container-x" style="max-width:560px;">
        <form method="POST" action="{{ route('membership.store') }}" class="card card-p" style="display:flex;flex-direction:column;gap:14px;">
            @csrf
            <div>
                <label class="label">{{ __('site.consult.name') }} *</label>
                <input name="name" class="input" value="{{ old('name') }}" required>
                @error('name')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="label">{{ __('site.consult.email') }} *</label>
                <input type="email" name="email" class="input" value="{{ old('email') }}" required>
                @error('email')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="label">{{ __('site.consult.phone') }} *</label>
                <input name="phone" class="input" value="{{ old('phone') }}" required>
            </div>
            <div>
                <label class="label">Skills (comma separated)</label>
                <input name="skills" class="input" value="{{ old('skills') }}">
            </div>
            <div>
                <label class="label">Password *</label>
                <input type="password" name="password" class="input" required>
                @error('password')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="label">Confirm password *</label>
                <input type="password" name="password_confirmation" class="input" required>
            </div>
            <button class="btn btn-gradient">{{ __('site.footer.membership') }}</button>
            <p class="muted">{{ __('site.auth.account_pending') }}</p>
        </form>
    </div>
</section>
@endsection
