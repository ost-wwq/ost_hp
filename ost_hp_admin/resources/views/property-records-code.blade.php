<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 認証コードの入力</title>
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
        .code-input {
            width:100%; padding:14px; border:1.5px solid #e4e6f0; border-radius:8px;
            font-size:1.8rem; font-weight:700; letter-spacing:.3em; text-align:center;
            font-family:inherit; outline:none; transition:border-color .15s;
        }
        .code-input:focus { border-color:#2f7cff; }
        .error { font-size:.75rem; color:#e53e3e; margin-top:4px; }
        .btn-submit { width:100%; padding:14px; border:none; border-radius:10px; background:#2f7cff; color:#fff; font-size:.95rem; font-weight:700; font-family:inherit; cursor:pointer; letter-spacing:.03em; transition:background .15s; }
        .btn-submit:hover { background:#1a6ae8; }
        .note { padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; }
        .resend { text-align:center; font-size:.82rem; }
        .resend a { color:#2f7cff; text-decoration:none; }
        .resend a:hover { text-decoration:underline; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <a href="{{ route('property.records.email', $token) }}" class="card__back">← メールアドレス入力に戻る</a>
        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">認証コードの入力</div>
        <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
    </div>
    <div class="card__body">
        <div class="note">
            @if($hint)
                <strong>{{ $hint }}</strong> に認証コードを送信しました。<br>
            @else
                メールに記載された認証コードを入力してください。<br>
            @endif
            コードの有効期限は10分です。
        </div>

        @if($errors->any())
        <div style="background:#fff0f3;border:1px solid #ffc0cb;border-radius:8px;padding:12px 16px;font-size:.82rem;color:#c0003c;">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('property.records.verify-code', $token) }}" style="display:flex;flex-direction:column;gap:16px;">
            @csrf
            <div>
                <input type="text" name="code" class="code-input"
                       inputmode="numeric" pattern="[0-9]*" maxlength="6"
                       placeholder="000000" autocomplete="one-time-code" autofocus>
                @error('code')<div class="error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-submit">確認する</button>
        </form>

        <div class="resend">
            コードが届かない場合は
            <a href="{{ route('property.records.email', $token) }}">再送信する</a>
        </div>
    </div>
</div>
</body>
</html>
