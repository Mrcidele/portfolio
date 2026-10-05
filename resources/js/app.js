const root = document.documentElement;

// Tema claro/escuro
document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const isDark = root.classList.toggle('dark');
        try {
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        } catch (e) {}
    });
});

// Menu mobile
const menuToggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-menu]');

if (menuToggle && menu) {
    const setMenu = (open) => {
        menu.classList.toggle('hidden', !open);
        menuToggle.setAttribute('aria-expanded', String(open));
        menuToggle.querySelector('[data-menu-open]').classList.toggle('hidden', open);
        menuToggle.querySelector('[data-menu-close]').classList.toggle('hidden', !open);
    };

    menuToggle.addEventListener('click', () => setMenu(menu.classList.contains('hidden')));
    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMenu(false)));
}

// Sombra no header ao rolar
const header = document.querySelector('[data-header]');
const onScroll = () => header?.classList.toggle('is-scrolled', window.scrollY > 16);
window.addEventListener('scroll', onScroll, { passive: true });
onScroll();

// Revelação ao rolar
const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
);

document.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));

// Contadores animados
const countObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (!entry.isIntersecting) return;

        const el = entry.target;
        const target = Number(el.dataset.count);
        const duration = 1200;
        const start = performance.now();

        const tick = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - progress, 3)));
            if (progress < 1) requestAnimationFrame(tick);
        };

        requestAnimationFrame(tick);
        countObserver.unobserve(el);
    });
});

if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('[data-count]').forEach((el) => countObserver.observe(el));
}

// Brilho que segue o cursor nos cards
document.addEventListener('pointermove', (event) => {
    const card = event.target.closest?.('.spotlight');
    if (!card) return;

    const rect = card.getBoundingClientRect();
    card.style.setProperty('--x', `${event.clientX - rect.left}px`);
    card.style.setProperty('--y', `${event.clientY - rect.top}px`);
});

// Filtro de projetos
const filters = document.querySelectorAll('[data-filter]');
const projects = document.querySelectorAll('[data-project-grid] [data-project]');

filters.forEach((button) => {
    button.addEventListener('click', () => {
        const category = button.dataset.filter;

        filters.forEach((b) => b.setAttribute('aria-pressed', String(b === button)));
        projects.forEach((card) => {
            const visible = category === 'all' || card.dataset.category === category;
            card.classList.toggle('is-hidden', !visible);
            if (visible) card.classList.add('is-visible');
        });
    });
});

// Destaque do link da seção visível
const navLinks = document.querySelectorAll('[data-nav-link]');

if (navLinks.length) {
    const sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                navLinks.forEach((link) => link.classList.toggle('is-active', link.dataset.navLink === entry.target.id));
            });
        },
        { rootMargin: '-45% 0px -50% 0px' },
    );

    navLinks.forEach((link) => {
        const section = document.getElementById(link.dataset.navLink);
        if (section) sectionObserver.observe(section);
    });
}
