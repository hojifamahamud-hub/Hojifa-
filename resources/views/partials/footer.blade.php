<footer class="site-footer">
    <div class="container-x" style="padding:48px 20px 32px;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:32px;">
        <div>
            <div style="font-weight:800;font-size:17px;color:#fff;margin-bottom:10px;">{{ site_name() }}</div>
            <p style="color:#cbd5e1;">{{ setting('footer_text_bn') ?: setting('tagline_bn') }}</p>
        </div>

        <div>
            <h4>{{ __('site.footer.quick_links') }}</h4>
            <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:8px;">
                <li><a href="{{ route('services') }}">{{ __('site.nav.services') }}</a></li>
                <li><a href="{{ route('portfolio.index') }}">{{ __('site.nav.portfolio') }}</a></li>
                <li><a href="{{ route('about') }}">{{ __('site.nav.about') }}</a></li>
                <li><a href="{{ route('blog.index') }}">{{ __('site.nav.blog') }}</a></li>
                <li><a href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a></li>
                <li><a href="{{ route('requirement.show') }}">{{ __('site.nav.hire') }}</a></li>
            </ul>
        </div>

        <div>
            <h4>{{ __('site.footer.contact_info') }}</h4>
            <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:8px;">
                @if(setting('contact_email'))<li>✉️ {{ setting('contact_email') }}</li>@endif
                @if(setting('contact_phone'))<li>📞 {{ setting('contact_phone') }}</li>@endif
                @if(setting('address_bn'))<li>📍 {{ setting('address_bn') }}</li>@endif
                <li><a href="{{ route('membership.show') }}">{{ __('site.footer.membership') }}</a></li>
            </ul>
        </div>

        <div>
            <h4>{{ __('site.footer.follow') }}</h4>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                @foreach(['facebook_url' => 'Facebook', 'linkedin_url' => 'LinkedIn', 'github_url' => 'GitHub', 'youtube_url' => 'YouTube', 'x_url' => 'X'] as $key => $label)
                    @if(setting($key))
                        <a class="pill" href="{{ setting($key) }}" target="_blank" rel="noopener">{{ $label }}</a>
                    @endif
                @endforeach
            </div>
            <div style="margin-top:16px;">
                <a href="{{ route('membership.show') }}" class="btn btn-gradient btn-sm">{{ __('site.footer.membership') }}</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container-x" style="padding:16px 20px;display:flex;flex-wrap:wrap;gap:8px;justify-content:space-between;">
            <span>© {{ now()->format('Y') }} {{ site_name() }}. {{ __('site.footer.rights') }}</span>
            <span>🔁 <a href="{{ route('sitemap') }}">Sitemap</a></span>
        </div>
    </div>
</footer>

@if(setting('contact_whatsapp'))
    <a class="float-btn float-whatsapp" target="_blank" rel="noopener"
       href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}"
       aria-label="WhatsApp">💬</a>
@endif
