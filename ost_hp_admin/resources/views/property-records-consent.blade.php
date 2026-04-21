<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲載承諾詳細 - {{ $property->title }}</title>
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
        .card__body { padding:24px; display:flex; flex-direction:column; gap:0; }
        .dl { display:grid; grid-template-columns:120px 1fr; border:1px solid #e4e6f0; border-radius:10px; overflow:hidden; }
        .dl dt { padding:12px 14px; background:#f8f9ff; font-size:.78rem; font-weight:700; color:#7b7b9a; border-bottom:1px solid #f0f2f8; }
        .dl dd { padding:12px 14px; font-size:.9rem; font-weight:500; border-bottom:1px solid #f0f2f8; }
        .dl dt:last-of-type, .dl dd:last-of-type { border-bottom:none; }
        .badge { display:inline-block; padding:2px 8px; border-radius:50px; font-size:.7rem; font-weight:700; background:#e4f7f2; color:#1a7a5a; }
        .ad-tags { display:flex; flex-wrap:wrap; gap:6px; }
        .ad-tag { padding:3px 10px; background:#f0f5ff; border-radius:50px; font-size:.78rem; color:#2f7cff; font-weight:600; }
        .note { margin-top:20px; padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; }
    </style>
</head>
<body>
@php
    $adLabels = [
        'own_hp' => '自社HP',
        'suumo'  => 'スーモ',
        'homes'  => 'ホームズ',
        'athome' => 'アットホーム',
        'store'  => '店舗',
    ];
@endphp
<div class="card">
    <div class="card__header">
        <a href="{{ route('property.records.list', $token) }}" class="card__back">← 申込み一覧に戻る</a>
        <div style="margin-bottom:6px;"><span class="badge">掲載承諾</span></div>
        <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
    </div>
    <div class="card__body">
        <dl class="dl">
            <dt>お名前</dt>
            <dd>{{ $consent->name }}</dd>
            <dt>電話番号</dt>
            <dd>{{ $consent->phone }}</dd>
            <dt>メールアドレス</dt>
            <dd>{{ $consent->email }}</dd>
            <dt>広告宣伝</dt>
            <dd>
                <div class="ad-tags">
                    @foreach($consent->ad_types as $ad)
                        <span class="ad-tag">{{ $adLabels[$ad] ?? $ad }}</span>
                    @endforeach
                </div>
            </dd>
            <dt>申込日時</dt>
            <dd>{{ $consent->created_at->format('Y年m月d日 H:i') }}</dd>
        </dl>
        <div class="note">
            このページは担当者が発行した確認用URLです。<br>
            内容に変更がある場合は担当者までご連絡ください。
        </div>
    </div>
</div>
</body>
</html>
