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
        galleryToggle.addEventListener('click', () => navLinks.classList.toggle('open'));
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

const themeToggle = document.getElementById('themeToggle');
if (themeToggle) {
    const syncIcon = () => {
        const dark = document.documentElement.getAttribute('data-theme') === 'dark';
        const moon = themeToggle.querySelector('.theme-icon-moon');
        const sun = themeToggle.querySelector('.theme-icon-sun');
        if (moon && sun) {
            moon.style.display = dark ? 'none' : '';
            sun.style.display = dark ? '' : 'none';
        }
    };
    syncIcon();
    themeToggle.addEventListener('click', () => {
        const dark = document.documentElement.getAttribute('data-theme') === 'dark';
        if (dark) {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        }
        syncIcon();
    });
}

window.addEventListener('load', () => { if (window.lucide) lucide.createIcons(); });
