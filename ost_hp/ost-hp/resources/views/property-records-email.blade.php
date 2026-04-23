<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 内見予約・広告掲載許可申請の確認</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', sans-serif;
            background: #f0f2f8; color: #2b2d42;
            min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 32px 16px;
        }
        .card { background:#fff; border-radius:14px; box-shadow:0 2px 16px rgba(0,0,0,.08); width:100%; max-width:480px; }
        .card__header { padding:20px 24px; border-bottom:1px solid #f0f2f8; }
        .card__back { display:inline-flex; align-items:center; gap:4px; font-size:.78rem; color:#2f7cff; text-decoration:none; margin-bottom:8px; }
        .card__back:hover { text-decoration:underline; }
        .card__body { padding:24px; display:flex; flex-direction:column; gap:18px; }
        .field label { display:block; font-size:.8rem; font-weight:700; color:#334155; margin-bottom:6px; }
        .field label .req { color:#e53e3e; margin-left:4px; font-size:.72rem; }
        .field input[type=email] { width:100%; padding:10px 14px; border:1px solid #e4e6f0; border-radius:8px; font-size:.95rem; font-family:inherit; outline:none; transition:border-color .15s; }
        .field input:focus { border-color:#2f7cff; }
        .field .error { font-size:.75rem; color:#e53e3e; margin-top:4px; }
        .btn-submit { width:100%; padding:14px; border:none; border-radius:10px; background:#2f7cff; color:#fff; font-size:.95rem; font-weight:700; font-family:inherit; cursor:pointer; letter-spacing:.03em; transition:background .15s; }
        .btn-submit:hover { background:#1a6ae8; }
        .note { padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <a href="{{ route('property.confirm', $token) }}" class="card__back">← 最新状態確認に戻る</a>
        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">内見予約・広告掲載許可申請の確認</div>
        <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
    </div>
    <div class="card__body">
        <div class="note">
            申込時に使用したメールアドレスを入力してください。<br>
            認証コードをメールへ送信します。
        </div>

        @if($errors->any())
        <div style="background:#fff0f3;border:1px solid #ffc0cb;border-radius:8px;padding:12px 16px;font-size:.82rem;color:#c0003c;">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('property.records.send-code', $token) }}" style="display:flex;flex-direction:column;gap:16px;">
            @csrf
            <div class="field">
                <label>メールアドレス<span class="req">必須</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="example@email.com" autocomplete="email" autofocus>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-submit">認証コードを送信する</button>
        </form>
    </div>
</div>
</body>
</html>
