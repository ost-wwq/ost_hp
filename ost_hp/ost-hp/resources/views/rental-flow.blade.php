@extends('layouts.app')

@section('title', '不動産貸出フロー｜ワンステップテックス不動産')

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
            <li class="navbar__dropdown is-open" id="navDropdownFlow">
                <a href="#" class="navbar__link navbar__dropdown-toggle navbar__link--active" id="navDropdownFlowToggle">
                    フロー
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ url('/flow') }}" class="navbar__dropdown-link">購入フロー</a></li>
                    <li><a href="{{ url('/selling-flow') }}" class="navbar__dropdown-link">売却フロー</a></li>
                    <li><a href="{{ url('/rental-flow') }}" class="navbar__dropdown-link navbar__dropdown-link--active">貸出フロー</a></li>
                    <li><a href="{{ url('/renting-flow') }}" class="navbar__dropdown-link">賃借フロー</a></li>
                </ul>
            </li>
            <li class="navbar__dropdown" id="navDropdownOther">
                <a href="#" class="navbar__link navbar__dropdown-toggle" id="navDropdownOtherToggle">
                    その他
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ url('/company') }}" class="navbar__dropdown-link">会社情報</a></li>
                    <li><a href="{{ url('/') }}#faq" class="navbar__dropdown-link">よくある質問</a></li>
                    <li><a href="{{ url('/commission') }}" class="navbar__dropdown-link">報酬額</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/') }}#contact" class="navbar__link navbar__link--cta">お問い合わせ</a></li>
        </ul>
    </div>
</nav>

{{-- ========== HERO ========== --}}
<section class="flow-hero flow-hero--rental">
    <div class="flow-hero__bg"></div>
    <div class="container flow-hero__inner">
        <p class="section-label" style="color:#6ee7b7;">Rental Flow</p>
        <h1 class="flow-hero__title">不動産貸出フロー</h1>
        <p class="flow-hero__desc">
            はじめて不動産を貸し出す方も安心。<br>
            賃料査定から入居者の入居開始まで、7つのステップをわかりやすくご説明します。
        </p>
        <div class="flow-hero__steps-count">
            <span class="flow-hero__steps-num">7</span>
            <span class="flow-hero__steps-label">STEPS</span>
        </div>
    </div>
    <div class="flow-hero__wave">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80V40C240 0 480 60 720 40S1200 0 1440 40V80H0Z" fill="#f8f9ff"/>
        </svg>
    </div>
</section>

