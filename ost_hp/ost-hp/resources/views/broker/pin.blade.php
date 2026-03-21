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
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 60%, #4eba9a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            background: #fff;
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 24px 64px rgba(0,0,0,.2);
            text-align: center;
        }
        .logo { font-size: 2.2rem; margin-bottom: 12px; }
        .brand { font-size: .85rem; color: #7b7b9a; margin-bottom: 6px; }
        h1 { font-size: 1.2rem; font-weight: 700; color: #2b2d42; margin-bottom: 32px; }
        .pin-label { font-size: .82rem; font-weight: 700; color: #7b7b9a; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 16px; }
        /* 4桁ボックス */
        .pin-boxes {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 8px;
        }
        .pin-box {
            width: 58px;
            height: 70px;
            border: 2.5px solid #e4e6f0;
            border-radius: 12px;
            font-size: 2rem;
            font-weight: 700;
            color: #2b2d42;
            text-align: center;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            caret-color: #2f7cff;
            background: #f8f9ff;
        }
        .pin-box:focus {
            border-color: #2f7cff;
            box-shadow: 0 0 0 3px rgba(47,124,255,.15);
            background: #fff;
        }
        .pin-box.filled { border-color: #2f7cff; background: #e8f0fe; }
        .error-msg {
            color: #b91c1c;
            font-size: .85rem;
            margin-bottom: 16px;
            background: #fee2e2;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #fca5a5;
        }
        .btn {
            width: 100%;
            padding: 14px;
            background: #2f7cff;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: background .2s, transform .15s;
            margin-top: 8px;
        }
        .btn:hover { background: #1a5fd9; transform: translateY(-1px); }
        .btn:disabled { background: #a0b4e0; cursor: not-allowed; transform: none; }
        .note { font-size: .78rem; color: #b0b0c8; margin-top: 20px; }
        /* 隠しinput */
        #realInput { position: absolute; opacity: 0; width: 0; height: 0; }
    </style>
</head>
<body>

<div class="card">
    <div class="logo">🏠</div>
    <div class="brand">ワンステップテックス不動産</div>
    <h1>{{ $title }}</h1>

    <form method="POST" action="{{ route('broker.verify') }}" id="pinForm">
        @csrf
        <input type="hidden" name="pin" id="pinValue">

        @if($errors->has('pin'))
            <div class="error-msg">{{ $errors->first('pin') }}</div>
        @endif

        <div class="pin-label">4桁PINを入力してください</div>

        <div class="pin-boxes" id="pinBoxes">
            <div class="pin-box" id="box0" tabindex="0">_</div>
            <div class="pin-box" id="box1" tabindex="0">_</div>
            <div class="pin-box" id="box2" tabindex="0">_</div>
            <div class="pin-box" id="box3" tabindex="0">_</div>
        </div>

        {{-- モバイル用の実際のinput --}}
        <input type="tel" id="realInput" maxlength="4" inputmode="numeric" autocomplete="one-time-code">

        <button type="submit" class="btn" id="submitBtn" disabled>確認する</button>
    </form>

    <p class="note">このページは業者様専用です。PINをお持ちでない方はご利用いただけません。</p>
</div>

<script>
(function() {
    var pin = '';
    var boxes = [
        document.getElementById('box0'),
        document.getElementById('box1'),
        document.getElementById('box2'),
        document.getElementById('box3'),
    ];
    var pinValue = document.getElementById('pinValue');
    var submitBtn = document.getElementById('submitBtn');
    var realInput = document.getElementById('realInput');
    var pinBoxes = document.getElementById('pinBoxes');

    function render() {
        boxes.forEach(function(box, i) {
            if (i < pin.length) {
                box.textContent = '●';
                box.classList.add('filled');
            } else {
                box.textContent = '_';
                box.classList.remove('filled');
            }
        });
        pinValue.value = pin;
        submitBtn.disabled = pin.length < 4;

        // 現在フォーカス位置を強調
        boxes.forEach(function(box, i) {
            box.style.borderColor = i === pin.length && pin.length < 4 ? '#2f7cff' : '';
        });
    }

    function handleKey(e) {
        if (e.key >= '0' && e.key <= '9' && pin.length < 4) {
            pin += e.key;
            render();
            if (pin.length === 4) {
                submitBtn.focus();
            }
        } else if (e.key === 'Backspace') {
            pin = pin.slice(0, -1);
            render();
        } else if (e.key === 'Enter' && pin.length === 4) {
            document.getElementById('pinForm').submit();
        }
    }

    // PC: キーボード入力
    document.addEventListener('keydown', handleKey);

    // モバイル: 数字パッド入力
    pinBoxes.addEventListener('click', function() { realInput.focus(); });
    realInput.addEventListener('input', function() {
        var val = realInput.value.replace(/\D/g, '').slice(0, 4);
        pin = val;
        realInput.value = val;
        render();
        if (pin.length === 4) submitBtn.focus();
    });

    // 数字キーパッド（ボタン式）も用意
    var numpadHtml = '<div style="margin-top:20px;display:grid;grid-template-columns:repeat(3,1fr);gap:8px;" id="numpad">';
    [1,2,3,4,5,6,7,8,9,'','0','⌫'].forEach(function(n) {
        if (n === '') {
            numpadHtml += '<div></div>';
        } else {
            numpadHtml += '<button type="button" data-n="' + n + '" style="padding:14px;border-radius:12px;border:1.5px solid #e4e6f0;background:#f8f9ff;font-size:1.2rem;font-weight:700;color:#2b2d42;cursor:pointer;font-family:inherit;transition:.15s;" onmouseover="this.style.background=\'#e8f0fe\'" onmouseout="this.style.background=\'#f8f9ff\'">' + n + '</button>';
        }
    });
    numpadHtml += '</div>';
    document.getElementById('pinForm').insertAdjacentHTML('beforeend', numpadHtml);

    document.getElementById('numpad').addEventListener('click', function(e) {
        var btn = e.target.closest('button[data-n]');
        if (!btn) return;
        var n = btn.getAttribute('data-n');
        if (n === '⌫') {
            pin = pin.slice(0, -1);
        } else if (pin.length < 4) {
            pin += n;
        }
        render();
        if (pin.length === 4) submitBtn.focus();
    });

    render();
})();
</script>

</body>
</html>
