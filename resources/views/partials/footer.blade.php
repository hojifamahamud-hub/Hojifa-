<footer class="site-footer site-footer-dark">
    <div class="container-x" style="padding:56px 20px 32px;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:36px;">
        <div>
            <h3 style="margin:0 0 12px;font-weight:800;">{{ site_name() }}</h3>
            <p style="max-width:280px;">{{ setting('footer_text_bn') ?: setting('tagline_bn') }}</p>
        </div>

        <div>
            <h3 style="margin:0 0 12px;">{{ __('site.footer.quick_links') }}</h3>
            <a href="{{ route('home') }}">{{ __('site.nav.home') }}</a>
            <a href="{{ route('about') }}">{{ __('site.nav.about') }}</a>
            <a href="{{ route('portfolio.index') }}">{{ __('site.nav.portfolio') }}</a>
            <a href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
        </div>

        <div>
            <h3 style="margin:0 0 12px;">{{ __('site.nav.services') }}</h3>
            @foreach($footerServices ?? collect() as $footerService)
                <a href="{{ route('services') }}">{{ $footerService->title() }}</a>
            @endforeach
            <a href="{{ route('membership.show') }}">{{ __('site.footer.membership') }}</a>
        </div>

        <div>
            <h3 style="margin:0 0 12px;">{{ __('site.footer.contact_info') }}</h3>
            @if(setting('contact_email'))<a href="mailto:{{ setting('contact_email') }}">{{ setting('contact_email') }}</a>@endif
            @if(setting('contact_phone'))<p>{{ setting('contact_phone') }}</p>@endif
            @if(setting('address_bn'))<p>{{ setting('address_bn') }}</p>@endif
            <a href="{{ route('blog.index') }}">{{ __('site.nav.blog') }}</a>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container-x" style="padding:16px 20px;display:flex;flex-wrap:wrap;gap:8px;justify-content:space-between;">
            <span>© {{ now()->format('Y') }} {{ site_name() }}. {{ __('site.footer.rights') }}</span>
            <span>
                @foreach(['facebook_url' => 'Facebook', 'linkedin_url' => 'LinkedIn', 'github_url' => 'GitHub', 'youtube_url' => 'YouTube', 'x_url' => 'X'] as $key => $label)
                    @if(setting($key))
                        <a href="{{ setting($key) }}" target="_blank" rel="noopener">{{ $label }}</a> ·
                    @endif
                @endforeach
                <a href="{{ route('sitemap') }}">Sitemap</a>
            </span>
        </div>
    </div>
</footer>

@if(setting('contact_whatsapp'))
    <a class="float-btn float-whatsapp" target="_blank" rel="noopener"
       href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}"
       aria-label="WhatsApp">💬</a>
@endif