{{-- ========== OVERVIEW TIMELINE ========== --}}
<section class="flow-overview">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Overview</p>
            <h2 class="section-title">貸出までの全体の流れ</h2>
            <p class="section-desc">一般的に賃料査定から入居者が決まるまで1〜3ヶ月程度かかります</p>
        </div>

        <div class="flow-timeline flow-timeline--rental">
            @php
            $steps = [
                ['num'=>'01','icon'=>'💬','label'=>'ご相談・賃料査定','color'=>'rental-a','duration'=>'随時'],
                ['num'=>'02','icon'=>'📃','label'=>'管理委託契約の締結','color'=>'rental-a','duration'=>'1〜3日'],
                ['num'=>'03','icon'=>'📣','label'=>'入居者募集活動','color'=>'rental-b','duration'=>'1〜3ヶ月'],
                ['num'=>'04','icon'=>'📝','label'=>'入居申込・審査','color'=>'rental-b','duration'=>'3〜7日'],
                ['num'=>'05','icon'=>'📋','label'=>'重要事項説明・賃貸借契約','color'=>'rental-b','duration'=>'1日'],
                ['num'=>'06','icon'=>'🔑','label'=>'鍵の引渡し・入居開始','color'=>'rental-c','duration'=>'当日'],
                ['num'=>'07','icon'=>'🛡','label'=>'入居中の管理サポート','color'=>'rental-c','duration'=>'継続'],
            ];
            @endphp

            @foreach($steps as $i => $s)
            <div class="flow-timeline__item reveal">
                <div class="flow-timeline__dot flow-timeline__dot--{{ $s['color'] }}">
                    <span>{{ $s['icon'] }}</span>
                </div>
                <div class="flow-timeline__content">
                    <span class="flow-timeline__num">STEP {{ $s['num'] }}</span>
                    <div class="flow-timeline__label">{{ $s['label'] }}</div>
                    <span class="flow-timeline__dur">目安: {{ $s['duration'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== STEP DETAILS ========== --}}
<section class="flow-steps">
    <div class="container">

        {{-- STEP 01 --}}
        <div class="step-card reveal" id="step01">
            <div class="step-card__header step-card__header--rental-a">
                <div class="step-card__num">STEP 01</div>
                <div class="step-card__icon">💬</div>
                <h3 class="step-card__title">ご相談・賃料査定</h3>
                <p class="step-card__subtitle">まずはお気軽にご連絡ください</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            所有物件の賃貸活用をご検討中の方は、まず当社へお問い合わせください。
                            「いくらで貸せるか知りたい」「空室が続いている」など、
                            どんな段階のご相談でも無料で対応いたします。
                        </p>
                        <h4 class="step-card__check-title">この段階でお伺いすること</h4>
                        <ul class="step-card__checklist">
                            <li>物件の概要（所在地・築年・間取り・面積など）</li>
                            <li>賃貸に出す理由・背景（転勤・住み替えなど）</li>
                            <li>希望賃料のイメージ</li>
                            <li>管理をどこまで委託したいか</li>
                            <li>入居希望時期（いつから入居者を入れたいか）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--rental-a">
                            <div class="step-tip__icon">💡</div>
                            <div class="step-tip__title">担当者からのアドバイス</div>
                            <p class="step-tip__text">
                                周辺の相場賃料を把握することが第一歩です。
                                査定は無料・無義務ですので、まずはお気軽にご依頼ください。
                                相場を知るだけでも今後の計画が立てやすくなります。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">30分〜1時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--green">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 02 --}}
        <div class="step-card reveal" id="step02">
            <div class="step-card__header step-card__header--rental-a">
                <div class="step-card__num">STEP 02</div>
                <div class="step-card__icon">📃</div>
                <h3 class="step-card__title">管理委託契約の締結</h3>
                <p class="step-card__subtitle">当社との正式な契約を結びます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            当社に賃貸管理・入居者募集を依頼することが決まったら、
                            「管理委託契約」を締結します。
                            管理の範囲や手数料について確認した上で、
                            オーナー様のご希望に合ったプランをご提案します。
                        </p>
                        <h4 class="step-card__check-title">管理委託の主な内容</h4>
                        <ul class="step-card__checklist">
                            <li>入居者の募集・審査・契約手続き</li>
                            <li>家賃の集金・送金管理</li>
                            <li>入居中のトラブル・クレーム対応</li>
                            <li>退去時の立会い・原状回復の確認</li>
                            <li>建物の定期巡回・点検</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--rental-a">
                            <div class="step-tip__icon">📌</div>
                            <div class="step-tip__title">管理手数料の目安</div>
                            <p class="step-tip__text">
                                一般的に管理手数料は月額賃料の5〜10%程度です。
                                管理の範囲・サービス内容によって異なりますので、
                                詳細はご相談ください。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">契約締結</span>
                                <span class="step-meta__val">1〜3日</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">管理手数料</span>
                                <span class="step-meta__val">賃料の5〜10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 03 --}}
        <div class="step-card reveal" id="step03">
            <div class="step-card__header step-card__header--rental-b">
                <div class="step-card__num">STEP 03</div>
                <div class="step-card__icon">📣</div>
                <h3 class="step-card__title">入居者募集活動</h3>
                <p class="step-card__subtitle">入居希望者との出会いに向けて動きます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            各種不動産ポータルサイト（SUUMO・HOME'S・アットホームなど）への掲載や、
                            業者間ネットワーク（レインズ）への登録など、
                            積極的に入居者募集活動を展開します。
                            内覧対応もサポートいたします。
                        </p>
                        <h4 class="step-card__check-title">空室期間を短縮するポイント</h4>
                        <ul class="step-card__checklist">
                            <li>室内を清潔・整理整頓した状態に保つ</li>
                            <li>適切な賃料設定（高すぎると空室長期化のリスク）</li>
                            <li>ハウスクリーニングやリフォームで物件の魅力を高める</li>
                            <li>写真・動画を活用した魅力的な物件紹介</li>
                            <li>礼金・フリーレントなどの条件緩和も検討</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--rental-b">
                            <div class="step-tip__icon">⚠️</div>
                            <div class="step-tip__title">賃料見直しのタイミング</div>
                            <p class="step-tip__text">
                                2ヶ月程度募集しても反響が少ない場合は、
                                賃料や募集条件の見直しを検討しましょう。
                                担当者と定期的に状況を確認することが大切です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">募集活動期間</span>
                                <span class="step-meta__val">1〜3ヶ月（目安）</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--green">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 04 --}}
        <div class="step-card reveal" id="step04">
            <div class="step-card__header step-card__header--rental-b">
                <div class="step-card__num">STEP 04</div>
                <div class="step-card__icon">📝</div>
                <h3 class="step-card__title">入居申込・入居審査</h3>
                <p class="step-card__subtitle">入居希望者の審査を行います</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            入居希望者から申込みが入ったら、入居審査を実施します。
                            申込者の収入状況・勤務先・保証人・信用情報などを総合的に確認し、
                            オーナー様にご報告の上、承認・不承認を決定します。
                        </p>
                        <h4 class="step-card__check-title">入居審査で確認する主なポイント</h4>
                        <ul class="step-card__checklist">
                            <li>収入状況（月額賃料の3倍以上が目安）</li>
                            <li>勤務先・雇用形態・勤続年数</li>
                            <li>連帯保証人または家賃保証会社の利用</li>
                            <li>過去の家賃滞納・トラブル歴（信用情報）</li>
                            <li>入居人数・入居目的の確認</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--rental-b">
                            <div class="step-tip__icon">💡</div>
                            <div class="step-tip__title">家賃保証会社について</div>
                            <p class="step-tip__text">
                                連帯保証人の代わりに家賃保証会社を利用することで、
                                家賃滞納リスクを軽減できます。
                                当社では保証会社のご紹介も行っております。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">審査期間</span>
                                <span class="step-meta__val">3〜7日</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--green">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 05 --}}
        <div class="step-card reveal" id="step05">
            <div class="step-card__header step-card__header--rental-b">
                <div class="step-card__num">STEP 05</div>
                <div class="step-card__icon">📋</div>
                <h3 class="step-card__title">重要事項説明・賃貸借契約の締結</h3>
                <p class="step-card__subtitle">法律上の重要な手続きです</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            審査通過後、宅地建物取引士が入居者へ重要事項説明を行い、
                            賃貸借契約書に署名・押印いただきます。
                            入居者から敷金・礼金・前家賃などの初期費用をお預かりします。
                        </p>
                        <h4 class="step-card__check-title">契約時に確認すること</h4>
                        <ul class="step-card__checklist">
                            <li>賃料・管理費・敷金・礼金の最終確認</li>
                            <li>契約期間（一般借家 or 定期借家）</li>
                            <li>禁止事項（ペット飼育・楽器演奏・転貸など）</li>
                            <li>原状回復義務の範囲（ガイドラインに基づく）</li>
                            <li>更新料・解約予告期間の確認</li>
                            <li>設備の引渡し状況の確認（設備表）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--rental-b">
                            <div class="step-tip__icon">📌</div>
                            <div class="step-tip__title">定期借家契約について</div>
                            <p class="step-tip__text">
                                将来的に自己使用を予定している場合は、
                                期間満了で確実に退去してもらえる「定期借家契約」が有効です。
                                通常の普通借家契約との違いをご確認ください。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">1〜2時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">初期費用受領</span>
                                <span class="step-meta__val">敷金・礼金・前家賃</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 06 --}}
        <div class="step-card reveal" id="step06">
            <div class="step-card__header step-card__header--rental-c">
                <div class="step-card__num">STEP 06</div>
                <div class="step-card__icon">🔑</div>
                <h3 class="step-card__title">鍵の引渡し・入居開始</h3>
                <p class="step-card__subtitle">いよいよ入居者が入居します</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            契約完了後、入居開始日に鍵を入居者へ引き渡します。
                            入居前に室内の状態（傷・汚れ・設備の動作など）を
                            入居者と一緒に確認し、入居チェックリストへ記録します。
                            これにより退去時のトラブルを防ぎます。
                        </p>
                        <h4 class="step-card__check-title">鍵引渡し前に確認すること</h4>
                        <ul class="step-card__checklist">
                            <li>ハウスクリーニングの完了確認</li>
                            <li>設備（エアコン・給湯器・水回りなど）の動作確認</li>
                            <li>鍵の種類・本数の確認（スペアキーも含む）</li>
                            <li>メーターの確認（電気・ガス・水道）</li>
                            <li>入居チェックリストへの双方サイン</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--rental-c">
                            <div class="step-tip__icon">💡</div>
                            <div class="step-tip__title">鍵交換について</div>
                            <p class="step-tip__text">
                                防犯・安心のため、入居前に鍵の交換をお勧めします。
                                費用は一般的に入居者負担となることが多いですが、
                                事前に契約書で明記しておきましょう。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">30分〜1時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">家賃収入開始</span>
                                <span class="step-meta__val">入居開始月〜</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 07 --}}
        <div class="step-card step-card--final reveal" id="step07">
            <div class="step-card__header step-card__header--rental-c">
                <div class="step-card__num">STEP 07</div>
                <div class="step-card__icon">🛡</div>
                <h3 class="step-card__title">入居中の管理サポート</h3>
                <p class="step-card__subtitle">オーナー様の大切な資産をお守りします</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            入居開始後も、当社がオーナー様に代わって各種管理業務をサポートします。
                            家賃の集金・送金から入居中のトラブル対応まで、
                            オーナー様が安心して資産運用いただけるよう全力でサポートいたします。
                        </p>
                        <h4 class="step-card__check-title">入居中の主な管理業務</h4>
                        <ul class="step-card__checklist">
                            <li>家賃の集金・送金（毎月定期報告）</li>
                            <li>入居者からのクレーム・トラブル対応（設備故障など）</li>
                            <li>契約更新手続きと更新料の受領</li>
                            <li>退去通知の受理・退去立会い・原状回復確認</li>
                            <li>次の入居者募集への切り替え</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--rental-c">
                            <div class="step-tip__icon">🎉</div>
                            <div class="step-tip__title">安定した賃貸経営のために</div>
                            <p class="step-tip__text">
                                良好な入居者との長期的な賃貸関係を維持することが、
                                安定した家賃収入の最大のポイントです。
                                何かお困りのことがあればいつでもご連絡ください。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">報告頻度</span>
                                <span class="step-meta__val">月次報告</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">管理手数料</span>
                                <span class="step-meta__val">賃料の5〜10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ========== COST GUIDE ========== --}}
