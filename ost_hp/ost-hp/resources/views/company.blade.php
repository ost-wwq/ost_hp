@extends('layouts.app')

@section('title', '会社情報・アクセス｜ワンステップテックス不動産')

@section('content')

{{-- ========== NAVBAR ========== --}}
<nav id="navbar" class="navbar navbar--dark">
    <div class="container navbar__inner">
        <a href="{{ url('/') }}" class="navbar__logo">
            <img src="{{ asset('ost_icon_20260321.jpg') }}" alt="ロゴ" class="navbar__logo-icon">
            <span class="navbar__logo-text">ワンステップテックス不動産</span>
        </a>
        <button class="navbar__toggle" id="navToggle" aria-label="メニュー">
            <span></span><span></span><span></span>
        </button>
        <ul class="navbar__menu" id="navMenu">
            <li><a href="{{ url('/') }}" class="navbar__link">ホーム</a></li>
            <li><a href="{{ url('/properties') }}" class="navbar__link">物件一覧</a></li>
            <li class="navbar__dropdown" id="navDropdownFlow">
                <a href="#" class="navbar__link navbar__dropdown-toggle" id="navDropdownFlowToggle">
                    フロー
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ url('/flow') }}" class="navbar__dropdown-link">購入フロー</a></li>
                    <li><a href="{{ url('/selling-flow') }}" class="navbar__dropdown-link">売却フロー</a></li>
                    <li><a href="{{ url('/rental-flow') }}" class="navbar__dropdown-link">貸出フロー</a></li>
                    <li><a href="{{ url('/renting-flow') }}" class="navbar__dropdown-link">賃借フロー</a></li>
                </ul>
            </li>
            <li class="navbar__dropdown" id="navDropdownOther">
                <a href="#" class="navbar__link navbar__dropdown-toggle navbar__link--active" id="navDropdownOtherToggle">
                    その他
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ url('/company') }}" class="navbar__dropdown-link navbar__dropdown-link--active">会社情報</a></li>
                    <li><a href="{{ url('/') }}#faq" class="navbar__dropdown-link">よくある質問</a></li>
                    <li><a href="{{ url('/commission') }}" class="navbar__dropdown-link">報酬額</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/') }}#contact" class="navbar__link navbar__link--cta">お問い合わせ</a></li>
        </ul>
    </div>
</nav>

{{-- ========== HERO ========== --}}
<section class="company-hero">
    <div class="company-hero__bg"></div>
    <div class="container company-hero__inner">
        <p class="section-label" style="color:#93c5fd;">Company</p>
        <h1 class="company-hero__title">会社情報</h1>
        <p class="company-hero__desc">
            株式会社ワンステップテックスは、埼玉県川口市を拠点に<br>
            地域に根ざした不動産サービスを提供しています。
        </p>
    </div>
    <div class="company-hero__wave">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80V40C240 0 480 60 720 40S1200 0 1440 40V80H0Z" fill="#f8f9ff"/>
        </svg>
    </div>
</section>

