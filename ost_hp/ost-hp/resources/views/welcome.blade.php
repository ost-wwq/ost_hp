@extends('layouts.app')

@section('title', 'ワンステップテックス不動産')

@section('content')

<!-- ナビゲーション -->
<nav id="navbar" class="navbar">
    <div class="container navbar__inner">
        <a href="#" class="navbar__logo">
            <span class="navbar__logo-icon">🏠</span>
            <span class="navbar__logo-text">ワンステップテックス不動産</span>
        </a>
        <button class="navbar__toggle" id="navToggle" aria-label="メニュー">
            <span></span><span></span><span></span>
        </button>
        <ul class="navbar__menu" id="navMenu">
            <li><a href="#home" class="navbar__link">ホーム</a></li>
            <li><a href="#services" class="navbar__link">サービス</a></li>
            <li class="navbar__dropdown" id="navDropdownFlow">
                <a href="#" class="navbar__link navbar__dropdown-toggle" id="navDropdownFlowToggle">
                    フロー
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ route('flow') }}" class="navbar__dropdown-link">購入フロー</a></li>
                    <li><a href="{{ route('selling-flow') }}" class="navbar__dropdown-link">売却フロー</a></li>
                    <li><a href="{{ route('rental-flow') }}" class="navbar__dropdown-link">貸出フロー</a></li>
                    <li><a href="{{ route('renting-flow') }}" class="navbar__dropdown-link">賃借フロー</a></li>
                </ul>
            </li>
            <li class="navbar__dropdown" id="navDropdownOther">
                <a href="#" class="navbar__link navbar__dropdown-toggle" id="navDropdownOtherToggle">
                    その他
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ route('company') }}" class="navbar__dropdown-link">会社情報</a></li>
                    <li><a href="#faq" class="navbar__dropdown-link">よくある質問</a></li>
                    <li><a href="{{ route('commission') }}" class="navbar__dropdown-link">報酬額</a></li>
                </ul>
            </li>
            <li><a href="#contact" class="navbar__link navbar__link--cta">お問い合わせ</a></li>
        </ul>
    </div>
</nav>

<!-- ヒーローセクション -->
<section id="home" class="hero">
    <div class="hero__overlay"></div>
    <div class="hero__content">
        <p class="hero__sub">あなたの理想をカタチに</p>
        <h1 class="hero__title">理想の暮らしを<br>手に入れよう</h1>
        <p class="hero__description">
            お客様一人ひとりのご要望に寄り添い、<br>
            豊富な経験と地域ネットワークで最適な不動産をご提案します。
        </p>
        <div class="hero__buttons">
            <a href="#contact" class="btn btn--primary">無料相談はこちら</a>
            <a href="#services" class="btn btn--outline">サービスを見る</a>
        </div>
    </div>
    <div class="hero__scroll">
        <span>スクロール</span>
        <div class="hero__scroll-line"></div>
    </div>
</section>