<section class="flow-cost">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Cost Guide</p>
            <h2 class="section-title">貸出時にかかる主な費用</h2>
            <p class="section-desc">賃貸活用を始める際に発生する費用の目安です</p>
        </div>
        <div class="cost-grid">
            <div class="cost-card reveal">
                <div class="cost-card__icon">📄</div>
                <h4 class="cost-card__title">仲介手数料</h4>
                <p class="cost-card__formula rental-formula">月額賃料の0.5〜1ヶ月分＋消費税</p>
                <p class="cost-card__note">入居者成約時のみ発生（法律上の上限あり）</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🛠</div>
                <h4 class="cost-card__title">ハウスクリーニング費用</h4>
                <p class="cost-card__formula rental-formula">約3〜10万円</p>
                <p class="cost-card__note">入居前に実施することで入居率アップ</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🔧</div>
                <h4 class="cost-card__title">設備修繕費用</h4>
                <p class="cost-card__formula rental-formula">内容により変動</p>
                <p class="cost-card__note">エアコン・給湯器など設備の修繕費はオーナー負担が原則</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🏛</div>
                <h4 class="cost-card__title">管理委託手数料</h4>
                <p class="cost-card__formula rental-formula">月額賃料の5〜10%</p>
                <p class="cost-card__note">毎月の家賃収入から差し引き</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">📊</div>
                <h4 class="cost-card__title">不動産所得税</h4>
                <p class="cost-card__formula rental-formula">家賃収入に応じて変動</p>
                <p class="cost-card__note">年間の家賃収入から必要経費を差し引いた額に課税</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🏠</div>
                <h4 class="cost-card__title">火災保険（オーナー側）</h4>
                <p class="cost-card__formula rental-formula">年間 約1〜5万円</p>
                <p class="cost-card__note">建物の火災保険はオーナー負担。継続更新が必要</p>
            </div>
        </div>
    </div>
