/* ===========================
   Navbar scroll behavior
   =========================== */
(function () {
    var navbar = document.getElementById('navbar');
    if (!navbar) return;

    function onScroll() {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();

/* ===========================
   Mobile menu toggle
   =========================== */
(function () {
    var toggle = document.getElementById('navToggle');
    var menu = document.getElementById('navMenu');
    if (!toggle || !menu) return;

    toggle.addEventListener('click', function () {
        menu.classList.toggle('open');
    });

    // Close menu when clicking a link
    menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            menu.classList.remove('open');
        });
    });
})();

/* ===========================
   Dropdown menu (複数対応)
   =========================== */
(function () {
    document.querySelectorAll('.navbar__dropdown').forEach(function (dd) {
        var toggle = dd.querySelector('.navbar__dropdown-toggle');
        if (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                var wasOpen = dd.classList.contains('is-open');
                document.querySelectorAll('.navbar__dropdown').forEach(function (d) { d.classList.remove('is-open'); });
                if (!wasOpen) dd.classList.add('is-open');
            });
        }
    });
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.navbar__dropdown')) {
            document.querySelectorAll('.navbar__dropdown').forEach(function (d) { d.classList.remove('is-open'); });
        }
    });
})();

/* ===========================
   FAQ accordion
   =========================== */
(function () {
    var items = document.querySelectorAll('.faq__item');
    items.forEach(function (item) {
        var btn = item.querySelector('.faq__question');
        var answer = item.querySelector('.faq__answer');
        if (!btn || !answer) return;

        btn.addEventListener('click', function () {
            var isOpen = btn.getAttribute('aria-expanded') === 'true';

            // Close all
            items.forEach(function (i) {
                var b = i.querySelector('.faq__question');
                var a = i.querySelector('.faq__answer');
                if (b) b.setAttribute('aria-expanded', 'false');
                if (a) a.classList.remove('open');
            });

            // Open current if it was closed
            if (!isOpen) {
                btn.setAttribute('aria-expanded', 'true');
                answer.classList.add('open');
            }
        });
    });
})();

/* ===========================
   Scroll reveal animations
   =========================== */
(function () {
    var revealEls = document.querySelectorAll(
        '.service-card, .faq__item, .stats__item, .contact__info-item, ' +
        '.promise__img, .promise__content, .section-header'
    );

    revealEls.forEach(function (el) {
        el.classList.add('reveal');
    });

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, i) {
            if (entry.isIntersecting) {
                setTimeout(function () {
                    entry.target.classList.add('visible');
                }, i * 60);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    revealEls.forEach(function (el) {
        observer.observe(el);
    });
})();

/* ===========================
   Contact form (Ajax送信)
   =========================== */
(function () {
    var form = document.getElementById('contactForm');
    var msg = document.getElementById('formMessage');
    if (!form || !msg) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var btn = form.querySelector('button[type="submit"]');
        btn.textContent = '送信中...';
        btn.disabled = true;
        msg.style.display = 'none';

        var token = form.querySelector('input[name="_token"]');
        var body = new FormData(form);

        fetch('/contact', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token ? token.value : '',
                'Accept': 'application/json',
            },
            body: body,
        })
        .then(function (res) {
            return res.json().then(function (data) {
                return { ok: res.ok, data: data };
            });
        })
        .then(function (result) {
            msg.style.display = 'block';
            if (result.ok && result.data.status === 'ok') {
                msg.className = 'form-feedback form-feedback--success';
                msg.textContent = 'お問い合わせを受け付けました。担当者よりご連絡いたします。';
                form.reset();
            } else {
                var errors = result.data.errors;
                var text = errors
                    ? Object.values(errors).flat().join('\n')
                    : '送信に失敗しました。時間をおいて再度お試しください。';
                msg.className = 'form-feedback form-feedback--error';
                msg.textContent = text;
            }
        })
        .catch(function () {
            msg.style.display = 'block';
            msg.className = 'form-feedback form-feedback--error';
            msg.textContent = '通信エラーが発生しました。時間をおいて再度お試しください。';
        })
        .finally(function () {
            btn.textContent = '送信する';
            btn.disabled = false;
            msg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    });
})();

/* ===========================
   Smooth scroll for anchor links
   =========================== */
(function () {
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                var offset = 80;
                var top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });
})();

/* ===========================
   Counter animation for stats
   =========================== */
(function () {
    var counters = document.querySelectorAll('.stats__number');

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var el = entry.target;
            var text = el.textContent;
            var suffix = el.querySelector('span') ? el.querySelector('span').textContent : '';
            var numMatch = text.match(/[\d]+/);
            if (!numMatch) return;
            var target = parseInt(numMatch[0], 10);
            var start = 0;
            var duration = 1600;
            var startTime = null;

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                var progress = Math.min((timestamp - startTime) / duration, 1);
                var eased = 1 - Math.pow(1 - progress, 3);
                var current = Math.round(eased * target);
                el.textContent = current;
                if (suffix) {
                    var span = document.createElement('span');
                    span.textContent = suffix;
                    el.appendChild(span);
                }
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
            observer.unobserve(el);
        });
    }, { threshold: 0.5 });

    counters.forEach(function (el) { observer.observe(el); });
})();
