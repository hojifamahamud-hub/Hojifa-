@extends('layouts.app')

@section('title', t($page?->meta_title_bn, $page?->meta_title_en) ?: __('site.nav.contact').' — '.site_name())
@section('meta_desc', t($page?->meta_desc_bn, $page?->meta_desc_en) ?: __('site.consult.title'))

@section('content')
<section class="section">
    <div class="container-x" style="max-width:760px;">
        <span class="section-label">{{ __('site.nav.contact') }}</span>
        <h1>{{ __('site.consult.title') }}</h1>

        <div style="display:grid;grid-template-columns:1fr;gap:16px;margin-top:24px;">
            <form method="POST" action="{{ route('contact.store') }}" class="card card-p">
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
                </div>
                <div style="margin-top:14px;">
                    <label class="label">{{ __('site.consult.phone') }}</label>
                    <input name="phone" class="input" value="{{ old('phone') }}">
                </div>
                <div style="margin-top:14px;">
                    <label class="label">{{ __('site.consult.message') }} *</label>
                    <textarea name="message" class="textarea" rows="5" required>{{ old('message') }}</textarea>
                    @error('message')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <button class="btn btn-gradient" style="margin-top:16px;">{{ __('site.consult.submit') }}</button>
            </form>

            <div class="card card-p" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;">
                @if(setting('contact_email'))<div>✉️ <a href="mailto:{{ setting('contact_email') }}">{{ setting('contact_email') }}</a></div>@endif
                @if(setting('contact_phone'))<div>📞 {{ setting('contact_phone') }}</div>@endif
                @if(setting('contact_whatsapp'))
                    <div>💬 <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}" target="_blank" rel="noopener">WhatsApp</a></div>
                @endif
                @if(setting('address_bn'))<div>📍 {{ setting('address_bn') }}</div>@endif
            </div>
        </div>
    </div>
</section>
@endsection
