<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 掲載承諾</title>
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
        .card__header { padding: 20px 24px; border-bottom: 1px solid #f0f2f8; display:flex; align-items:center; justify-content:space-between; }
        .card__header-left { flex:1; }
        .card__back {
            display:inline-flex; align-items:center; gap:4px;
            font-size:.78rem; color:#2f7cff; text-decoration:none; margin-bottom:8px;
        }
        .card__back:hover { text-decoration:underline; }
        .card__body { padding: 24px; display: flex; flex-direction: column; gap: 18px; }

        /* 物件情報 */
        .prop-summary {
            background:#f8f9ff; border-radius:10px; padding:14px 16px;
            display:grid; grid-template-columns:auto 1fr; gap:6px 16px; font-size:.88rem;
        }
        .prop-summary__label { color:#7b7b9a; font-size:.75rem; font-weight:700; white-space:nowrap; padding-top:1px; }
        .prop-summary__value { font-weight:600; color:#2b2d42; }
        .prop-summary__value--price { color:#2f7cff; font-size:1.05rem; font-weight:700; }

        /* フォーム */
        .field label { display:block; font-size:.8rem; font-weight:700; color:#334155; margin-bottom:6px; }
        .field label .req { color:#e53e3e; margin-left:4px; font-size:.72rem; }
        .field label .opt { color:#7b7b9a; margin-left:4px; font-size:.72rem; }
        .field input[type=text],
        .field input[type=tel],
        .field input[type=email] {
            width:100%; padding:10px 14px; border:1px solid #e4e6f0; border-radius:8px;
            font-size:.95rem; font-family:inherit; outline:none; transition:border-color .15s;
        }
        .field input:focus { border-color:#2f7cff; }
        .field .error { font-size:.75rem; color:#e53e3e; margin-top:4px; }
        .file-label {
            display:flex; align-items:center; gap:8px; padding:10px 14px;
            border:1px dashed #c8cce0; border-radius:8px; cursor:pointer;
            font-size:.85rem; color:#7b7b9a; transition:border-color .15s;
        }
        .file-label:hover { border-color:#2f7cff; color:#2f7cff; }
        .file-preview {
            display:none; width:100%; max-height:160px; object-fit:cover;
            border-radius:8px; border:1px solid #e4e6f0; margin-top:8px;
        }

        /* 広告種類チェックボックス */
        .ad-grid {
            display:grid; grid-template-columns:1fr 1fr; gap:8px;
        }
        .ad-item {
            display:flex; align-items:center; gap:8px;
            padding:10px 12px; border:1.5px solid #e4e6f0; border-radius:8px;
            cursor:pointer; font-size:.88rem; font-weight:500; transition:.15s;
        }
        .ad-item:hover { border-color:#2f7cff; background:#f7f9ff; }
        .ad-item input[type=checkbox] { display:none; }
        .ad-item__box {
            width:17px; height:17px; border:1.5px solid #c0c0d0; border-radius:4px;
            flex-shrink:0; display:flex; align-items:center; justify-content:center; transition:.15s;
        }
        .ad-item:has(input:checked) { border-color:#2f7cff; background:#f0f5ff; }
        .ad-item input:checked ~ .ad-item__box {
            background:#2f7cff; border-color:#2f7cff;
        }
        .ad-item input:checked ~ .ad-item__box::after {
            content:''; width:4px; height:8px;
            border:2px solid #fff; border-top:none; border-left:none;
            transform:rotate(45deg) translate(-1px,-1px);
        }

        /* プライバシー */
        .privacy-row {
            display:flex; align-items:flex-start; gap:10px;
            padding:14px 16px; background:#f8f9ff; border-radius:8px;
        }
        .privacy-row input[type=checkbox] { margin-top:2px; flex-shrink:0; width:16px; height:16px; cursor:pointer; accent-color:#2f7cff; }
        .privacy-row label { font-size:.82rem; color:#334155; line-height:1.6; cursor:pointer; }
        .privacy-row a { color:#2f7cff; text-decoration:underline; }

        .btn-submit {
            width:100%; padding:14px; border:none; border-radius:10px;
            background:#2f7cff; color:#fff; font-size:.95rem; font-weight:700;
            font-family:inherit; cursor:pointer; letter-spacing:.03em; transition:background .15s;
        }
        .btn-submit:hover { background:#1a6ae8; }

        .note { padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; }

        /* エラーバナー */
        .error-banner {
            background:#fff0f3; border:1px solid #ffc0cb; border-radius:8px;
            padding:12px 16px; font-size:.82rem; color:#c0003c;
        }
        .error-banner ul { margin-top:6px; padding-left:16px; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <div class="card__header-left">
            <a href="{{ route('property.confirm', $token) }}" class="card__back">
                ← 最新状態確認に戻る
            </a>
            <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">掲載承諾</div>
            <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
        </div>
    </div>
    <div class="card__body">

        @if($errors->any())
        <div class="error-banner">
            <strong>入力内容を確認してください</strong>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- 物件情報 --}}
        <div class="prop-summary">
            <span class="prop-summary__label">物件種類</span>
            <span class="prop-summary__value">{{ $property->typeLabel() }}</span>
            <span class="prop-summary__label">物件名称</span>
            <span class="prop-summary__value">{{ $property->title }}</span>
            <span class="prop-summary__label">価格</span>
            <span class="prop-summary__value prop-summary__value--price">{{ $property->priceFormatted() }}</span>
        </div>

        <form method="POST" action="{{ route('property.consent.store', $token) }}"
              enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:16px;">
            @csrf

            <div class="field">
                <label>お名前<span class="req">必須</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="山田 太郎" autocomplete="name">
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>電話番号<span class="req">必須</span></label>
                <input type="tel" name="phone" value="{{ old('phone') }}"
                       placeholder="090-0000-0000" autocomplete="tel">
                @error('phone')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>メールアドレス<span class="req">必須</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="example@email.com" autocomplete="email">
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>名刺<span class="opt">任意・JPG / PNG / PDF</span></label>
                <input type="file" name="business_card" id="business-card-input"
                       accept="image/*,application/pdf" style="display:none;"
                       onchange="onCardSelected(this)">
                <label for="business-card-input" class="file-label">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span id="file-label-name">ファイルを選択</span>
                </label>
                <img id="card-preview" class="file-preview" alt="名刺プレビュー">
                @error('business_card')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>広告宣伝の種類<span class="req">必須・複数選択可</span></label>
                <div class="ad-grid">
                    @php
                        $adOptions = [
                            'own_hp' => '自社HP',
                            'suumo'  => 'スーモ',
                            'homes'  => 'ホームズ',
                            'athome' => 'アットホーム',
                            'store'  => '店舗',
                        ];
                        $oldAds = old('ad_types', []);
                    @endphp
                    @foreach($adOptions as $val => $label)
                    <label class="ad-item">
                        <input type="checkbox" name="ad_types[]" value="{{ $val }}"
                               {{ in_array($val, $oldAds) ? 'checked' : '' }}>
                        <span class="ad-item__box"></span>
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
                @error('ad_types')<div class="error" style="margin-top:6px;">{{ $message }}</div>@enderror
            </div>

            <div class="privacy-row">
                <input type="checkbox" name="privacy" id="privacy" value="1"
                       {{ old('privacy') ? 'checked' : '' }}>
                <label for="privacy">
                    <a href="{{ route('privacy-policy') }}" target="_blank">プライバシーポリシー</a>に同意する
                </label>
            </div>
            @error('privacy')<div style="font-size:.75rem;color:#e53e3e;margin-top:-10px;">{{ $message }}</div>@enderror

            <button type="submit" class="btn-submit">掲載を承諾する</button>
        </form>

        <div class="note">
            このページは担当者が発行した確認用URLです。<br>
            ご入力いただいた情報は担当者にのみ共有されます。
        </div>
    </div>
</div>

<script>
    function onCardSelected(input) {
        var label = document.getElementById('file-label-name');
        var preview = document.getElementById('card-preview');
        if (input.files && input.files[0]) {
            var file = input.files[0];
            label.textContent = file.name;
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        } else {
            label.textContent = 'ファイルを選択';
            preview.style.display = 'none';
        }
    }
</script>
</body>
</html>