{{-- ========== COMPANY INFO ========== --}}
<section class="company-info">
    <div class="container">
        <div class="company-layout">

            {{-- 会社概要テーブル --}}
            <div class="company-table-wrap reveal">
                <div class="section-label-sm">Company Profile</div>
                <h2 class="company-section-title">会社概要</h2>

                <table class="company-table">
                    <tbody>
                        <tr>
                            <th>会社名</th>
                            <td>株式会社ワンステップテックス</td>
                        </tr>
                        <tr>
                            <th>免許番号</th>
                            <td>埼玉知事(1)第25759号</td>
                        </tr>
                        <tr>
                            <th>所在地</th>
                            <td>
                                〒334-0013<br>
                                埼玉県川口市芝２ー１２ー６
                            </td>
                        </tr>
                        <tr>
                            <th>TEL</th>
                            <td>
                                <a href="tel:09085060043" class="company-link">090-8506-0043</a>
                            </td>
                        </tr>
                        <tr>
                            <th>FAX</th>
                            <td>048-458-0527</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>
                                <a href="mailto:bunsyuu.gi@gmail.com" class="company-link">bunsyuu.gi@gmail.com</a>
                            </td>
                        </tr>
                        <tr>
                            <th>営業時間</th>
                            <td>10:00 〜 19:00（不定休）</td>
                        </tr>
                    </tbody>
                </table>

                {{-- 連絡先カード --}}
                <div class="contact-cards">
                    <a href="tel:09085060043" class="contact-card contact-card--tel">
                        <div class="contact-card__icon">📞</div>
                        <div class="contact-card__body">
                            <div class="contact-card__label">お電話でのお問い合わせ</div>
                            <div class="contact-card__value">090-8506-0043</div>
                        </div>
                    </a>
                    <a href="mailto:bunsyuu.gi@gmail.com" class="contact-card contact-card--mail">
                        <div class="contact-card__icon">✉️</div>
                        <div class="contact-card__body">
                            <div class="contact-card__label">メールでのお問い合わせ</div>
                            <div class="contact-card__value">bunsyuu.gi@gmail.com</div>
                            <div class="contact-card__sub">24時間受付・随時対応</div>
                        </div>
                    </a>
                </div>
            </div>

            {{-- アクセス地図 --}}
            <div class="company-map-wrap reveal">
                <div class="section-label-sm">Access</div>
                <h2 class="company-section-title">アクセス</h2>

                <div class="company-map">
                    <iframe
                        src="https://www.google.com/maps?q=埼玉県川口市芝2-12-6&output=embed&z=16&hl=ja"
                        width="100%"
                        height="400"
                        style="border:0;border-radius:12px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="株式会社ワンステップテックス 地図">
                    </iframe>
                </div>

                <div class="access-info">
                    <div class="access-item">
                        <span class="access-item__icon">📍</span>
                        <div>
                            <div class="access-item__label">住所</div>
                            <div class="access-item__val">埼玉県川口市芝２ー１２ー６</div>
                        </div>
                    </div>
                    <div class="access-item">
                        <span class="access-item__icon">🚃</span>
                        <div>
                            <div class="access-item__label">最寄り駅</div>
                            <div class="access-item__val">JR京浜東北線「蕨駅」徒歩10分</div>
                        </div>
                    </div>
                    <div class="access-item">
                        <span class="access-item__icon">🚗</span>
                        <div>
                            <div class="access-item__label">お車でお越しの方</div>
                            <div class="access-item__val">川口IC（首都高速）より約10分</div>
                        </div>
                    </div>
                </div>

                <a
                    href="https://www.google.com/maps/search/埼玉県川口市芝2-12-6"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="map-open-btn">
                    <svg viewBox="0 0 24 24" fill="none" width="18" height="18">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
                    </svg>
                    Google マップで開く
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ========== CTA ========== --}}
<section class="company-cta">
    <div class="container">
        <div class="company-cta__box">
            <p class="section-label" style="color:#93c5fd;">Contact Us</p>
            <h2 class="company-cta__title">お気軽にご相談ください</h2>
            <p class="company-cta__desc">
                不動産の購入・売却・賃貸など、どんなご相談でも無料で対応いたします。<br>
                まずはお電話またはメールでお気軽にお問い合わせください。
            </p>
            <div class="company-cta__buttons">
                <a href="{{ url('/') }}#contact" class="btn btn--primary btn--lg">お問い合わせフォームへ</a>
                <a href="tel:09085060043" class="btn btn--outline-white btn--lg">📞 090-8506-0043</a>
            </div>
        </div>
    </div>
</section>

{{-- ========== FOOTER ========== --}}
<footer class="footer">
    <div class="container footer__inner">
        <div class="footer__brand">
            <img src="{{ asset('ost_icon_20260321.jpg') }}" alt="ロゴ" class="footer__logo-icon">
            <span class="footer__logo-text">ワンステップテックス不動産</span>
        </div>
        <div class="footer__links">
            <a href="{{ url('/') }}" class="footer__link">ホーム</a>
            <a href="{{ url('/properties') }}" class="footer__link">物件一覧</a>
            <a href="{{ url('/flow') }}" class="footer__link">購入フロー</a>
            <a href="{{ url('/selling-flow') }}" class="footer__link">売却フロー</a>
            <a href="{{ url('/company') }}" class="footer__link">会社情報</a>
            <a href="{{ url('/') }}#contact" class="footer__link">お問い合わせ</a>
        </div>
        <p class="footer__copy">&copy; {{ date('Y') }} 株式会社ワンステップテックス. All rights reserved.</p>
    </div>