</section>

{{-- ========== FAQ ========== --}}
<section class="flow-faq">
    <div class="container">
        <div class="section-header">
            <p class="section-label">FAQ</p>
            <h2 class="section-title">よくあるご質問</h2>
        </div>
        <div class="faq-list">
            @php
            $faqs = [
                ['q'=>'賃料はどのように決まりますか？','a'=>'周辺の類似物件の賃料相場・物件の築年数・設備・立地などを総合的に分析して査定します。空室期間を短くするためにも、相場に合った適切な賃料設定が重要です。まずは無料の賃料査定をご依頼ください。'],
                ['q'=>'入居者が家賃を払ってくれない場合はどうなりますか？','a'=>'家賃保証会社をご利用いただくことで、万が一の家賃滞納時にも保証会社が代わりに支払います。当社では保証会社のご紹介もしております。また、当社が入居者への督促も代行いたします。'],
                ['q'=>'入居者が部屋を壊した場合はどうなりますか？','a'=>'入居者の過失による損傷は、退去時に原状回復費用として敷金から差し引くことができます。入居前のチェックリスト作成と、適切な敷金の設定が重要です。当社が退去立会いをサポートします。'],
                ['q'=>'転勤中の自宅を賃貸に出せますか？','a'=>'はい、可能です。ただし住宅ローンが残っている場合は金融機関への届出が必要な場合があります。また転勤終了後に確実に戻りたい場合は「定期借家契約」のご利用をお勧めします。'],
                ['q'=>'いつでも解約できますか？','a'=>'管理委託契約はオーナー様の都合でご解約いただけますが、通常は3〜6ヶ月前の予告が必要です。また入居者との賃貸借契約は入居者保護の観点から、オーナー都合での即時解約は原則できません。'],
                ['q'=>'賃貸に出すにはどんなリフォームが必要ですか？','a'=>'必ずしもリフォームが必要というわけではありませんが、クロスの張替えやフローリング補修・クリーニングなどで物件の魅力が高まり、空室期間の短縮につながります。費用対効果を考慮してご提案します。'],
            ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div class="faq-item reveal">
                <button class="faq-item__q" aria-expanded="false">
                    <span class="faq-item__q-icon faq-item__q-icon--green">Q</span>
                    <span>{{ $faq['q'] }}</span>
                    <svg class="faq-item__arrow" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="faq-item__a">
                    <span class="faq-item__a-icon">A</span>
                    <p>{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== CTA ========== --}}
