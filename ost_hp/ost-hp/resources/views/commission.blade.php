@extends('layouts.app')

@section('title', '報酬額について｜ワンステップテックス不動産')

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
                    <li><a href="{{ url('/company') }}" class="navbar__dropdown-link">会社情報</a></li>
                    <li><a href="{{ url('/') }}#faq" class="navbar__dropdown-link">よくある質問</a></li>
                    <li><a href="{{ url('/commission') }}" class="navbar__dropdown-link navbar__dropdown-link--active">報酬額</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/') }}#contact" class="navbar__link navbar__link--cta">お問い合わせ</a></li>
        </ul>
    </div>
</nav>

{{-- ========== HERO ========== --}}
<section class="comm-hero">
    <div class="comm-hero__bg"></div>
    <div class="container comm-hero__inner">
        <p class="section-label" style="color:#fde68a;">Commission</p>
        <h1 class="comm-hero__title">報酬額について</h1>
        <p class="comm-hero__desc">
            宅地建物取引業法に基づく、当社の仲介手数料・報酬額をご案内します。<br>
            お客様に安心してご依頼いただけるよう、料金体系を明示しております。
        </p>
    </div>
    <div class="comm-hero__wave">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80V40C240 0 480 60 720 40S1200 0 1440 40V80H0Z" fill="#f8f9ff"/>
        </svg>
    </div>
</section>

