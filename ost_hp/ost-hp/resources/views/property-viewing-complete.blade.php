<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 内見予約完了</title>
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
            align-items: flex-start;
            justify-content: center;
            padding: 32px 16px;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0,0,0,.08);
            width: 100%;
            max-width: 480px;
        }
        .card__header { padding: 20px 24px; border-bottom: 1px solid #f0f2f8; }
        .card__body { padding: 24px; display: flex; flex-direction: column; gap: 20px; }
        .label { font-size:.72rem;font-weight:700;color:#7b7b9a;letter-spacing:.06em;margin-bottom:4px; }
        .value { font-size:.95rem;font-weight:500; }
        .note { padding:12px 16px;background:#f8f9ff;border-radius:8px;font-size:.78rem;color:#7b7b9a;line-height:1.7; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">内見予約</div>
        <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
    </div>
    <div class="card__body">

        {{-- 完了メッセージ --}}
        <div style="display:flex;align-items:center;gap:10px;padding:14px 18px;background:#e4f7f2;border-radius:10px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1a7a5a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span style="font-size:.95rem;font-weight:700;color:#1a7a5a;">お申し込みを受け付けました</span>
        </div>

        {{-- キーボックス画像 --}}
        @if($property->viewing_keybbox_image)
        <div>
            <div class="label">キーボックス</div>
            <img src="{{ asset('uploads/'.$property->viewing_keybbox_image) }}" alt="キーボックス"
                 style="width:100%;border-radius:8px;border:1px solid #e4e6f0;margin-top:6px;">
        </div>
        @endif

        {{-- キーボックス番号 --}}
        @if($property->viewing_keybbox_number)
        <div>
            <div class="label">キーボックス番号</div>
            <div class="value" style="font-size:1.6rem;font-weight:700;letter-spacing:.15em;color:#2b2d42;">
                {{ $property->viewing_keybbox_number }}
            </div>
        </div>
        @endif

        {{-- 説明文 --}}
        @if($property->viewing_keybbox_description)
        <div>
            <div class="label">説明</div>
            <div class="value" style="white-space:pre-wrap;line-height:1.8;font-size:.9rem;">{{ $property->viewing_keybbox_description }}</div>
        </div>
        @endif

        <div class="note">
            ご不明な点は担当者までお問い合わせください。<br>
            内見後は必ずキーボックスに鍵をお戻しください。
        </div>

    </div>
</div>
</body>
</html>