<!-- 私たちの約束セクション -->
<section id="promise" class="promise">
    <div class="container">
        <div class="promise__grid">
            <div class="promise__content">
                <p class="section-label">Our Promise</p>
                <h2 class="section-title">お客様一人ひとりに<br>最適なご提案</h2>
                <p class="promise__text">
                    私たちワンステップテックス不動産は、お客様の人生における大切な決断をサポートします。
                    豊富な経験と深い地域知識を活かし、住まい探しから売却まで、
                    最適なご提案をお届けします。
                </p>
                <p class="promise__text">
                    専門家チームが法律・税務面のアドバイスも含め、
                    安心して取引いただけるよう全力でサポートいたします。
                </p>
                <a href="#contact" class="btn btn--primary">まずはご相談を</a>
            </div>
            <div class="promise__images">
                <div class="promise__img promise__img--1">
                    <div class="promise__img-fallback">
                        <svg viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="120" height="100" rx="12" fill="#e8f0fe"/>
                            <path d="M60 20L90 42v38H30V42L60 20z" fill="#2f7cff" opacity=".25" stroke="#2f7cff" stroke-width="2.5" stroke-linejoin="round"/>
                            <rect x="48" y="56" width="24" height="24" rx="2" fill="#2f7cff" opacity=".4"/>
                            <rect x="36" y="44" width="14" height="10" rx="1" fill="#2f7cff" opacity=".3"/>
                            <rect x="70" y="44" width="14" height="10" rx="1" fill="#2f7cff" opacity=".3"/>
                        </svg>
                    </div>
                </div>
                <div class="promise__img promise__img--2">
                    <div class="promise__img-fallback promise__img-fallback--orange">
                        <svg viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="120" height="100" rx="12" fill="#fef0e4"/>
                            <rect x="18" y="28" width="84" height="52" rx="4" fill="#f17c20" opacity=".2" stroke="#f17c20" stroke-width="2.5"/>
                            <rect x="28" y="38" width="22" height="16" rx="2" fill="#f17c20" opacity=".4"/>
                            <rect x="58" y="38" width="34" height="8" rx="2" fill="#f17c20" opacity=".35"/>
                            <rect x="58" y="52" width="22" height="6" rx="2" fill="#f17c20" opacity=".25"/>
                            <rect x="40" y="62" width="40" height="18" rx="3" fill="#f17c20" opacity=".35"/>
                        </svg>
                    </div>
                </div>
                <div class="promise__img promise__img--3">
                    <div class="promise__img-fallback promise__img-fallback--teal">
                        <svg viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="120" height="100" rx="12" fill="#e4f7f2"/>
                            <circle cx="60" cy="42" r="20" fill="#4eba9a" opacity=".25" stroke="#4eba9a" stroke-width="2.5"/>
                            <path d="M30 84c0-16.569 13.431-30 30-30s30 13.431 30 30" stroke="#4eba9a" stroke-width="2.5" stroke-linecap="round"/>
                            <circle cx="60" cy="42" r="10" fill="#4eba9a" opacity=".4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- サービスセクション -->
<section id="services" class="services">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Services</p>
            <h2 class="section-title">私たちのサービス</h2>
            <p class="section-desc">お客様の不動産に関するあらゆるニーズにお応えします</p>
        </div>

        <div class="services__grid">
            <div class="service-card">
                <div class="service-card__icon service-card__icon--blue">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="24" r="22" fill="#2f7cff" opacity=".1"/>
                        <path d="M24 10L38 20v18H10V20L24 10z" stroke="#2f7cff" stroke-width="2.5" stroke-linejoin="round"/>
                        <rect x="19" y="28" width="10" height="10" rx="1" stroke="#2f7cff" stroke-width="2"/>
                        <rect x="17" y="20" width="6" height="6" rx="1" stroke="#2f7cff" stroke-width="1.5"/>
                        <rect x="25" y="20" width="6" height="6" rx="1" stroke="#2f7cff" stroke-width="1.5"/>
                    </svg>
                </div>
                <h3 class="service-card__title">不動産仲介</h3>
                <p class="service-card__text">
                    蓄積された専門知識を活かし、スムーズな不動産取引をサポートします。
                    物件探しから契約まで、ワンストップでご対応します。
                </p>
                <ul class="service-card__list">
                    <li>希望物件の調査・紹介</li>
                    <li>価格交渉のサポート</li>
                    <li>各種書類の手続き代行</li>
                </ul>
            </div>

            <div class="service-card service-card--featured">
                <div class="service-card__badge">人気</div>
                <div class="service-card__icon service-card__icon--orange">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="24" r="22" fill="#f17c20" opacity=".1"/>
                        <path d="M14 34L24 14l10 20" stroke="#f17c20" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 28h14" stroke="#f17c20" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="34" cy="16" r="5" fill="#f17c20" opacity=".2" stroke="#f17c20" stroke-width="1.5"/>
                        <path d="M32 16h4M34 14v4" stroke="#f17c20" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="service-card__title">不動産査定</h3>
                <p class="service-card__text">
                    専門家が客観的な視点で物件の価値を適正に評価します。
                    条件・立地・将来性など多角的に分析し、適切な価格をご提案します。
                </p>
                <ul class="service-card__list">
                    <li>無料査定サービス</li>
                    <li>客観的な価値評価</li>
                    <li>市場動向を踏まえた分析</li>
                </ul>
            </div>

            <div class="service-card">
                <div class="service-card__icon service-card__icon--teal">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="24" r="22" fill="#4eba9a" opacity=".1"/>
                        <circle cx="24" cy="20" r="7" stroke="#4eba9a" stroke-width="2.5"/>
                        <path d="M12 38c0-6.627 5.373-12 12-12s12 5.373 12 12" stroke="#4eba9a" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="service-card__title">専門家によるアドバイス</h3>
                <p class="service-card__text">
                    法律・税務・ローンなど不動産取引に関わる専門的な事項について、
                    経験豊富なスタッフが丁寧にアドバイスいたします。
                </p>
                <ul class="service-card__list">
                    <li>法律・税務相談</li>
                    <li>住宅ローンのご相談</li>
                    <li>地域情報のご提供</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- 物件一覧セクション -->
