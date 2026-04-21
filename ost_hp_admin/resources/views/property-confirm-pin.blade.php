<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認番号を入力してください</title>
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
            max-width: 360px;
            padding: 40px 32px;
            text-align: center;
        }
        .icon { font-size: 2.4rem; margin-bottom: 16px; }
        h1 { font-size: 1.05rem; font-weight: 700; margin-bottom: 8px; }
        .sub { font-size: .82rem; color: #7b7b9a; margin-bottom: 28px; line-height: 1.6; }
        .pin-wrap {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .pin-wrap input {
            width: 52px;
            height: 60px;
            text-align: center;
            font-size: 1.6rem;
            font-weight: 700;
            border: 2px solid #e4e6f0;
            border-radius: 10px;
            outline: none;
            transition: border-color .2s;
            appearance: none;
            -moz-appearance: textfield;
        }
        .pin-wrap input::-webkit-outer-spin-button,
        .pin-wrap input::-webkit-inner-spin-button { -webkit-appearance: none; }
        .pin-wrap input:focus { border-color: #2f7cff; }
        button[type=submit] {
            width: 100%;
            padding: 13px;
            background: #2f7cff;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
        }
        button[type=submit]:hover { background: #1a6aee; }
    </style>
</head>
<body>
<div class="card">
    <div class="icon">🔒</div>
    <h1>確認番号を入力してください</h1>
    <p class="sub">担当者からお知らせした<br>4桁の確認番号を入力してください。</p>

    <form method="POST" action="{{ route('property.confirm.verify', $token) }}" id="pin-form">
        @csrf
        <input type="hidden" name="pin" id="pin-hidden">
        <div class="pin-wrap">
            <input type="number" class="pin-digit" maxlength="1" min="0" max="9" inputmode="numeric" autofocus>
            <input type="number" class="pin-digit" maxlength="1" min="0" max="9" inputmode="numeric">
            <input type="number" class="pin-digit" maxlength="1" min="0" max="9" inputmode="numeric">
            <input type="number" class="pin-digit" maxlength="1" min="0" max="9" inputmode="numeric">
        </div>
        <button type="submit">確認する</button>
    </form>
</div>

<script>
    const digits = document.querySelectorAll('.pin-digit');
    digits.forEach((el, i) => {
        el.addEventListener('input', () => {
            el.value = el.value.slice(-1);
            if (el.value && i < digits.length - 1) digits[i + 1].focus();
            updateHidden();
        });
        el.addEventListener('keydown', e => {
            if (e.key === 'Backspace' && !el.value && i > 0) digits[i - 1].focus();
        });
    });

    function updateHidden() {
        document.getElementById('pin-hidden').value =
            Array.from(digits).map(d => d.value).join('');
    }

    document.getElementById('pin-form').addEventListener('submit', e => {
        updateHidden();
        const pin = document.getElementById('pin-hidden').value;
        if (pin.length !== 4) { e.preventDefault(); digits[0].focus(); }
    });
</script>
</body>
</html>
