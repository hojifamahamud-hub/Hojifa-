@extends('layouts.app')

@section('title', __('site.requirement.title').' — '.site_name())
@section('meta_desc', __('site.requirement.title'))

@section('content')
<section class="section">
    <div class="container-x" style="max-width:720px;">
        <span class="section-label">{{ __('site.nav.hire') }}</span>
        <h1>{{ __('site.requirement.title') }}</h1>
        <p class="section-sub" style="margin-top:8px;">{{ __('site.home.cta_text') }}</p>

        <form method="POST" action="{{ route('requirement.store') }}" class="card card-p" style="margin-top:24px;">
            @csrf
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
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
                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">{{ __('site.requirement.budget') }}</label>
                    <input name="budget" class="input" value="{{ old('budget') }}">
                </div>
                <div>
                    <label class="label">{{ __('site.requirement.timeline') }}</label>
                    <input name="timeline" class="input" value="{{ old('timeline') }}">
                </div>
            </div>
            <div style="margin-top:14px;">
                <label class="label">{{ __('site.requirement.details') }} *</label>
                <textarea name="message" class="textarea" rows="6" required>{{ old('message') }}</textarea>
                @error('message')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <button class="btn btn-gradient" style="margin-top:16px;">{{ __('site.requirement.submit') }}</button>
        </form>
    </div>
</section>
@endsection