@if(isset($featuredProperties) && $featuredProperties->isNotEmpty())
<section id="properties" class="featured-properties">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Properties</p>
            <h2 class="section-title">おすすめ物件</h2>
            <p class="section-desc">現在販売中のおすすめ物件をご紹介します</p>
        </div>

        <div class="prop-grid">
            @foreach($featuredProperties as $p)
            <a href="{{ route('properties.show', $p) }}" class="prop-home-card reveal">
                <div class="prop-home-card__img">
                    @if($p->main_image)
                        <img src="{{ asset('uploads/'.$p->main_image) }}" alt="{{ $p->title }}">
                    @else
                        <div class="prop-home-card__placeholder">🏠</div>
                    @endif
                    <span class="prop-home-card__type">{{ $p->typeLabel() }}</span>
                </div>
                <div class="prop-home-card__body">
                    <div class="prop-home-card__price">{{ $p->priceFormatted() }}</div>
                    <h3 class="prop-home-card__title">{{ $p->title }}</h3>
                    <div class="prop-home-card__meta">
                        @if($p->rooms)<span>🚪 {{ $p->rooms }}</span>@endif
                        @if($p->area)<span>📐 {{ number_format($p->area,1) }}㎡</span>@endif
                    </div>
                    <div class="prop-home-card__address">📍 {{ $p->address }}</div>
                </div>
            </a>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:48px;">
            <a href="{{ route('properties.index') }}" class="btn btn--primary">すべての物件を見る</a>
        </div>
    </div>
</section>
@endif

<!-- 数字で見るセクション -->
<section class="stats">
    <div class="container">
        <div class="stats__grid">
            {{-- 取引実績（実績ができたら再表示）
            <div class="stats__item">
                <div class="stats__number">500<span>+</span></div>
                <div class="stats__label">取引実績</div>
            </div>
            --}}
            {{-- 業界経験（実績ができたら再表示）
            <div class="stats__item">
                <div class="stats__number">15<span>年</span></div>
                <div class="stats__label">業界経験</div>
            </div>
            --}}
            {{-- 顧客満足度（実績ができたら再表示）
            <div class="stats__item">
                <div class="stats__number">98<span>%</span></div>
                <div class="stats__label">顧客満足度</div>
            </div>
            --}}
            {{-- 査定費用（実績ができたら再表示）
            <div class="stats__item">
                <div class="stats__number">0<span>円</span></div>
                <div class="stats__label">査定費用</div>
            </div>
            --}}
        </div>
    </div>
</section>