{{-- ========== 法的根拠 ========== --}}
<section class="comm-legal">
    <div class="container">
        <div class="legal-banner reveal">
            <div class="legal-banner__icon">⚖️</div>
            <div class="legal-banner__body">
                <h3 class="legal-banner__title">宅地建物取引業法に基づく報酬額</h3>
                <p class="legal-banner__text">
                    当社の報酬額は、宅地建物取引業法第46条および国土交通大臣が定める報酬の限度額の告示に基づいています。
                    下記に記載する金額は<strong>法律で定められた上限額</strong>であり、成約時のみ発生します。
                    ご不明な点はお気軽にお問い合わせください。
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ========== 売買 ========== --}}
<section class="comm-section">
    <div class="container">
        <div class="section-header">
            <p class="section-label">売買取引</p>
            <h2 class="section-title">売買に関する仲介手数料</h2>
            <p class="section-desc">不動産の売買をご依頼いただいた場合の仲介手数料（報酬額の上限）です</p>
        </div>

        <div class="comm-card reveal">
            <div class="comm-card__header comm-card__header--blue">
                <div class="comm-card__header-icon">🏠</div>
                <div>
                    <h3 class="comm-card__header-title">売買仲介手数料（上限額）</h3>
                    <p class="comm-card__header-sub">売主様・買主様それぞれからいただく報酬の上限</p>
                </div>
            </div>
            <div class="comm-card__body">
                <table class="comm-table">
                    <thead>
                        <tr>
                            <th>売買価格（税抜）</th>
                            <th>仲介手数料の上限</th>
                            <th>計算例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>200万円以下の部分</td>
                            <td class="comm-table__rate">売買価格 × <strong>5%</strong> + 消費税</td>
                            <td>200万円 → 11万円（税込）</td>
                        </tr>
                        <tr>
                            <td>200万円超〜400万円以下の部分</td>
                            <td class="comm-table__rate">売買価格 × <strong>4%</strong> + 2万円 + 消費税</td>
                            <td>300万円 → 14万3千円（税込）</td>
                        </tr>
                        <tr class="comm-table__highlight">
                            <td>400万円超の部分</td>
                            <td class="comm-table__rate">売買価格 × <strong>3%</strong> + 6万円 + 消費税</td>
                            <td>3,000万円 → 105万6千円（税込）</td>
                        </tr>
                    </tbody>
                </table>

                <div class="comm-formula reveal">
                    <div class="comm-formula__label">400万円超の物件における速算式</div>
                    <div class="comm-formula__eq">仲介手数料 ＝ 売買価格（税抜） × 3% ＋ 6万円 ＋ 消費税</div>
                </div>

                <div class="comm-examples reveal">
                    <h4 class="comm-examples__title">計算例</h4>
                    <div class="comm-examples__grid">
                        <div class="comm-example-card">
                            <div class="comm-example-card__price">売買価格 1,000万円</div>
                            <div class="comm-example-card__calc">1,000万円 × 3% + 6万円 = 36万円</div>
                            <div class="comm-example-card__total">税込 <strong>39万6千円</strong></div>
                        </div>
                        <div class="comm-example-card">
                            <div class="comm-example-card__price">売買価格 2,000万円</div>
                            <div class="comm-example-card__calc">2,000万円 × 3% + 6万円 = 66万円</div>
                            <div class="comm-example-card__total">税込 <strong>72万6千円</strong></div>
                        </div>
                        <div class="comm-example-card">
                            <div class="comm-example-card__price">売買価格 3,000万円</div>
                            <div class="comm-example-card__calc">3,000万円 × 3% + 6万円 = 96万円</div>
                            <div class="comm-example-card__total">税込 <strong>105万6千円</strong></div>
                        </div>
                        <div class="comm-example-card">
                            <div class="comm-example-card__price">売買価格 5,000万円</div>
                            <div class="comm-example-card__calc">5,000万円 × 3% + 6万円 = 156万円</div>
                            <div class="comm-example-card__total">税込 <strong>171万6千円</strong></div>
                        </div>
                    </div>
                </div>

                <div class="comm-note reveal">
                    <div class="comm-note__icon">📌</div>
                    <div>
                        <strong>低廉な空き家等の特例（2024年7月改正）</strong><br>
                        売買価格800万円以下の物件については、売主様からの報酬を現地調査費用等の実費相当額を加算した額（上限：売買価格の3%+6万円+実費）とすることができます。詳細はお問い合わせください。
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== 賃貸 ========== --}}
<section class="comm-section comm-section--alt">
    <div class="container">
        <div class="section-header">
            <p class="section-label">賃貸取引</p>
            <h2 class="section-title">賃貸に関する仲介手数料</h2>
            <p class="section-desc">不動産の賃貸借をご依頼いただいた場合の仲介手数料（報酬額の上限）です</p>
        </div>

        <div class="comm-card reveal">
            <div class="comm-card__header comm-card__header--teal">
                <div class="comm-card__header-icon">🔑</div>
                <div>
                    <h3 class="comm-card__header-title">賃貸仲介手数料（上限額）</h3>
                    <p class="comm-card__header-sub">貸主様・借主様合わせた報酬の上限</p>
                </div>
            </div>
            <div class="comm-card__body">
                <table class="comm-table">
                    <thead>
                        <tr>
                            <th>取引種別</th>
                            <th>報酬額の上限</th>
                            <th>備考</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>居住用建物の賃貸借</td>
                            <td class="comm-table__rate">貸主・借主合計で<strong>賃料の1ヶ月分</strong> + 消費税</td>
                            <td>借主の承諾がある場合は借主から1ヶ月分まで受領可</td>
                        </tr>
                        <tr>
                            <td>居住用以外の賃貸借<br>（事務所・店舗等）</td>
                            <td class="comm-table__rate">貸主・借主それぞれ<strong>賃料の1ヶ月分</strong> + 消費税</td>
                            <td>貸主・借主それぞれから受領可能</td>
                        </tr>
                    </tbody>
                </table>

                <div class="comm-formula reveal">
                    <div class="comm-formula__label">居住用の一般的な計算式</div>
                    <div class="comm-formula__eq">仲介手数料 ＝ 月額賃料 × 1ヶ月分 ＋ 消費税</div>
                </div>

                <div class="comm-examples reveal">
                    <h4 class="comm-examples__title">計算例（居住用・借主負担の場合）</h4>
                    <div class="comm-examples__grid">
                        <div class="comm-example-card comm-example-card--teal">
                            <div class="comm-example-card__price">月額賃料 5万円</div>
                            <div class="comm-example-card__calc">5万円 × 1ヶ月</div>
                            <div class="comm-example-card__total">税込 <strong>5万5千円</strong></div>
                        </div>
                        <div class="comm-example-card comm-example-card--teal">
                            <div class="comm-example-card__price">月額賃料 7万円</div>
                            <div class="comm-example-card__calc">7万円 × 1ヶ月</div>
                            <div class="comm-example-card__total">税込 <strong>7万7千円</strong></div>
                        </div>
                        <div class="comm-example-card comm-example-card--teal">
                            <div class="comm-example-card__price">月額賃料 10万円</div>
                            <div class="comm-example-card__calc">10万円 × 1ヶ月</div>
                            <div class="comm-example-card__total">税込 <strong>11万円</strong></div>
                        </div>
                        <div class="comm-example-card comm-example-card--teal">
                            <div class="comm-example-card__price">月額賃料 15万円</div>
                            <div class="comm-example-card__calc">15万円 × 1ヶ月</div>
                            <div class="comm-example-card__total">税込 <strong>16万5千円</strong></div>
                        </div>
                    </div>
                </div>

                <div class="comm-note reveal">
                    <div class="comm-note__icon">📌</div>
                    <div>
                        <strong>居住用建物の場合の注意点</strong><br>
                        居住用建物の賃貸借仲介において、貸主・借主合わせた報酬の合計は賃料の1ヶ月分が上限です。借主から1ヶ月分を受領する場合は、依頼を受ける前に借主の承諾を得ることが必要です。
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== 管理 ========== --}}
<section class="comm-section">
    <div class="container">
        <div class="section-header">
            <p class="section-label">管理業務</p>
            <h2 class="section-title">賃貸管理に関する手数料</h2>
            <p class="section-desc">物件の管理業務を委託いただいた場合の管理手数料です</p>
        </div>

        <div class="comm-card reveal">
            <div class="comm-card__header comm-card__header--green">
                <div class="comm-card__header-icon">🛡</div>
                <div>
                    <h3 class="comm-card__header-title">賃貸管理手数料</h3>
                    <p class="comm-card__header-sub">毎月の家賃収入に対してかかる管理費用</p>
                </div>
            </div>
            <div class="comm-card__body">
                <table class="comm-table">
                    <thead>
                        <tr>
                            <th>管理内容</th>
                            <th>手数料</th>
                            <th>備考</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>賃貸管理委託（標準プラン）</td>
                            <td class="comm-table__rate">月額賃料の <strong>5%</strong> + 消費税</td>
                            <td>集金・送金・クレーム対応・契約更新等</td>
                        </tr>
                        <tr>
                            <td>賃貸管理委託（フルサポートプラン）</td>
                            <td class="comm-table__rate">月額賃料の <strong>8〜10%</strong> + 消費税</td>
                            <td>標準プランに加え、建物点検・修繕手配等</td>
                        </tr>
                        <tr>
                            <td>退去立会い・原状回復確認</td>
                            <td class="comm-table__rate">賃料の <strong>0.5〜1ヶ月分</strong> + 消費税</td>
                            <td>退去時の立会い・原状回復の確認・精算業務</td>
                        </tr>
                    </tbody>
                </table>

                <div class="comm-note reveal">
                    <div class="comm-note__icon">💡</div>
                    <div>
                        管理手数料は物件の規模・状況・委託内容により異なる場合があります。
                        詳細はご相談の上、お見積りいたします。お気軽にお問い合わせください。
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== 注意事項 ========== --}}
<section class="comm-section comm-section--alt">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Notes</p>
            <h2 class="section-title">注意事項・共通事項</h2>
        </div>
        <div class="comm-notes-grid">
            <div class="comm-notes-card reveal">
                <div class="comm-notes-card__icon">✅</div>
                <h4 class="comm-notes-card__title">成約時のみ発生</h4>
                <p class="comm-notes-card__text">
                    仲介手数料は売買・賃貸の成約が成立した場合にのみ発生します。
                    ご相談・物件案内・査定等は無料です。
                </p>
            </div>
            <div class="comm-notes-card reveal">
                <div class="comm-notes-card__icon">📋</div>
                <h4 class="comm-notes-card__title">消費税について</h4>
                <p class="comm-notes-card__text">
                    上記の手数料には別途消費税（10%）が加算されます。
                    表示価格は税抜金額です。税込金額はお見積りにてご確認ください。
                </p>
            </div>
            <div class="comm-notes-card reveal">
                <div class="comm-notes-card__icon">🏛</div>
                <h4 class="comm-notes-card__title">法令に基づく上限額</h4>
                <p class="comm-notes-card__text">
                    記載の金額は宅地建物取引業法に基づく<strong>上限額</strong>です。
                    物件・状況によって上限額以下でご対応できる場合もございます。
                </p>
            </div>
            <div class="comm-notes-card reveal">
                <div class="comm-notes-card__icon">💬</div>
                <h4 class="comm-notes-card__title">その他費用について</h4>
                <p class="comm-notes-card__text">
                    仲介手数料以外に、登記費用・印紙税・火災保険料等が別途必要となります。
                    各フローページにて詳細をご確認いただけます。
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ========== CTA ========== --}}
<section class="comm-cta">
    <div class="container">
        <div class="comm-cta__box">
            <p class="section-label" style="color:#fde68a;">Contact Us</p>
            <h2 class="comm-cta__title">料金についてのご質問はお気軽に</h2>
            <p class="comm-cta__desc">
                報酬額・手数料に関するご不明点や、お見積りのご依頼は<br>
                いつでも無料でご相談いただけます。
            </p>
            <div class="comm-cta__buttons">
                <a href="{{ url('/') }}#contact" class="btn btn--primary btn--lg">無料相談はこちら</a>
                <a href="{{ url('/company') }}" class="btn btn--outline-white btn--lg">会社情報を見る</a>
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
            <a href="{{ url('/commission') }}" class="footer__link">報酬額</a>
            <a href="{{ url('/') }}#contact" class="footer__link">お問い合わせ</a>
        </div>
        <p class="footer__copy">&copy; {{ date('Y') }} ワンステップテックス不動産. All rights reserved.</p>
    </div>
