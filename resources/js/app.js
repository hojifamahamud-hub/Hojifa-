document.addEventListener('DOMContentLoaded', () => {
    const active = () => {
        const path = window.location.pathname;
        document.querySelectorAll('[data-nav]').forEach((a) => {
            const href = a.getAttribute('href');
            if (href && (href === path || (href.length > 1 && path.startsWith(href + '/')))) {
                a.classList.add('active');
            }
        });
    };
    active();

    const galleryToggle = document.getElementById('navToggle');
    const navLinks = document.getElementById('navLinks');
    if (galleryToggle && navLinks) {
        galleryToggle.addEventListener('click', () => navLinks.classList.toggle('hidden'));
    }

    const faq = document.querySelectorAll('details.faq-item');
    faq.forEach((item) => {
        item.addEventListener('toggle', () => {
            if (item.open) faq.forEach((other) => { if (other !== item) other.open = false; });
        });
    });

    const langSwitch = document.getElementById('langSwitch');
    if (langSwitch) {
        langSwitch.addEventListener('change', () => {
            window.location = langSwitch.dataset.baseUrl + '/lang/' + langSwitch.value;
        });
    }
});
