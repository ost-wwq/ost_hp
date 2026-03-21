@extends('layouts.app')

@section('title', '不動産賃借フロー｜ワンステップテックス不動産')

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
                    <li><a href="{{ url('/rental-flow') }}" class="navbar__dropdown-link">貸出フロー</a></li>
                    <li><a href="{{ url('/renting-flow') }}" class="navbar__dropdown-link navbar__dropdown-link--active">賃借フロー</a></li>
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
<section class="flow-hero flow-hero--renting">
    <div class="flow-hero__bg"></div>
    <div class="container flow-hero__inner">
        <p class="section-label" style="color:#c4b5fd;">Renting Flow</p>
        <h1 class="flow-hero__title">不動産賃借フロー</h1>
        <p class="flow-hero__desc">
            はじめて賃貸物件を借りる方も安心。<br>
            お部屋探しから入居開始まで、7つのステップをわかりやすくご説明します。
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
            <h2 class="section-title">入居までの全体の流れ</h2>
            <p class="section-desc">一般的にお部屋探しから入居まで1〜2ヶ月程度かかります</p>
        </div>

        <div class="flow-timeline flow-timeline--renting">
            @php
            $steps = [
                ['num'=>'01','icon'=>'💬','label'=>'ご相談・条件整理','color'=>'renting-a','duration'=>'随時'],
                ['num'=>'02','icon'=>'🔍','label'=>'物件探し・内覧','color'=>'renting-a','duration'=>'1〜4週間'],
                ['num'=>'03','icon'=>'📝','label'=>'入居申込','color'=>'renting-b','duration'=>'1〜3日'],
                ['num'=>'04','icon'=>'✅','label'=>'入居審査','color'=>'renting-b','duration'=>'3〜7日'],
                ['num'=>'05','icon'=>'📋','label'=>'重要事項説明・賃貸借契約','color'=>'renting-b','duration'=>'1日'],
                ['num'=>'06','icon'=>'💴','label'=>'初期費用のお支払い','color'=>'renting-c','duration'=>'契約日'],
                ['num'=>'07','icon'=>'🔑','label'=>'鍵の受取・入居開始','color'=>'renting-c','duration'=>'入居日'],
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
            <div class="step-card__header step-card__header--renting-a">
                <div class="step-card__num">STEP 01</div>
                <div class="step-card__icon">💬</div>
                <h3 class="step-card__title">ご相談・条件整理</h3>
                <p class="step-card__subtitle">まずはお気軽にご相談ください</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            賃貸物件を借りる際は、まずご自身の希望条件を整理することが大切です。
                            予算・エリア・間取りなどのご希望をお聞かせいただき、
                            最適なお部屋探しをサポートいたします。
                        </p>
                        <h4 class="step-card__check-title">この段階で整理すること</h4>
                        <ul class="step-card__checklist">
                            <li>予算（月額賃料の上限・初期費用の目安）</li>
                            <li>希望エリア・最寄り駅からの距離</li>
                            <li>希望間取り・広さ（1K・1LDK・2LDKなど）</li>
                            <li>入居希望時期（いつから住み始めたいか）</li>
                            <li>ペット・楽器・バイク置き場など特殊な条件</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--renting-a">
                            <div class="step-tip__icon">💡</div>
                            <div class="step-tip__title">担当者からのアドバイス</div>
                            <p class="step-tip__text">
                                「なんとなく探している」段階でも大丈夫です。
                                まずは相談だけでもOK。
                                希望条件を整理するお手伝いもいたします。相談は無料です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">30分〜1時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--purple">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 02 --}}
        <div class="step-card reveal" id="step02">
            <div class="step-card__header step-card__header--renting-a">
                <div class="step-card__num">STEP 02</div>
                <div class="step-card__icon">🔍</div>
                <h3 class="step-card__title">物件探し・内覧（現地見学）</h3>
                <p class="step-card__subtitle">理想のお部屋を一緒に探します</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            ご希望条件をもとに物件をご紹介します。
                            気になる物件は積極的に内覧（現地見学）に行きましょう。
                            写真だけではわからない周辺環境・日当たり・騒音なども
                            実際に確認することが大切です。
                        </p>
                        <h4 class="step-card__check-title">内覧時に確認するポイント</h4>
                        <ul class="step-card__checklist">
                            <li>周辺環境（スーパー・コンビニ・駅・病院へのアクセス）</li>
                            <li>日当たり・風通し・騒音・においの確認</li>
                            <li>収納スペースの広さ・使い勝手</li>
                            <li>水回り（キッチン・お風呂・トイレ）の状態</li>
                            <li>インターネット環境・共用部（宅配ボックスなど）</li>
                            <li>駐輪場・駐車場の有無と費用</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--renting-a">
                            <div class="step-tip__icon">💡</div>
                            <div class="step-tip__title">内覧のコツ</div>
                            <p class="step-tip__text">
                                複数の物件を見比べることで判断しやすくなります。
                                夜間や雨の日の様子も確認できると理想的です。
                                写真や動画を撮っておくと後で比較するのに役立ちます。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">目安期間</span>
                                <span class="step-meta__val">1〜4週間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--purple">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 03 --}}
        <div class="step-card reveal" id="step03">
            <div class="step-card__header step-card__header--renting-b">
                <div class="step-card__num">STEP 03</div>
                <div class="step-card__icon">📝</div>
                <h3 class="step-card__title">入居申込</h3>
                <p class="step-card__subtitle">借りたい意思をオーナー側に伝えます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            借りたい物件が決まったら「入居申込書」を提出します。
                            この時点ではまだ法的な拘束力はありませんが、
                            他の申込者より優先的に審査が進みます。
                            人気物件はすぐに埋まるため、スピーディな対応が重要です。
                        </p>
                        <h4 class="step-card__check-title">申込時に必要なもの</h4>
                        <ul class="step-card__checklist">
                            <li>本人確認書類（運転免許証・マイナンバーカードなど）</li>
                            <li>収入証明書（源泉徴収票・給与明細など）</li>
                            <li>勤務先情報（会社名・住所・電話番号）</li>
                            <li>連帯保証人の情報（利用する場合）</li>
                            <li>入居申込書への記入・署名</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--renting-b">
                            <div class="step-tip__icon">⚠️</div>
                            <div class="step-tip__title">申込前の注意事項</div>
                            <p class="step-tip__text">
                                人気物件は複数の申込が競合する場合があります。
                                「申込＝契約確定」ではありませんが、
                                申込後のキャンセルはオーナー側に迷惑がかかるため、
                                よく検討した上で申し込みましょう。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">目安期間</span>
                                <span class="step-meta__val">1〜3日</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--purple">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 04 --}}
        <div class="step-card reveal" id="step04">
            <div class="step-card__header step-card__header--renting-b">
                <div class="step-card__num">STEP 04</div>
                <div class="step-card__icon">✅</div>
                <h3 class="step-card__title">入居審査</h3>
                <p class="step-card__subtitle">オーナー・保証会社が審査を行います</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            申込後、オーナーまたは管理会社・家賃保証会社が入居審査を行います。
                            収入・勤務状況・信用情報などをもとに、
                            入居可否が判断されます。
                            結果は数日以内にお知らせします。
                        </p>
                        <h4 class="step-card__check-title">審査通過のポイント</h4>
                        <ul class="step-card__checklist">
                            <li>収入が月額賃料の3倍以上あること</li>
                            <li>安定した勤務先・雇用形態（正社員・公務員が有利）</li>
                            <li>過去に家賃滞納・信用情報に問題がないこと</li>
                            <li>連帯保証人または家賃保証会社の利用</li>
                            <li>申込書の記入内容に誤りがないこと</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--renting-b">
                            <div class="step-tip__icon">💡</div>
                            <div class="step-tip__title">審査が通らない場合</div>
                            <p class="step-tip__text">
                                収入が少ない場合でも、連帯保証人の追加や
                                保証会社の変更で審査が通るケースがあります。
                                まずは担当者にご相談ください。
                                別の物件をご提案することも可能です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">審査期間</span>
                                <span class="step-meta__val">3〜7日</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--purple">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 05 --}}
        <div class="step-card reveal" id="step05">
            <div class="step-card__header step-card__header--renting-b">
                <div class="step-card__num">STEP 05</div>
                <div class="step-card__icon">📋</div>
                <h3 class="step-card__title">重要事項説明・賃貸借契約の締結</h3>
                <p class="step-card__subtitle">法律上の重要な手続きです</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            審査通過後、宅地建物取引士が物件・契約条件に関する
                            重要事項を説明します（重要事項説明）。
                            内容をよく確認・理解した上で賃貸借契約書に署名・押印します。
                        </p>
                        <h4 class="step-card__check-title">重要事項説明で確認すること</h4>
                        <ul class="step-card__checklist">
                            <li>賃料・管理費・敷金・礼金の金額</li>
                            <li>契約期間（普通借家か定期借家か）</li>
                            <li>更新料・解約予告期間（通常1〜2ヶ月前）</li>
                            <li>禁止事項（ペット・楽器・転貸など）</li>
                            <li>原状回復の範囲（どこまで自己負担か）</li>
                            <li>設備の状況と修繕の負担区分</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--renting-b">
                            <div class="step-tip__icon">⚠️</div>
                            <div class="step-tip__title">原状回復について</div>
                            <p class="step-tip__text">
                                退去時に「原状回復」が求められますが、
                                通常の使用による劣化（経年劣化）はオーナー負担です。
                                入居前の状態を写真に残しておくとトラブル防止になります。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">1〜2時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">場所</span>
                                <span class="step-meta__val">当社店舗または来訪</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 06 --}}
        <div class="step-card reveal" id="step06">
            <div class="step-card__header step-card__header--renting-c">
                <div class="step-card__num">STEP 06</div>
                <div class="step-card__icon">💴</div>
                <h3 class="step-card__title">初期費用のお支払い</h3>
                <p class="step-card__subtitle">契約時に必要な費用をご用意ください</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            賃貸借契約の締結と合わせて、初期費用をお支払いいただきます。
                            初期費用は一般的に賃料の4〜6ヶ月分程度が目安です。
                            事前に資金を準備しておきましょう。
                        </p>
                        <h4 class="step-card__check-title">初期費用の内訳（目安）</h4>
                        <ul class="step-card__checklist">
                            <li>敷金：賃料の1〜2ヶ月分（退去時精算後返還）</li>
                            <li>礼金：賃料の0〜2ヶ月分（返還なし）</li>
                            <li>前払い家賃：入居月＋翌月分</li>
                            <li>仲介手数料：賃料の0.5〜1ヶ月分＋消費税</li>
                            <li>火災保険料：約1〜2万円（2年間）</li>
                            <li>保証会社利用料：賃料の0.5〜1ヶ月分（初回）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--renting-c">
                            <div class="step-tip__icon">📌</div>
                            <div class="step-tip__title">初期費用を抑えるには</div>
                            <p class="step-tip__text">
                                敷金・礼金ゼロの物件や、フリーレント（入居後一定期間の家賃無料）付き物件を探すことで
                                初期費用を抑えることができます。
                                ご希望に合わせてご提案します。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">初期費用目安</span>
                                <span class="step-meta__val">賃料の4〜6ヶ月分</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">支払方法</span>
                                <span class="step-meta__val">振込または現金</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 07 --}}
        <div class="step-card step-card--final reveal" id="step07">
            <div class="step-card__header step-card__header--renting-c">
                <div class="step-card__num">STEP 07</div>
                <div class="step-card__icon">🔑</div>
                <h3 class="step-card__title">鍵の受取・入居開始</h3>
                <p class="step-card__subtitle">いよいよ新生活のスタートです</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            入居開始日に鍵を受け取り、室内の状態（傷・汚れ・設備の動作など）を
                            担当者と一緒に確認します（入居チェックリストへ記録）。
                            これにより退去時のトラブルを未然に防ぎます。
                        </p>
                        <h4 class="step-card__check-title">入居後にすること</h4>
                        <ul class="step-card__checklist">
                            <li>住所変更手続き（役所・運転免許証・各種カードなど）</li>
                            <li>電気・ガス・水道の使用開始手続き</li>
                            <li>インターネット回線の契約・設置</li>
                            <li>入居チェックリストへの記入・保管</li>
                            <li>室内の傷・汚れを写真に記録しておく</li>
                            <li>ゴミ出しルール・管理規約の確認</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--renting-c">
                            <div class="step-tip__icon">🎉</div>
                            <div class="step-tip__title">入居後もサポート</div>
                            <p class="step-tip__text">
                                入居後に設備のトラブルや不具合が発生した場合も、
                                当社または管理会社へすぐにご連絡ください。
                                快適な新生活を応援しています。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">鍵の受取</span>
                                <span class="step-meta__val">入居日当日</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">担当</span>
                                <span class="step-meta__val">当社スタッフが立会い</span>
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
            <h2 class="section-title">賃貸入居時の初期費用ガイド</h2>
            <p class="section-desc">入居時に必要な費用の目安です</p>
        </div>
        <div class="cost-grid">
            <div class="cost-card reveal">
                <div class="cost-card__icon">🏠</div>
                <h4 class="cost-card__title">敷金</h4>
                <p class="cost-card__formula renting-formula">賃料の1〜2ヶ月分</p>
                <p class="cost-card__note">退去時に原状回復費用を差し引いて返還されます</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🤝</div>
                <h4 class="cost-card__title">礼金</h4>
                <p class="cost-card__formula renting-formula">賃料の0〜2ヶ月分</p>
                <p class="cost-card__note">オーナーへのお礼金で返還されません（0の物件も多い）</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">📄</div>
                <h4 class="cost-card__title">仲介手数料</h4>
                <p class="cost-card__formula renting-formula">賃料の0.5〜1ヶ月分＋消費税</p>
                <p class="cost-card__note">法律で定められた上限額。成約時のみ発生</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🔥</div>
                <h4 class="cost-card__title">火災保険料</h4>
                <p class="cost-card__formula renting-formula">約1〜2万円（2年間）</p>
                <p class="cost-card__note">入居時の加入が必須。補償内容を確認しましょう</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🛡</div>
                <h4 class="cost-card__title">家賃保証会社利用料</h4>
                <p class="cost-card__formula renting-formula">賃料の50〜100%（初回）</p>
                <p class="cost-card__note">連帯保証人の代わりとして利用。更新料が別途発生</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">🔑</div>
                <h4 class="cost-card__title">鍵交換費用</h4>
                <p class="cost-card__formula renting-formula">約1.5〜3万円</p>
                <p class="cost-card__note">防犯のため入居前に実施。入居者負担が多い</p>
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
                ['q'=>'初期費用はどのくらい必要ですか？','a'=>'一般的に賃料の4〜6ヶ月分が目安です。例えば月額賃料7万円の物件であれば28〜42万円程度を現金で準備する必要があります。ただし敷金・礼金ゼロの物件や、フリーレント付きの物件では抑えることが可能です。'],
                ['q'=>'収入が少なくても借りられますか？','a'=>'収入の目安は月額賃料の3倍以上とされています。収入が少ない場合でも、連帯保証人を立てることや、保証会社を変更することで審査が通るケースもあります。まずはご相談ください。'],
                ['q'=>'退去時の費用はどのくらいかかりますか？','a'=>'通常の使用（経年劣化）による傷みはオーナー負担ですが、入居者の過失による損傷は原状回復費用として負担が生じます。敷金の範囲内で精算されることが多いですが、敷金を超える場合は追加請求されることもあります。'],
                ['q'=>'ペット可の物件は少ないですか？','a'=>'ペット可の物件は全体の1〜2割程度と少なめですが、当社では積極的にご紹介しております。ただし犬・猫の種類・サイズに制限がある場合も多いです。事前にご希望をお伝えください。'],
                ['q'=>'契約途中で解約できますか？','a'=>'可能です。ただし一般的に解約の1〜2ヶ月前に予告が必要です（契約書に記載）。予告なしの解約や短期解約の場合は違約金が発生することがあります。詳細は契約書をご確認ください。'],
                ['q'=>'外国人でも借りられますか？','a'=>'はい、外国人の方でも賃貸契約は可能です。ただし審査が厳しくなる場合や、日本語での対応が必要な場合があります。在留資格や収入状況などによって審査結果が異なりますので、まずはご相談ください。'],
            ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div class="faq-item reveal">
                <button class="faq-item__q" aria-expanded="false">
                    <span class="faq-item__q-icon faq-item__q-icon--purple">Q</span>
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
<section class="flow-cta flow-cta--renting">
    <div class="container">
        <div class="flow-cta__box">
            <p class="section-label" style="color:#c4b5fd;">Contact Us</p>
            <h2 class="flow-cta__title">まずは無料でご相談ください</h2>
            <p class="flow-cta__desc">
                お部屋探しのご相談はいつでも無料です。<br>
                専任スタッフが丁寧にご対応し、理想のお部屋をご提案します。
            </p>
            <div class="flow-cta__buttons">
                <a href="{{ url('/properties') }}" class="btn btn--primary btn--lg">物件を探す</a>
                <a href="{{ url('/') }}#contact" class="btn btn--outline-white btn--lg">無料相談はこちら</a>
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
    padding: 140px 0 60px;
    overflow: hidden;
    text-align: center;
}
.flow-hero--renting {
    background: linear-gradient(135deg, #4c1d95 0%, #6d28d9 50%, #8b5cf6 100%);
}
.flow-hero__bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 20% 50%, rgba(196,181,253,.15) 0%, transparent 60%),
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
.flow-timeline--renting {
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
.flow-timeline--renting .flow-timeline__item:not(:nth-child(4n))::after {
    content: '';
    position: absolute;
    top: 35px;
    left: 50%;
    right: -50%;
    height: 3px;
    z-index: 0;
}
.flow-timeline--renting .flow-timeline__item:nth-child(1)::after,
.flow-timeline--renting .flow-timeline__item:nth-child(2)::after { background: #8b5cf6; opacity: .7; }
.flow-timeline--renting .flow-timeline__item:nth-child(3)::after { background: linear-gradient(90deg, #8b5cf6, #6d28d9); opacity: .7; }
.flow-timeline--renting .flow-timeline__item:nth-child(5)::after,
.flow-timeline--renting .flow-timeline__item:nth-child(6)::after { background: #6d28d9; opacity: .7; }

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
.flow-timeline__dot--renting-a { background: #8b5cf6; }
.flow-timeline__dot--renting-b { background: #6d28d9; }
.flow-timeline__dot--renting-c { background: #4c1d95; }
.flow-timeline__num { font-size: .7rem; font-weight: 700; letter-spacing: .08em; color: #7c3aed; margin-bottom: 4px; display: block; }
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
.step-card--final { border: 2px solid #4c1d95; }
.step-card__header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 24px 32px;
    color: var(--white);
}
.step-card__header--renting-a { background: linear-gradient(135deg, #6d28d9, #8b5cf6); }
.step-card__header--renting-b { background: linear-gradient(135deg, #5b21b6, #6d28d9); }
.step-card__header--renting-c { background: linear-gradient(135deg, #3b0764, #4c1d95); }
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
    color: #7c3aed; font-weight: 700; font-size: .85rem;
}

/* ---- STEP TIP ---- */
.step-tip { border-radius: var(--radius-md); padding: 20px; margin-bottom: 20px; }
.step-tip--renting-a { background: #f5f3ff; }
.step-tip--renting-b { background: #ede9fe; }
.step-tip--renting-c { background: #f5f3ff; }
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
.step-meta__val--purple { color: #7c3aed; }

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
.renting-formula { color: #7c3aed; }
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
.faq-item.is-open { border-color: #7c3aed; }
.faq-item__q {
    width: 100%;
    display: flex; align-items: center; gap: 14px;
    padding: 18px 20px;
    text-align: left;
    font-size: .95rem; font-weight: 700; color: var(--dark);
    background: var(--white);
    transition: background var(--transition);
}
.faq-item.is-open .faq-item__q { background: #f5f3ff; color: #7c3aed; }
.faq-item__q-icon {
    flex-shrink: 0; width: 28px; height: 28px;
    background: var(--orange); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700;
}
.faq-item__q-icon--purple { background: #7c3aed; }
.faq-item.is-open .faq-item__q-icon--purple { background: #5b21b6; }
.faq-item__arrow {
    width: 20px; height: 20px; margin-left: auto; flex-shrink: 0;
    color: var(--text-light);
    transition: transform var(--transition);
}
.faq-item.is-open .faq-item__arrow { transform: rotate(180deg); color: #7c3aed; }
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
.flow-cta--renting { background: linear-gradient(135deg, #4c1d95 0%, #6d28d9 60%, #8b5cf6 100%); padding: 80px 0; }
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
    .flow-timeline--renting { grid-template-columns: repeat(2, 1fr); gap: 24px; }
    .flow-timeline--renting .flow-timeline__item:not(:nth-child(4n))::after { display: none; }
    .flow-timeline--renting .flow-timeline__item:nth-child(odd):not(:last-child)::after { display: block; }
    .step-card__cols { grid-template-columns: 1fr; }
    .step-card__subtitle { display: none; }
    .cost-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .flow-hero { padding: 120px 0 40px; }
    .flow-timeline--renting { grid-template-columns: 1fr 1fr; }
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
