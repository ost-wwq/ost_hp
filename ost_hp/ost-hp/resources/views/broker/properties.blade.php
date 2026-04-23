<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | ワンステップテックス不動産</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue: #2f7cff;
            --orange: #f17c20;
            --teal: #4eba9a;
            --dark: #2b2d42;
            --text: #4a4a6a;
            --border: #e8e8f0;
            --bg: #f0f2f8;
        }
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background: var(--bg);
            color: var(--dark);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            padding: 0;
        }
        .header__inner {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header__brand { display: flex; align-items: center; gap: 10px; color: #fff; }
        .header__brand-logo { font-size: 1.3rem; }
        .header__brand-name { font-size: .9rem; font-weight: 700; }
        .header__logout a {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,.75);
            font-size: .82rem;
            font-weight: 600;
            text-decoration: none;
            padding: 8px 14px;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 50px;
            transition: .2s;
        }
        .header__logout a:hover { background: rgba(255,255,255,.1); color: #fff; }

        /* Hero strip */
        .hero-strip {
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            padding: 0 0 40px;
        }
        .hero-strip__inner {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .hero-strip h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
        }
        .hero-strip__meta {
            font-size: .8rem;
            color: rgba(255,255,255,.65);
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        /* Note */
        .note-box {
            max-width: 960px;
            margin: -20px auto 0;
            padding: 0 24px;
        }
        .note-box__inner {
            background: #fff8e8;
            border: 1px solid #f5d87a;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: .88rem;
            color: #7a5700;
            line-height: 1.65;
        }

        /* Main */
        .main {
            max-width: 960px;
            margin: 0 auto;
            padding: 32px 24px 60px;
        }

        /* Type group */
        .type-group { margin-bottom: 36px; }
        .type-group__header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        .type-group__label {
            font-size: .88rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: .05em;
        }
        .type-group__count {
            font-size: .78rem;
            color: #9090b0;
            background: #f0f2f8;
            padding: 2px 10px;
            border-radius: 50px;
        }

        /* Consent button */
        .btn-consent {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 6px 14px;
            font-size: .78rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            transition: opacity .2s;
        }
        .btn-consent:hover { opacity: .85; }

        /* Property rows */
        .prop-row {
            display: grid;
            grid-template-columns: auto 1fr auto auto auto;
            gap: 0 16px;
            align-items: center;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 8px;
            transition: box-shadow .2s;
        }
        .prop-row:hover { box-shadow: 0 4px 16px rgba(43,45,66,.1); }
        .prop-row__thumb {
            width: 64px;
            height: 54px;
            border-radius: 8px;
            overflow: hidden;
            background: #e8f0fe;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .prop-row__thumb img { width: 100%; height: 100%; object-fit: cover; }
        .prop-row__info { min-width: 0; }
        .prop-row__title {
            font-size: .95rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .prop-row__sub {
            font-size: .78rem;
            color: #9090b0;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .prop-row__price {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--blue);
            white-space: nowrap;
            text-align: right;
        }
        .prop-row__status { text-align: right; }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: .8rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .status-badge::before { content: ''; width: 8px; height: 8px; border-radius: 50%; }
        .status-badge--available {
            background: #e4f7f2;
            color: #1a7a5a;
        }
        .status-badge--available::before {
            background: #4eba9a;
            box-shadow: 0 0 0 2px rgba(78,186,154,.3);
            animation: pulse 1.8s ease-in-out infinite;
        }
        .status-badge--contract {
            background: #fef0e4;
            color: #c96400;
        }
        .status-badge--contract::before { background: #f17c20; }
        .status-badge--closed {
            background: #f0f2f8;
            color: #9090b0;
        }
        .status-badge--closed::before { background: #c0c0d0; }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 2px rgba(78,186,154,.3); }
            50% { box-shadow: 0 0 0 5px rgba(78,186,154,.08); }
        }

        /* Legend */
        .legend {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 28px;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            align-items: center;
        }
        .legend__title { font-size: .78rem; font-weight: 700; color: #9090b0; margin-right: 8px; }

        /* Summary bar */
        .summary {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 28px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
            text-align: center;
        }
        .summary__item { padding: 8px 0; }
        .summary__item + .summary__item { border-left: 1px solid var(--border); }
        .summary__num { font-size: 1.6rem; font-weight: 700; }
        .summary__label { font-size: .75rem; color: #9090b0; margin-top: 2px; }
        .summary__item:nth-child(1) .summary__num { color: var(--teal); }
        .summary__item:nth-child(2) .summary__num { color: var(--orange); }
        .summary__item:nth-child(3) .summary__num { color: #c0c0d0; }

        /* Empty */
        .empty { text-align: center; padding: 40px; color: #9090b0; font-size: .9rem; }
        .print-btn {
            padding: 8px 18px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,.4);
            background: transparent;
            color: rgba(255,255,255,.8);
            font-size: .82rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: .2s;
        }
        .print-btn:hover { background: rgba(255,255,255,.1); color: #fff; }

        @media print {
            .header__logout, .print-btn { display: none; }
            .prop-row { break-inside: avoid; }
        }
        @media (max-width: 600px) {
            .prop-row { grid-template-columns: auto 1fr; grid-template-rows: auto auto auto; }
            .prop-row__price { grid-column: 2; }
            .prop-row__status { grid-column: 1 / -1; text-align: left; }
            .prop-row > div:last-child { grid-column: 1 / -1; }
            .summary { grid-template-columns: repeat(3, 1fr); }
        }
    </style>
</head>
<body>

<div class="header">
    <div class="header__inner">
        <div class="header__brand">
            <span class="header__brand-logo">🏠</span>
            <span class="header__brand-name">ワンステップテックス不動産</span>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <button class="print-btn" onclick="window.print()">🖨 印刷</button>
            <div class="header__logout">
                <form method="POST" action="{{ route('broker.logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;cursor:pointer;display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.75);font-size:.82rem;font-weight:600;font-family:inherit;padding:8px 14px;border:1px solid rgba(255,255,255,.3);border-radius:50px;transition:.2s;" onmouseover="this.style.background='rgba(255,255,255,.1)';this.style.color='#fff'" onmouseout="this.style.background='';this.style.color='rgba(255,255,255,.75)'">
                        🚪 終了
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="hero-strip">
    <div class="hero-strip__inner">
        <h1>{{ $title }}</h1>
        <div class="hero-strip__meta">
            <span>📅 {{ now()->format('Y年m月d日 H:i') }} 現在</span>
            @if($updatedAt)
                <span>🔄 最終更新: {{ \Carbon\Carbon::parse($updatedAt)->format('Y/m/d H:i') }}</span>
            @endif
        </div>
    </div>
</div>

@if($note)
<div class="note-box">
    <div class="note-box__inner">📋 {{ $note }}</div>
</div>
@endif

<div class="main">

    {{-- サマリー --}}
    @php
        use App\Models\Property;
        $allProps = \App\Models\Property::all();
        $totalAvailable = $allProps->where('status','available')->count();
        $totalContract  = $allProps->where('status','contract')->count();
        $totalClosed    = $allProps->where('status','closed')->count();
    @endphp
    <div class="summary">
        <div class="summary__item">
            <div class="summary__num">{{ $totalAvailable }}</div>
            <div class="summary__label">ご紹介可能</div>
        </div>
        <div class="summary__item">
            <div class="summary__num">{{ $totalContract }}</div>
            <div class="summary__label">商談中</div>
        </div>
        <div class="summary__item">
            <div class="summary__num">{{ $totalClosed }}</div>
            <div class="summary__label">成約済み</div>
        </div>
    </div>

    {{-- 凡例 --}}
    <div class="legend">
        <span class="legend__title">ステータス凡例</span>
        <span class="status-badge status-badge--available">ご紹介可能</span>
        <span class="status-badge status-badge--contract">商談中</span>
        <span class="status-badge status-badge--closed">成約済み</span>
    </div>

    {{-- 物件一覧（種別グループ別） --}}
    @php
        $typeOptions = \App\Models\Property::typeOptions();
        $statusMap = [
            'available' => ['label' => 'ご紹介可能', 'class' => 'available'],
            'contract'  => ['label' => '商談中',     'class' => 'contract'],
            'closed'    => ['label' => '成約済み',   'class' => 'closed'],
        ];
    @endphp

    @if($properties->isEmpty())
        <div class="empty">登録されている物件はありません</div>
    @else
        @foreach($typeOptions as $typeKey => $typeLabel)
            @if(isset($properties[$typeKey]) && $properties[$typeKey]->isNotEmpty())
            <div class="type-group">
                <div class="type-group__header">
                    <span class="type-group__label">{{ $typeLabel }}</span>
                    <span class="type-group__count">{{ $properties[$typeKey]->count() }}件</span>
                </div>

                @foreach($properties[$typeKey] as $p)
                <div class="prop-row">
                    <div class="prop-row__thumb">
                        @if($p->main_image)
                            <img src="{{ asset('uploads/'.$p->main_image) }}" alt="">
                        @else
                            🏠
                        @endif
                    </div>
                    <div class="prop-row__info">
                        <div class="prop-row__title">{{ $p->title }}</div>
                        <div class="prop-row__sub">
                            <span>📍 {{ $p->address }}</span>
                            @if($p->rooms)<span>🚪 {{ $p->rooms }}</span>@endif
                            @if($p->area)<span>📐 {{ number_format($p->area,1) }}㎡</span>@endif
                            @if($p->age !== null)<span>🏗 築{{ $p->age }}年</span>@endif
                        </div>
                    </div>
                    <div class="prop-row__price">{{ $p->priceFormatted() }}</div>
                    <div class="prop-row__status">
                        @php $st = $statusMap[$p->status] ?? $statusMap['closed']; @endphp
                        <span class="status-badge status-badge--{{ $st['class'] }}">{{ $st['label'] }}</span>
                    </div>
                    <div>
                        <a href="{{ route('broker.consent.show', $p) }}" class="btn-consent">📝 広告掲載許可申請</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        @endforeach

        {{-- その他の種別 --}}
        @if(isset($properties['other']) && $properties['other']->isNotEmpty())
        <div class="type-group">
            <div class="type-group__header">
                <span class="type-group__label">その他</span>
                <span class="type-group__count">{{ $properties['other']->count() }}件</span>
            </div>
            @foreach($properties['other'] as $p)
            <div class="prop-row">
                <div class="prop-row__thumb">
                    @if($p->main_image)<img src="{{ asset('uploads/'.$p->main_image) }}" alt="">@else 🏠 @endif
                </div>
                <div class="prop-row__info">
                    <div class="prop-row__title">{{ $p->title }}</div>
                    <div class="prop-row__sub"><span>📍 {{ $p->address }}</span></div>
                </div>
                <div class="prop-row__price">{{ $p->priceFormatted() }}</div>
                <div class="prop-row__status">
                    @php $st = $statusMap[$p->status] ?? $statusMap['closed']; @endphp
                    <span class="status-badge status-badge--{{ $st['class'] }}">{{ $st['label'] }}</span>
                </div>
                <div>
                    <a href="{{ route('broker.consent.show', $p) }}" class="btn-consent">📝 広告掲載許可申請</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    @endif

    <div style="margin-top:40px;text-align:center;font-size:.78rem;color:#b0b0c8;border-top:1px solid #e8e8f0;padding-top:24px;">
        この情報はワンステップテックス不動産の業者向け内部資料です。外部への共有はご遠慮ください。
    </div>
</div>

</body>
</html>
