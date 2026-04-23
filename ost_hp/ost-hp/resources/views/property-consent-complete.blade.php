<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物件の広告掲載を承諾いたしました - {{ $property->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', sans-serif;
            background: #f0f2f8;
            color: #2b2d42;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0,0,0,.08);
            width: 100%;
            max-width: 480px;
            padding: 40px 32px;
            text-align: center;
        }
        .icon { font-size: 3.5rem; margin-bottom: 16px; }
        .title { font-size: 1.2rem; font-weight: 700; margin-bottom: 10px; }
        .text { font-size: .88rem; color: #7b7b9a; line-height: 1.8; margin-bottom: 28px; }
        .prop-summary {
            background:#f8f9ff; border-radius:10px; padding:14px 16px;
            display:grid; grid-template-columns:auto 1fr; gap:6px 16px;
            font-size:.88rem; text-align:left; margin-bottom:28px;
        }
        .prop-summary__label { color:#7b7b9a; font-size:.75rem; font-weight:700; white-space:nowrap; padding-top:1px; }
        .prop-summary__value { font-weight:600; color:#2b2d42; }
        .prop-summary__value--price { color:#2f7cff; font-size:1.05rem; font-weight:700; }
        .note { padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; text-align:left; }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            color: #fff;
            border-radius: 50px;
            padding: 13px 36px;
            font-size: .95rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(47,124,255,.35);
            transition: opacity .2s;
            margin-top: 24px;
        }
        .btn-back:hover { opacity: .9; }
    </style>
</head>
<body>
<div class="card">
    <div class="icon">✅</div>
    <h1 class="title">物件の広告掲載を承諾いたしました</h1>
    <p class="text">
        ご申請ありがとうございます。これより掲載いただけます。<br>
        早期の成約に向けて、積極的なご紹介を何卒よろしくお願い申し上げます。
    </p>
    <div class="prop-summary">
        <span class="prop-summary__label">物件種類</span>
        <span class="prop-summary__value">{{ $property->typeLabel() }}</span>
        <span class="prop-summary__label">物件名称</span>
        <span class="prop-summary__value">{{ $property->title }}</span>
        <span class="prop-summary__label">価格</span>
        <span class="prop-summary__value prop-summary__value--price">{{ $property->priceFormatted() }}</span>
    </div>
    <a href="{{ route('property.confirm', $property->confirm_token) }}" class="btn-back">
        ← 最新状態確認画面に戻る
    </a>
</div>
</body>
</html>