</footer>

{{-- ========== CSS ========== --}}
<style>
/* ---- NAVBAR ---- */
.navbar--dark { background: var(--dark); }
.navbar--dark .navbar__logo { color: var(--white); }
.navbar--dark .navbar__link { color: rgba(255,255,255,.85); }
.navbar--dark .navbar__link:hover { color: var(--white); background: rgba(255,255,255,.1); }
.navbar--dark .navbar__link--active { color: var(--white); background: rgba(255,255,255,.15); font-weight: 700; }
.navbar--dark .navbar__link--cta { background: var(--blue); color: var(--white) !important; }
.navbar--dark .navbar__link--cta:hover { background: var(--blue-dark) !important; }
.navbar--dark .navbar__toggle span { background: var(--white); }

/* Dropdown */
.navbar__dropdown { position: relative; }
.navbar__dropdown-toggle { display: flex !important; align-items: center; gap: 4px; cursor: pointer; }
.navbar__dropdown-arrow { width: 14px; height: 14px; transition: transform .2s; flex-shrink: 0; }
.navbar__dropdown.is-open .navbar__dropdown-arrow { transform: rotate(180deg); }
.navbar__dropdown-menu { display: none; position: absolute; top: calc(100% + 10px); left: 50%; transform: translateX(-50%); background: var(--white); border-radius: 12px; box-shadow: 0 8px 28px rgba(0,0,0,.13); min-width: 140px; padding: 8px; z-index: 200; }
.navbar__dropdown.is-open .navbar__dropdown-menu { display: block; }
.navbar__dropdown-link { display: block; padding: 8px 14px; font-size: .88rem; font-weight: 500; color: var(--text); border-radius: 8px; transition: .2s; white-space: nowrap; }
.navbar__dropdown-link:hover { color: var(--blue); background: var(--blue-light); }
.navbar__dropdown-link--active { color: var(--blue); font-weight: 700; }

/* ---- HERO ---- */
.company-hero {
    position: relative;
    background: linear-gradient(135deg, #0f2460 0%, #1a4cbd 50%, #2f7cff 100%);
    padding: 140px 0 60px;
    overflow: hidden;
    text-align: center;
}
.company-hero__bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 20% 50%, rgba(78,186,154,.12) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(241,124,32,.08) 0%, transparent 50%);
}
.company-hero__inner { position: relative; z-index: 1; }
.company-hero__title {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 700;
    color: var(--white);
    margin-bottom: 20px;
    line-height: 1.2;
}
.company-hero__desc {
    font-size: 1.05rem;
    color: rgba(255,255,255,.85);
    line-height: 1.8;
}
.company-hero__wave { position: relative; margin-bottom: -2px; line-height: 0; }
.company-hero__wave svg { width: 100%; height: 80px; display: block; }

/* ---- INFO SECTION ---- */
.company-info { background: var(--bg-light); padding: 80px 0; }
.company-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: start;
}
.section-label-sm {
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--blue);
    margin-bottom: 8px;
    display: block;
}
.company-section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--blue);
}

/* ---- TABLE ---- */
.company-table-wrap, .company-map-wrap {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 36px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
}
.company-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 28px;
    font-size: .92rem;
}
.company-table th,
.company-table td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
    vertical-align: top;
    line-height: 1.7;
}
.company-table th {
    width: 36%;
    color: var(--text-light);
    font-weight: 600;
    white-space: nowrap;
    background: var(--bg-light);
}
.company-table td { color: var(--dark); }
.company-table tr:last-child th,
.company-table tr:last-child td { border-bottom: none; }
.company-link {
    color: var(--blue);
    font-weight: 600;
    transition: color var(--transition);
}
.company-link:hover { color: var(--blue-dark); text-decoration: underline; }

