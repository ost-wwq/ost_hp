<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 最新状態（ご紹介可否）確認</title>
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
            padding: 24px;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0,0,0,.08);
            width: 100%;
            max-width: 480px;
        }
        .card__header { padding: 20px 24px; border-bottom: 1px solid #f0f2f8; display:flex; align-items:center; justify-content:space-between; }
        .card__header-left { flex:1; }
        .card__header-date { font-size:.72rem; color:#7b7b9a; text-align:right; white-space:nowrap; }
        .card__body { padding: 24px; }
        .row { margin-bottom: 18px; }
        .row:last-child { margin-bottom: 0; }
        .label { font-size:.72rem;font-weight:700;color:#7b7b9a;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px; }
        .value { font-size:.95rem;font-weight:500; }
        .price { font-size:1.5rem;font-weight:700;color:#2f7cff; }
        .badge { display:inline-block;padding:5px 14px;border-radius:50px;font-size:.85rem;font-weight:700; }
        .intro-badge { display:flex;align-items:center;gap:8px;padding:14px 18px;border-radius:10px;font-size:1rem;font-weight:700;margin-bottom:20px; }
        .intro-badge--ok { background:#e4f7f2;color:#1a7a5a; }
        .intro-badge--ng { background:#fdecea;color:#c0392b; }
        .note { margin-top:24px;padding:12px 16px;background:#f8f9ff;border-radius:8px;font-size:.78rem;color:#7b7b9a;line-height:1.7; }
    </style>
</head>
<body>
@php
    if (!$property->published) {
        $introType = 'ended_unpublished';
    } elseif ($property->status === 'closed') {
        $introType = 'ended_closed';
    } elseif ($property->status === 'contract') {
        $introType = 'available_contract';
    } else {
        $introType = 'available';
    }
@endphp
<div class="card">
    <div class="card__header">
        <div class="card__header-left">
            <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">最新状態（ご紹介可否）確認</div>
            <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
        </div>
        <div class="card__header-date">
            {{ now()->format('Y年m月d日') }}<br>{{ now()->format('H:i') }}
        </div>
    </div>
    <div class="card__body">
        @if($introType === 'available')
        <div class="intro-badge intro-badge--ok">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            ご紹介可能
        </div>
        @elseif($introType === 'available_contract')
        <div class="intro-badge intro-badge--ok">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            ご紹介可能（申し込みあり）
        </div>
        @elseif($introType === 'ended_closed')
        <div class="intro-badge intro-badge--ng">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            ご成約済みのため、募集を終了いたしました
        </div>
        @else
        <div class="intro-badge intro-badge--ng">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            掲載終了のため、募集を終了いたしました
        </div>
        @endif
        <div class="row">
            <div class="label">種別</div>
            <div class="value">{{ $property->typeLabel() }}</div>
        </div>
        <div class="row">
            <div class="label">価格</div>
            <div class="price">{{ $property->priceFormatted() }}</div>
        </div>
        <div class="row">
            <div class="label">所在地</div>
            <div class="value">{{ $property->address }}</div>
        </div>
        @if($property->area)
        <div class="row">
            <div class="label">面積</div>
            <div class="value">{{ $property->area }} ㎡</div>
        </div>
        @endif
        @if($property->rooms)
        <div class="row">
            <div class="label">間取り</div>
            <div class="value">{{ $property->rooms }}</div>
        </div>
        @endif
        <div class="note">
            このページは担当者が発行した確認用URLです。<br>
            表示されている情報は {{ now()->format('Y年m月d日 H:i') }} 時点の最新状態です。
        </div>
    </div>
</div>
</body>
</html>