</footer>

{{-- ========== PAGE CSS ========== --}}
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
.comm-hero {
    position: relative;
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
    padding: 140px 0 60px;
    overflow: hidden;
    text-align: center;
}
.comm-hero__bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 20% 50%, rgba(253,230,138,.1) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(255,255,255,.05) 0%, transparent 50%);
}
.comm-hero__inner { position: relative; z-index: 1; }
.comm-hero__title {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 700;
    color: var(--white);
    margin-bottom: 20px;
    line-height: 1.2;
}
.comm-hero__desc {
    font-size: 1.05rem;
    color: rgba(255,255,255,.85);
    line-height: 1.8;
}
.comm-hero__wave { position: relative; margin-bottom: -2px; line-height: 0; }
.comm-hero__wave svg { width: 100%; height: 80px; display: block; }

/* ---- 法的根拠バナー ---- */
.comm-legal { padding: 48px 0 0; background: var(--bg-light); }
.legal-banner {
    display: flex;
    gap: 24px;
    align-items: flex-start;
    background: var(--white);
    border: 1.5px solid #c7d2fe;
    border-radius: var(--radius-lg);
    padding: 28px 32px;
    box-shadow: var(--shadow-sm);
}
.legal-banner__icon { font-size: 2rem; flex-shrink: 0; margin-top: 2px; }
.legal-banner__title { font-size: 1.05rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
.legal-banner__text { font-size: .9rem; color: var(--text); line-height: 1.8; }

/* ---- セクション ---- */
.comm-section { padding: 72px 0; background: var(--bg-light); }
.comm-section--alt { background: var(--white); }

/* ---- カード ---- */
.comm-card {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border);
}
.comm-card__header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 24px 32px;
    color: var(--white);
}
.comm-card__header--blue  { background: linear-gradient(135deg, #1a4cbd, #2f7cff); }
.comm-card__header--teal  { background: linear-gradient(135deg, #0d7377, #14a085); }
.comm-card__header--green { background: linear-gradient(135deg, #065f46, #059669); }
.comm-card__header-icon { font-size: 2rem; line-height: 1; }
.comm-card__header-title { font-size: 1.2rem; font-weight: 700; margin: 0; }
.comm-card__header-sub { font-size: .82rem; opacity: .85; margin: 4px 0 0; }
.comm-card__body { padding: 32px; background: var(--white); }

/* ---- テーブル ---- */
.comm-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 28px;
    font-size: .9rem;
}
.comm-table thead tr { background: var(--bg-light); }
.comm-table th {
    padding: 12px 16px;
    text-align: left;
    font-size: .82rem;
    font-weight: 700;
    color: var(--text-light);
    border-bottom: 2px solid var(--border);
}
.comm-table td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    color: var(--text);
    line-height: 1.6;
}
.comm-table__rate { font-size: .95rem; }
.comm-table__highlight { background: #eff6ff; }
.comm-table__highlight td { font-weight: 600; }

/* ---- 速算式 ---- */
.comm-formula {
    background: linear-gradient(135deg, #eff6ff, #dbeafe);
    border: 1.5px solid #bfdbfe;
    border-radius: var(--radius-md);
    padding: 20px 24px;
    margin-bottom: 28px;
    text-align: center;
}
.comm-formula__label { font-size: .78rem; font-weight: 700; color: #1e40af; letter-spacing: .08em; margin-bottom: 8px; }
.comm-formula__eq { font-size: 1.1rem; font-weight: 700; color: var(--dark); }

/* ---- 計算例 ---- */
.comm-examples { margin-bottom: 28px; }
.comm-examples__title { font-size: .88rem; font-weight: 700; color: var(--dark); margin-bottom: 16px; }
.comm-examples__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
.comm-example-card {
    background: var(--bg-light);
    border-radius: var(--radius-md);
    padding: 16px;
    text-align: center;
    border: 1px solid var(--border);
}
.comm-example-card--teal { background: #f0fdfa; border-color: #99f6e4; }
.comm-example-card__price { font-size: .78rem; font-weight: 700; color: var(--text-light); margin-bottom: 6px; }
.comm-example-card__calc { font-size: .75rem; color: var(--text-light); margin-bottom: 8px; }
.comm-example-card__total { font-size: .9rem; color: var(--dark); }
.comm-example-card__total strong { color: var(--blue); font-size: 1rem; }
.comm-example-card--teal .comm-example-card__total strong { color: #0d7377; }

/* ---- 注意事項 ---- */
.comm-note {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    background: #fffbeb;
    border: 1.5px solid #fde68a;
    border-radius: var(--radius-md);
    padding: 16px 20px;
    font-size: .875rem;
    color: var(--text);
    line-height: 1.7;
}
.comm-note__icon { font-size: 1.2rem; flex-shrink: 0; margin-top: 1px; }

/* ---- 注意事項グリッド ---- */
.comm-notes-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
.comm-notes-card {
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 28px 24px;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
}
.comm-notes-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.comm-notes-card__icon { font-size: 2rem; margin-bottom: 12px; }
.comm-notes-card__title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; }
.comm-notes-card__text { font-size: .875rem; color: var(--text); line-height: 1.75; }

/* ---- CTA ---- */
.comm-cta {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 60%, #4338ca 100%);
    padding: 80px 0;
}
.comm-cta__box { text-align: center; }
.comm-cta__title { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; color: var(--white); margin-bottom: 16px; }
.comm-cta__desc { font-size: 1rem; color: rgba(255,255,255,.85); line-height: 1.8; margin-bottom: 36px; }
.comm-cta__buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
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
    .comm-examples__grid { grid-template-columns: repeat(2, 1fr); }
    .comm-notes-grid { grid-template-columns: 1fr; }
    .comm-table { font-size: .82rem; }
    .comm-table th, .comm-table td { padding: 10px 12px; }
}
@media (max-width: 600px) {
    .comm-hero { padding: 120px 0 40px; }
    .comm-card__body { padding: 20px; }
    .comm-card__header { padding: 18px 20px; gap: 12px; }
    .comm-examples__grid { grid-template-columns: repeat(2, 1fr); }
    .legal-banner { flex-direction: column; gap: 12px; padding: 20px; }
    .comm-table { display: block; overflow-x: auto; }
    .navbar__menu { display: none; flex-direction: column; position: absolute; top: 72px; left: 0; right: 0; background: var(--dark); padding: 16px; gap: 4px; }
    .navbar__menu.open { display: flex; }
    .navbar__toggle { display: flex; }
    .navbar__dropdown-menu { position: static; transform: none; box-shadow: none; background: rgba(255,255,255,.1); border-radius: 8px; min-width: unset; }
    .navbar__dropdown-link { color: rgba(255,255,255,.85) !important; }
}
</style>

{{-- ========== PAGE JS ========== --}}
<script>
// Scroll reveal
const revealEls = document.querySelectorAll('.reveal');
const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); } });
}, { threshold: 0.12 });
revealEls.forEach(el => revealObs.observe(el));

</script>

@endsection