<section class="flow-cta flow-cta--rental">
    <div class="container">
        <div class="flow-cta__box">
            <p class="section-label" style="color:#6ee7b7;">Contact Us</p>
            <h2 class="flow-cta__title">まずは無料の賃料査定をご依頼ください</h2>
            <p class="flow-cta__desc">
                貸出のご相談・賃料査定はいつでも無料です。<br>
                専任スタッフが丁寧にご対応し、最適な賃貸プランをご提案します。
            </p>
            <div class="flow-cta__buttons">
                <a href="{{ url('/') }}#contact" class="btn btn--primary btn--lg">無料査定を依頼する</a>
                <a href="{{ url('/renting-flow') }}" class="btn btn--outline-white btn--lg">賃借フローを見る</a>
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
            <a href="{{ url('/rental-flow') }}" class="footer__link">貸出フロー</a>
            <a href="{{ url('/renting-flow') }}" class="footer__link">賃借フロー</a>
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
.flow-hero {
    position: relative;
    background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #059669 100%);
    padding: 140px 0 60px;
    overflow: hidden;
    text-align: center;
}
.flow-hero--rental {
    background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #059669 100%);
}
.flow-hero__bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 20% 50%, rgba(110,231,183,.15) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(255,255,255,.06) 0%, transparent 50%);
}
.flow-hero__inner { position: relative; z-index: 1; }
.flow-hero__title {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 700;
    color: var(--white);
    margin-bottom: 20px;
    line-height: 1.2;
}
.flow-hero__desc {
    font-size: 1.05rem;
    color: rgba(255,255,255,.85);
    line-height: 1.8;
    margin-bottom: 36px;
}
.flow-hero__steps-count {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 16px;
    padding: 16px 32px;
    backdrop-filter: blur(8px);
}
.flow-hero__steps-num { font-size: 3rem; font-weight: 700; color: var(--white); line-height: 1; }
.flow-hero__steps-label { font-size: .75rem; font-weight: 700; color: rgba(255,255,255,.7); letter-spacing: .15em; }
.flow-hero__wave { position: relative; margin-bottom: -2px; line-height: 0; }
.flow-hero__wave svg { width: 100%; height: 80px; display: block; }

