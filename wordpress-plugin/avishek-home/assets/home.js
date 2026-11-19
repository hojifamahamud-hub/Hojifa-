(function () {
    'use strict';

    const CFG = window.AS_HOME || {};
    const calcItems = (CFG.data && CFG.data.calc) || [];
    const doc = document;
    const home = doc.getElementById('as-home');
    if (!home) return;

    const esc = (value) => String(value == null ? '' : value).replace(/[&<>"']/g, (char) => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    })[char]);
    const el = (id) => doc.getElementById(id);

    /* ===== Dark mode ===== */
    const THEME_KEY = 'as-home-theme';
    const applyTheme = (theme) => {
        home.setAttribute('data-theme', theme === 'dark' ? 'dark' : 'light');
    };
    let theme = null;
    try { theme = localStorage.getItem(THEME_KEY); } catch (e) { theme = null; }
    applyTheme(theme || (home.getAttribute('data-theme') === 'dark' ? 'dark' : 'light'));

    const themeToggle = el('asThemeToggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const next = home.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(next);
            try { localStorage.setItem(THEME_KEY, next); } catch (e) {}
        });
    }

    /* ===== Mobile nav ===== */
    const navToggle = el('asMenuToggle');
    const navLinks = el('asMenu');
    if (navToggle && navLinks) {
        navToggle.style.display = home.getAttribute('data-collapsed') === '1' ? 'grid' : 'none';
        navToggle.addEventListener('click', () => navLinks.classList.toggle('open'));
        navLinks.addEventListener('click', (event) => {
            if (event.target.tagName === 'A') navLinks.classList.remove('open');
        });
    }
    if (window.matchMedia) {
        const media = window.matchMedia('(max-width: 960px)');
        const syncNav = () => { if (navToggle && navLinks) navToggle.style.display = media.matches ? 'grid' : 'none'; };
        if (navToggle && navLinks) {
            if (media.addEventListener) media.addEventListener('change', syncNav);
            navToggle.style.display = media.matches ? 'grid' : 'none';
        }
    }

    /* ===== Pricing calculator ===== */
    const chosen = new Set();
    let calcCategory = 'all';
    const categories = [...new Set(calcItems.map((item) => item.category).filter(Boolean))];

    const renderCalc = () => {
        const filters = el('calc-filters');
        const options = el('calc-options');
        if (!filters || !options) return;

        filters.innerHTML = ['all'].concat(categories).map((category) => {
            const label = category === 'all' ? (CFG.calcLabelAll || 'All Services') : category;
            return '<button type="button" class="hp-filter ' + (category === calcCategory ? 'active' : '') +
                '" data-category="' + esc(category) + '">' + esc(label) + '</button>';
        }).join('');

        options.innerHTML = calcItems
            .map((item, index) => ({ item, index }))
            .filter((entry) => calcCategory === 'all' || entry.item.category === calcCategory)
            .map((entry) => '<button type="button" class="hp-calc-option ' + (chosen.has(entry.index) ? 'selected' : '') +
                '" data-index="' + entry.index + '" aria-pressed="' + (chosen.has(entry.index) ? 'true' : 'false') + '">' +
                '<span><strong>' + esc(entry.item.name) + '</strong><small>' + esc(entry.item.category) + '</small>' +
                '<em>' + esc(CFG.currency) + esc(entry.item.price) + '</em></span>' +
                '<span class="circle" aria-hidden="true"></span></button>').join('');

        const picked = Array.from(chosen).sort((a, b) => a - b);
        const sum = picked.reduce((total, index) => total + (Number(calcItems[index].price) || 0), 0);
        const percent = Number(CFG.discountPercent) || 0;
        const minItems = Number(CFG.discountMinItems) || 1;
        const discount = picked.length >= minItems ? Math.round(sum * percent / 100) : 0;
        const currency = CFG.currency || '$';

        el('calc-selected').innerHTML = picked.map((index) =>
            '<li><span>' + esc(calcItems[index].name) + '</span><b>' + esc(currency) + esc(calcItems[index].price) + '</b></li>').join('');
        el('calc-empty').hidden = picked.length > 0;
        el('calc-discount').textContent = discount
            ? String(CFG.bundleDiscount || 'Bundle discount (:percent%): -:amount')
                .replace(':percent', String(percent)).replace(':amount', currency + discount)
            : '';
        el('calc-total').textContent = currency + Math.round(sum - discount);
    };

    const filtersWrap = el('calc-filters');
    if (filtersWrap) {
        filtersWrap.addEventListener('click', (event) => {
            const button = event.target.closest('[data-category]');
            if (button) { calcCategory = button.dataset.category; renderCalc(); }
        });
    }
    const optionsWrap = el('calc-options');
    if (optionsWrap) {
        optionsWrap.addEventListener('click', (event) => {
            const button = event.target.closest('[data-index]');
            if (button) {
                const index = Number(button.dataset.index);
                if (chosen.has(index)) chosen.delete(index); else chosen.add(index);
                renderCalc();
            }
        });
    }
    renderCalc();

    /* ===== Portfolio filters ===== */
    doc.querySelectorAll('#as-home .hp-filters [data-filter]').forEach((button) => {
        button.addEventListener('click', () => {
            button.parentElement.querySelectorAll('[data-filter]').forEach((other) => other.classList.remove('active'));
            button.classList.add('active');
            const filter = button.dataset.filter;
            doc.querySelectorAll('#as-home .portfolio-item').forEach((card) => {
                card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
            });
        });
    });

    /* ===== Meeting selection ===== */
    doc.querySelectorAll('#as-home .meeting-choice').forEach((button) => {
        button.addEventListener('click', () => {
            const selected = el('meeting-selected');
            const typeInput = el('meeting-type-input');
            if (selected) selected.textContent = button.dataset.meeting;
            if (typeInput) typeInput.value = button.dataset.meeting;
            doc.querySelectorAll('#as-home .meeting-card').forEach((card) => {
                const active = card.contains(button);
                card.classList.toggle('selected', active);
                const cardBtn = card.querySelector('.meeting-choice');
                if (cardBtn) {
                    cardBtn.classList.toggle('btn-primary-hp', active);
                    cardBtn.classList.toggle('btn-outline', !active);
                }
            });
            const form = el('meeting-form');
            if (form) form.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

    const datePicker = el('meeting-date');
    if (datePicker) datePicker.min = new Date().toISOString().slice(0, 10);

    /* ===== Insights toggle ===== */
    doc.querySelectorAll('#as-home .hp-insight .text-link').forEach((button) => {
        button.addEventListener('click', () => {
            const card = button.closest('.hp-insight');
            card.classList.toggle('open');
            const open = card.classList.contains('open');
            button.textContent = open ? 'Show Less ↑' : 'Read More →';
        });
    });

    /* ===== Forms (REST) ===== */
    const value = (id) => { const node = el(id); return node ? node.value.trim() : ''; };

    const submitForm = async (event, type, statusId, payload) => {
        event.preventDefault();
        const form = event.currentTarget;
        const status = el(statusId);
        const button = form.querySelector('[type="submit"]');
        const label = button ? button.innerHTML : '';
        const failLabel = (CFG.strings && CFG.strings.requestError) || 'Sorry, something went wrong. Please email me directly.';

        if (status) { status.classList.remove('error'); status.textContent = ''; }
        if (button) { button.disabled = true; button.textContent = (CFG.strings && CFG.strings.sending) || 'Sending…'; }

        const finish = (node, text, isError) => {
            if (node) {
                node.textContent = text;
                node.classList.toggle('error', !!isError);
            } else if (!isError) {
                window.alert(text);
            }
        };

        try {
            const response = await fetch(CFG.restUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': CFG.nonce || '' },
                credentials: 'same-origin',
                body: JSON.stringify({
                    type,
                    name: payload.name,
                    email: payload.email,
                    subject: payload.subject,
                    message: payload.message,
                    meeting_type: payload.meeting_type,
                    preferred_date: payload.preferred_date,
                }),
            });
            const body = await response.json().catch(() => ({}));
            if (!response.ok || (!body || !body.ok)) {
                finish(status, body && body.message ? body.message : failLabel, true);
            } else {
                finish(status, body.message || 'Thank you!', false);
                form.reset();
            }
        } catch (error) {
            finish(status, failLabel, true);
        } finally {
            if (button) { button.disabled = false; button.innerHTML = label; }
            if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
        }
    };

    const contactForm = el('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (event) => submitForm(event, 'contact', 'contact-status', {
            name: value('contact-name'), email: value('contact-email'),
            subject: value('contact-subject'), message: value('contact-message'),
        }));
    }

    const newsletterForm = el('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', (event) => submitForm(event, 'newsletter', 'newsletter-status', {
            email: value('newsletter-email'), subject: 'Newsletter subscription',
        }));
    }

    const meetingForm = el('meeting-form');
    if (meetingForm) {
        meetingForm.addEventListener('submit', (event) => submitForm(event, 'meeting', 'meeting-status', {
            name: value('meeting-name'), email: value('meeting-email'),
            subject: 'Meeting request', message: value('meeting-notes'),
            meeting_type: value('meeting-type-input') || value('meeting-selected'),
            preferred_date: value('meeting-date'),
        }));
    }

    doc.querySelectorAll('#as-home [data-lucide]').forEach((icon) => icon.remove());
    if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
})();