/* ---- CONTACT CARDS ---- */
.contact-cards { display: flex; flex-direction: column; gap: 12px; }
.contact-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px 20px;
    border-radius: var(--radius-md);
    border: 1.5px solid;
    transition: transform var(--transition), box-shadow var(--transition);
    text-decoration: none;
}
.contact-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
.contact-card--tel { background: #eef4ff; border-color: #c7d9ff; }
.contact-card--mail { background: #f0faf6; border-color: #b6e8d4; }
.contact-card__icon { font-size: 1.8rem; flex-shrink: 0; }
.contact-card__label { font-size: .72rem; font-weight: 700; color: var(--text-light); margin-bottom: 4px; }
.contact-card__value { font-size: 1.05rem; font-weight: 700; color: var(--dark); }
.contact-card__sub { font-size: .75rem; color: var(--text-light); margin-top: 2px; }

/* ---- MAP ---- */
.company-map {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 20px;
    border: 1px solid var(--border);
}
.company-map iframe { display: block; }

.access-info { display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px; }
.access-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 16px;
    background: var(--bg-light);
    border-radius: var(--radius-sm);
    font-size: .88rem;
}
.access-item__icon { font-size: 1.2rem; flex-shrink: 0; margin-top: 2px; }
.access-item__label { font-size: .72rem; font-weight: 700; color: var(--text-light); margin-bottom: 3px; }
.access-item__val { color: var(--dark); font-weight: 500; line-height: 1.5; }

.map-open-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--white);
    border: 1.5px solid var(--blue);
    border-radius: 50px;
    color: var(--blue);
    font-size: .85rem;
    font-weight: 700;
    transition: var(--transition);
}
.map-open-btn:hover {
    background: var(--blue);
    color: var(--white);
}

/* ---- CTA ---- */
.company-cta {
    background: linear-gradient(135deg, #0f2460 0%, #1a4cbd 60%, #2f7cff 100%);
    padding: 80px 0;
}
.company-cta__box { text-align: center; }
.company-cta__title {
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 700;
    color: var(--white);
    margin-bottom: 16px;
}
.company-cta__desc {
    font-size: 1rem;
    color: rgba(255,255,255,.85);
    line-height: 1.8;
    margin-bottom: 36px;
}
.company-cta__buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.btn--lg { padding: 16px 40px; font-size: 1rem; }
.btn--outline-white {
    background: transparent; color: var(--white);
    border: 2px solid rgba(255,255,255,.6); border-radius: 50px;
    padding: 16px 40px; font-size: 1rem; font-weight: 700;
    display: inline-flex; align-items: center; justify-content: center;
    transition: var(--transition);
}
.btn--outline-white:hover { background: rgba(255,255,255,.12); border-color: var(--white); }

/* ---- FOOTER ---- */
.footer { background: var(--dark); padding: 40px 0; }
.footer__inner { display: flex; flex-direction: column; align-items: center; gap: 20px; }
.footer__brand { display: flex; align-items: center; gap: 10px; color: var(--white); font-weight: 700; }
.footer__logo-icon { width: 32px; height: 32px; object-fit: contain; border-radius: 5px; display: block; }
.footer__links { display: flex; gap: 24px; flex-wrap: wrap; justify-content: center; }
.footer__link { font-size: .85rem; color: rgba(255,255,255,.6); transition: color var(--transition); }
.footer__link:hover { color: var(--white); }
.footer__copy { font-size: .75rem; color: rgba(255,255,255,.4); }

/* ---- REVEAL ---- */
.reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }
.reveal.visible { opacity: 1; transform: none; }

/* ---- RESPONSIVE ---- */
@media (max-width: 900px) {
    .company-layout { grid-template-columns: 1fr; gap: 32px; }
}
@media (max-width: 600px) {
    .company-hero { padding: 120px 0 40px; }
    .company-table-wrap, .company-map-wrap { padding: 20px; }
    .company-table th { width: 40%; font-size: .82rem; }
    .company-table td { font-size: .82rem; }
    .navbar__menu { display: none; flex-direction: column; position: absolute; top: 72px; left: 0; right: 0; background: var(--dark); padding: 16px; gap: 4px; }
    .navbar__menu.open { display: flex; }
    .navbar__toggle { display: flex; }
}
</style>

{{-- ========== JS ========== --}}
<script>
const revealEls = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
}, { threshold: 0.12 });
revealEls.forEach(el => obs.observe(el));

</script>

@endsection