/* ---- OVERVIEW TIMELINE ---- */
.flow-overview { background: var(--bg-light); padding: 80px 0; }
.flow-timeline--rental {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
}
.flow-timeline__item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1;
    padding: 0 8px;
}
.flow-timeline--rental .flow-timeline__item:not(:nth-child(4n))::after {
    content: '';
    position: absolute;
    top: 35px;
    left: 50%;
    right: -50%;
    height: 3px;
    z-index: 0;
}
.flow-timeline--rental .flow-timeline__item:nth-child(1)::after,
.flow-timeline--rental .flow-timeline__item:nth-child(2)::after { background: #059669; opacity: .7; }
.flow-timeline--rental .flow-timeline__item:nth-child(3)::after { background: linear-gradient(90deg, #059669, #065f46); opacity: .7; }
.flow-timeline--rental .flow-timeline__item:nth-child(5)::after,
.flow-timeline--rental .flow-timeline__item:nth-child(6)::after { background: #065f46; opacity: .7; }

.flow-timeline__dot {
    width: 72px; height: 72px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.8rem;
    margin-bottom: 16px;
    border: 4px solid var(--white);
    box-shadow: var(--shadow-md);
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}
.flow-timeline__dot--rental-a { background: #059669; }
.flow-timeline__dot--rental-b { background: #065f46; }
.flow-timeline__dot--rental-c { background: #064e3b; }
.flow-timeline__num { font-size: .7rem; font-weight: 700; letter-spacing: .08em; color: #059669; margin-bottom: 4px; display: block; }
.flow-timeline__label { font-size: .88rem; font-weight: 700; color: var(--dark); line-height: 1.35; margin-bottom: 6px; }
.flow-timeline__dur { font-size: .72rem; color: var(--text-light); }

/* ---- STEP CARDS ---- */
.flow-steps { padding: 80px 0; background: var(--white); }
.step-card {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    margin-bottom: 40px;
    border: 1px solid var(--border);
    transition: transform var(--transition), box-shadow var(--transition);
}
.step-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
.step-card--final { border: 2px solid #064e3b; }
.step-card__header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 24px 32px;
    color: var(--white);
}
.step-card__header--rental-a { background: linear-gradient(135deg, #065f46, #059669); }
.step-card__header--rental-b { background: linear-gradient(135deg, #064e3b, #065f46); }
.step-card__header--rental-c { background: linear-gradient(135deg, #022c22, #064e3b); }
.step-card__num { font-size: .72rem; font-weight: 700; letter-spacing: .12em; opacity: .85; min-width: 60px; }
.step-card__icon { font-size: 2rem; line-height: 1; }
.step-card__title { font-size: 1.3rem; font-weight: 700; margin: 0; }
.step-card__subtitle { font-size: .82rem; opacity: .85; margin: 4px 0 0; margin-left: auto; white-space: nowrap; }
.step-card__body { padding: 32px; }
.step-card__cols { display: grid; grid-template-columns: 1fr 320px; gap: 32px; }
.step-card__text { font-size: .95rem; color: var(--text); line-height: 1.8; margin-bottom: 20px; }
.step-card__check-title { font-size: .88rem; font-weight: 700; color: var(--dark); margin-bottom: 12px; }
.step-card__checklist { display: flex; flex-direction: column; gap: 8px; }
.step-card__checklist li {
    font-size: .875rem; color: var(--text);
    padding: 8px 12px 8px 32px;
    background: var(--bg-light);
    border-radius: var(--radius-sm);
    position: relative;
}
.step-card__checklist li::before {
    content: '✓';
    position: absolute; left: 10px; top: 8px;
    color: #059669; font-weight: 700; font-size: .85rem;
}

/* ---- STEP TIP ---- */
.step-tip { border-radius: var(--radius-md); padding: 20px; margin-bottom: 20px; }
.step-tip--rental-a { background: #ecfdf5; }
.step-tip--rental-b { background: #d1fae5; }
.step-tip--rental-c { background: #ecfdf5; }
.step-tip__icon { font-size: 1.4rem; margin-bottom: 8px; }
.step-tip__title { font-size: .85rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
.step-tip__text { font-size: .82rem; color: var(--text); line-height: 1.7; }

/* ---- STEP META ---- */
.step-meta { display: flex; flex-direction: column; gap: 8px; }
.step-meta__item {
    display: flex; justify-content: space-between; align-items: center;
    padding: 10px 14px;
    background: var(--bg-light);
    border-radius: var(--radius-sm);
    font-size: .82rem;
}
.step-meta__label { color: var(--text-light); font-weight: 500; }
.step-meta__val { font-weight: 700; color: var(--dark); }
.step-meta__val--green { color: #059669; }

/* ---- COST GUIDE ---- */
.flow-cost { background: var(--bg-light); padding: 80px 0; }
.cost-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.cost-card {
    background: var(--white);
    border-radius: var(--radius-md);
    padding: 28px 24px;
    text-align: center;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
    transition: transform var(--transition), box-shadow var(--transition);
}
.cost-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.cost-card__icon { font-size: 2rem; margin-bottom: 12px; }
.cost-card__title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; }
.cost-card__formula { font-size: .9rem; font-weight: 700; margin-bottom: 6px; }
.rental-formula { color: #059669; }
.cost-card__note { font-size: .78rem; color: var(--text-light); }

/* ---- FAQ ---- */
.flow-faq { background: var(--white); padding: 80px 0; }
.faq-list { max-width: 760px; margin: 0 auto; display: flex; flex-direction: column; gap: 12px; }
.faq-item {
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    transition: border-color var(--transition);
}
.faq-item.is-open { border-color: #059669; }
.faq-item__q {
    width: 100%;
    display: flex; align-items: center; gap: 14px;
    padding: 18px 20px;
    text-align: left;
    font-size: .95rem; font-weight: 700; color: var(--dark);
    background: var(--white);
    transition: background var(--transition);
}
.faq-item.is-open .faq-item__q { background: #ecfdf5; color: #059669; }
.faq-item__q-icon {
    flex-shrink: 0; width: 28px; height: 28px;
    background: var(--orange); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700;
}
.faq-item__q-icon--green { background: #059669; }
.faq-item.is-open .faq-item__q-icon--green { background: #065f46; }
.faq-item__arrow {
    width: 20px; height: 20px; margin-left: auto; flex-shrink: 0;
    color: var(--text-light);
    transition: transform var(--transition);
}
.faq-item.is-open .faq-item__arrow { transform: rotate(180deg); color: #059669; }
.faq-item__a {
    display: none;
    padding: 20px;
    font-size: .9rem; color: var(--text); line-height: 1.8;
    background: var(--bg-light);
    gap: 14px;
    align-items: flex-start;
}
.faq-item.is-open .faq-item__a { display: flex; }
.faq-item__a-icon {
    flex-shrink: 0; width: 28px; height: 28px;
    background: var(--blue); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700; margin-top: 2px;
}

/* ---- CTA ---- */
.flow-cta--rental { background: linear-gradient(135deg, #064e3b 0%, #065f46 60%, #059669 100%); padding: 80px 0; }
.flow-cta__box { text-align: center; }
.flow-cta__title { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; color: var(--white); margin-bottom: 16px; }
.flow-cta__desc { font-size: 1rem; color: rgba(255,255,255,.85); line-height: 1.8; margin-bottom: 36px; }
.flow-cta__buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
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
    .flow-timeline--rental { grid-template-columns: repeat(2, 1fr); gap: 24px; }
    .flow-timeline--rental .flow-timeline__item:not(:nth-child(4n))::after { display: none; }
    .flow-timeline--rental .flow-timeline__item:nth-child(odd):not(:last-child)::after { display: block; }
    .step-card__cols { grid-template-columns: 1fr; }
    .step-card__subtitle { display: none; }
    .cost-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .flow-hero { padding: 120px 0 40px; }
    .flow-timeline--rental { grid-template-columns: 1fr 1fr; }
    .cost-grid { grid-template-columns: 1fr; }
    .step-card__body { padding: 20px; }
    .step-card__header { padding: 18px 20px; gap: 12px; }
    .navbar__menu { display: none; flex-direction: column; position: absolute; top: 72px; left: 0; right: 0; background: var(--dark); padding: 16px; gap: 4px; }
    .navbar__menu.open { display: flex; }
    .navbar__toggle { display: flex; }
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

// FAQ accordion
document.querySelectorAll('.faq-item__q').forEach(btn => {
    btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('is-open');
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('is-open'));
        if (!isOpen) item.classList.add('is-open');
    });
});

// Mobile navbar
const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');
if (navToggle) navToggle.addEventListener('click', () => navMenu.classList.toggle('open'));

// Dropdowns (複数対応)
document.querySelectorAll('.navbar__dropdown').forEach(dd => {
    const toggle = dd.querySelector('.navbar__dropdown-toggle');
    if (toggle) {
        toggle.addEventListener('click', e => {
            e.preventDefault();
            const wasOpen = dd.classList.contains('is-open');
            document.querySelectorAll('.navbar__dropdown').forEach(d => d.classList.remove('is-open'));
            if (!wasOpen) dd.classList.add('is-open');
        });
    }
});
document.addEventListener('click', e => {
    if (!e.target.closest('.navbar__dropdown')) {
        document.querySelectorAll('.navbar__dropdown').forEach(d => d.classList.remove('is-open'));
    }
});
</script>

@endsection
