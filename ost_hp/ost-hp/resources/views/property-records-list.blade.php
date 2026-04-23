<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 申込み一覧</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', sans-serif;
            background: #f0f2f8; color: #2b2d42;
            min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; padding: 32px 16px;
        }
        .card { background:#fff; border-radius:14px; box-shadow:0 2px 16px rgba(0,0,0,.08); width:100%; max-width:480px; }
        .card__header { padding:20px 24px; border-bottom:1px solid #f0f2f8; }
        .card__back { display:inline-flex; align-items:center; gap:4px; font-size:.78rem; color:#2f7cff; text-decoration:none; margin-bottom:8px; }
        .card__back:hover { text-decoration:underline; }
        .card__body { padding:24px; display:flex; flex-direction:column; gap:20px; }

        .section-title {
            font-size:.72rem; font-weight:700; color:#7b7b9a;
            text-transform:uppercase; letter-spacing:.08em;
            margin-bottom:10px;
        }
        .record-item {
            display:flex; align-items:center; justify-content:space-between;
            padding:14px 16px; border:1px solid #e4e6f0; border-radius:10px;
            text-decoration:none; color:inherit; transition:.15s;
            cursor:pointer;
        }
        .record-item:hover { border-color:#2f7cff; background:#f7f9ff; }
        .record-item__left { flex:1; }
        .record-item__type {
            font-size:.72rem; font-weight:700; color:#7b7b9a;
            text-transform:uppercase; letter-spacing:.06em; margin-bottom:4px;
        }
        .record-item__name { font-size:.95rem; font-weight:600; color:#2b2d42; margin-bottom:2px; }
        .record-item__sub { font-size:.78rem; color:#7b7b9a; }
        .record-item__arrow { color:#c0c0d0; margin-left:12px; }
        .empty { padding:20px; text-align:center; font-size:.88rem; color:#9090b0; background:#f8f9ff; border-radius:10px; }
        .note { padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; }
        .badge { display:inline-block; padding:2px 8px; border-radius:50px; font-size:.7rem; font-weight:700; }
        .badge--viewing { background:#e0f0ff; color:#1a5fbd; }
        .badge--consent { background:#e4f7f2; color:#1a7a5a; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <a href="{{ route('property.confirm', $token) }}" class="card__back">← 最新状態確認に戻る</a>
        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">申込み一覧</div>
        <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
    </div>
    <div class="card__body">

        <div style="font-size:.82rem;color:#7b7b9a;">
            <strong style="color:#2b2d42;">{{ $email }}</strong> で登録された申込みを表示しています
        </div>

        {{-- 内見予約 --}}
        <div>
            <div class="section-title">内見予約</div>
            @forelse($viewings as $v)
            <a href="{{ route('property.records.viewing', [$token, $v->id]) }}" class="record-item" style="display:flex;margin-bottom:8px;">
                <div class="record-item__left">
                    <div style="margin-bottom:4px;"><span class="badge badge--viewing">内見予約</span></div>
                    <div class="record-item__name">{{ $v->name }}</div>
                    <div class="record-item__sub">
                        {{ $v->reserved_date }} {{ $v->reserved_time }}
                        ・申込日 {{ $v->created_at->format('Y/m/d') }}
                    </div>
                </div>
                <div class="record-item__arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </div>
            </a>
            @empty
            <div class="empty">内見予約はありません</div>
            @endforelse
        </div>

        {{-- 広告掲載許可申請 --}}
        <div>
            <div class="section-title">広告掲載許可申請</div>
            @forelse($consents as $c)
            <a href="{{ route('property.records.consent', [$token, $c->id]) }}" class="record-item" style="display:flex;margin-bottom:8px;">
                <div class="record-item__left">
                    <div style="margin-bottom:4px;"><span class="badge badge--consent">広告掲載許可申請</span></div>
                    <div class="record-item__name">{{ $c->name }}</div>
                    <div class="record-item__sub">
                        申込日 {{ $c->created_at->format('Y/m/d') }}
                    </div>
                </div>
                <div class="record-item__arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </div>
            </a>
            @empty
            <div class="empty">広告掲載許可申請はありません</div>
            @endforelse
        </div>

        <div class="note">
            このページは担当者が発行した確認用URLです。<br>
            表示されている情報は {{ now()->format('Y年m月d日 H:i') }} 時点の最新状態です。
        </div>
    </div>
</div>
</body>
</html>
