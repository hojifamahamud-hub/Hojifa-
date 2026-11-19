@php $mode = setting('popup_mode', 'popup'); $gate = $mode === 'gate'; @endphp
@if(in_array($mode, ['popup', 'gate']))
    <div id="emailPopup" class="{{ $gate ? 'gate-overlay' : 'popup-overlay' }}">
        <div class="card card-p" style="max-width:420px;width:100%;position:relative;background:#fff;border-radius:14px;">
            @if(!$gate)
                <button type="button" id="popupClose" style="position:absolute;top:10px;right:14px;background:none;border:none;font-size:20px;cursor:pointer;color:var(--muted);">×</button>
            @endif
            <h3 style="margin-bottom:6px;">{{ setting('popup_title_bn') ?: __('site.popup.title') }}</h3>
            <p class="muted">{{ setting('popup_text_bn') ?: __('site.popup.text') }}</p>
            <form id="emailPopupForm" style="margin-top:10px;display:flex;flex-direction:column;gap:10px;">
                <input type="email" name="email" class="input" placeholder="{{ __('site.popup.placeholder') }}" required>
                <div style="display:flex;gap:8px;">
                    <button class="btn btn-gradient" style="flex:1;">{{ __('site.popup.btn') }}</button>
                    @if(!$gate)
                        <button type="button" class="btn btn-outline" id="popupLater">{{ __('site.popup.later') }}</button>
                    @endif
                </div>
                <p id="popupStatus" class="muted" style="display:none;"></p>
            </form>
            @if($gate)
                <a href="javascript:void(0)" id="popupLater" class="muted" style="display:block;text-align:center;margin-top:10px;">{{ __('site.popup.later') }}</a>
            @endif
        </div>
    </div>

    <script>
        (function () {
            var overlay = document.getElementById('emailPopup');
            if (!overlay || localStorage.getItem('email_popup_done')) return;

            function remove() {
                overlay.remove();
                try { localStorage.setItem('email_popup_done', '1'); } catch (e) {}
            }

            @if($gate)
                overlay.classList.add('open');
            @else
                setTimeout(function () { overlay.classList.add('open'); }, 6000);
            @endif

            document.getElementById('popupClose')?.addEventListener('click', remove);
            document.getElementById('popupLater')?.addEventListener('click', remove);

            document.getElementById('emailPopupForm').addEventListener('submit', function (e) {
                e.preventDefault();
                var form = e.target;
                var status = document.getElementById('popupStatus');
                fetch('{{ route('visitors.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({ email: form.email.value })
                })
                .then(function (r) { if (!r.ok) throw new Error('failed'); return r.json(); })
                .then(function () {
                    localStorage.setItem('email_popup_done', '1');
                    status.textContent = @js(__('site.popup.thanks'));
                    status.style.display = 'block';
                    @if(!$gate) setTimeout(remove, 1200); @endif
                })
                .catch(function () {
                    status.textContent = 'Error — please try again.';
                    status.style.display = 'block';
                });
            });
        })();
    </script>
@endif