<!-- FAQセクション -->
<section id="faq" class="faq">
    <div class="container">
        <div class="section-header">
            <p class="section-label">FAQ</p>
            <h2 class="section-title">よくある質問</h2>
            <p class="section-desc">お客様からよくいただくご質問をまとめました</p>
        </div>

        <div class="faq__list">
            <div class="faq__item">
                <button class="faq__question" aria-expanded="false">
                    <span>不動産仲介はどのように進められますか？</span>
                    <span class="faq__icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <div class="faq__answer">
                    <div class="faq__answer-inner">
                        <p>まずはお客様のご希望をヒアリングし、条件に合った物件をご紹介します。気に入った物件が見つかりましたら、価格交渉から契約手続きまで弊社スタッフが一貫してサポートいたします。書類の準備や手続きも代行しますので、安心してお任せください。</p>
                    </div>
                </div>
            </div>

            <div class="faq__item">
                <button class="faq__question" aria-expanded="false">
                    <span>不動産査定とはどのようなものですか？</span>
                    <span class="faq__icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <div class="faq__answer">
                    <div class="faq__answer-inner">
                        <p>不動産査定とは、専門家が客観的な立場から物件の価値を評価するサービスです。物件の条件（築年数・間取り・設備など）、立地条件、周辺環境、市場動向、将来的な価値などを総合的に考慮して、適正な価格を算出します。</p>
                    </div>
                </div>
            </div>

            <div class="faq__item">
                <button class="faq__question" aria-expanded="false">
                    <span>査定費用はかかりますか？</span>
                    <span class="faq__icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <div class="faq__answer">
                    <div class="faq__answer-inner">
                        <p>査定は完全無料で承っております。費用が発生するのは、実際に売買が成立した場合の仲介手数料のみです。まずはお気軽にご相談ください。査定結果に基づいて売却をご検討いただくかどうかはお客様のご判断にお任せします。</p>
                    </div>
                </div>
            </div>

            <div class="faq__item">
                <button class="faq__question" aria-expanded="false">
                    <span>物件を売却するまでどのくらいかかりますか？</span>
                    <span class="faq__icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <div class="faq__answer">
                    <div class="faq__answer-inner">
                        <p>物件の種類や条件によって異なりますが、一般的に3〜6ヶ月程度が目安となります。ただし、立地条件や価格設定によっては早期成約も十分可能です。弊社の豊富なネットワークを活かして、できるだけ早く最適な買主様をご紹介できるよう努めます。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- お問い合わせセクション -->
<section id="contact" class="contact">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Contact</p>
            <h2 class="section-title">お問い合わせ</h2>
            <p class="section-desc">ご質問・ご相談はお気軽にどうぞ。専門スタッフが丁寧にご対応します。</p>
        </div>

        <div class="contact__grid">
            <div class="contact__info">
                <div class="contact__info-item">
                    <div class="contact__info-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.1 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .82h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact__info-label">電話番号</div>
                        <div class="contact__info-value">03-XXXX-XXXX</div>
                    </div>
                </div>
                <div class="contact__info-item">
                    <div class="contact__info-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact__info-label">メールアドレス</div>
                        <div class="contact__info-value">info@onesteptechs.com</div>
                    </div>
                </div>
                <div class="contact__info-item">
                    <div class="contact__info-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact__info-label">営業時間</div>
                        <div class="contact__info-value">平日 9:00 〜 18:00</div>
                    </div>
                </div>
            </div>

            <form class="contact__form" id="contactForm">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="name">お名前 <span class="form-required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="山田 太郎" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">メールアドレス <span class="form-required">*</span></label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="example@mail.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="subject">件名</label>
                    <input type="text" id="subject" name="subject" class="form-input" placeholder="お問い合わせの件名">
                </div>
                <div class="form-group">
                    <label class="form-label" for="message">お問い合わせ内容 <span class="form-required">*</span></label>
                    <textarea id="message" name="message" class="form-textarea" placeholder="ご質問やご相談の内容をご記入ください" required></textarea>
                </div>
                <div id="formMessage" class="form-feedback" style="display:none;"></div>
                <button type="submit" class="btn btn--primary btn--full">送信する</button>
            </form>
        </div>
    </div>
</section>

<!-- フッター -->
<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="footer__brand">
                <a href="#" class="footer__logo">
                    <span>🏠</span>
                    <span>ワンステップテックス不動産</span>
                </a>
                <p class="footer__tagline">お客様一人ひとりに最適なご提案</p>
            </div>
            <div class="footer__links">
                <div class="footer__links-group">
                    <h4>メニュー</h4>
                    <ul>
                        <li><a href="#home">ホーム</a></li>
                        <li><a href="#services">サービス</a></li>
                        <li><a href="#faq">よくある質問</a></li>
                        <li><a href="#contact">お問い合わせ</a></li>
                    </ul>
                </div>
                <div class="footer__links-group">
                    <h4>サービス</h4>
                    <ul>
                        <li><a href="#services">不動産仲介</a></li>
                        <li><a href="#services">不動産査定</a></li>
                        <li><a href="#services">専門家アドバイス</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <p>&copy; {{ date('Y') }} ワンステップテックス不動産. All rights reserved.</p>
        </div>
    </div>
</footer>

@endsection
