<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲載承諾 | ワンステップテックス不動産</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue: #2f7cff;
            --orange: #f17c20;
            --teal: #4eba9a;
            --dark: #2b2d42;
            --text: #4a4a6a;
            --border: #e8e8f0;
            --bg: #f0f2f8;
        }
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background: var(--bg);
            color: var(--dark);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            padding: 0;
        }
        .header__inner {
            max-width: 720px;
            margin: 0 auto;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header__brand { display: flex; align-items: center; gap: 10px; color: #fff; }
        .header__brand-logo { font-size: 1.3rem; }
        .header__brand-name { font-size: .9rem; font-weight: 700; }

        /* Hero strip */
        .hero-strip {
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            padding: 0 0 40px;
        }
        .hero-strip__inner {
            max-width: 720px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .hero-strip h1 { font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 4px; }
        .hero-strip p { font-size: .82rem; color: rgba(255,255,255,.65); }

        /* Back link */
        .back-wrap {
            max-width: 720px;
            margin: 0 auto;
            padding: 20px 24px 0;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--blue);
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
        }
        .back-link:hover { text-decoration: underline; }

        /* Card */
        .card {
            max-width: 720px;
            margin: 20px auto 60px;
            padding: 0 24px;
        }
        .section {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 20px;
        }
        .section__title {
            font-size: .78rem;
            font-weight: 700;
            color: #9090b0;
            letter-spacing: .1em;
            text-transform: uppercase;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        /* Property info */
        .prop-info {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 10px 20px;
            font-size: .9rem;
        }
        .prop-info__label {
            color: #9090b0;
            font-size: .82rem;
            white-space: nowrap;
            padding-top: 2px;
        }
        .prop-info__value { font-weight: 500; color: var(--dark); }
        .prop-info__value--price { font-weight: 700; color: var(--blue); font-size: 1.05rem; }

        /* Form */
        .field { margin-bottom: 20px; }
        .field:last-child { margin-bottom: 0; }
        .field__label {
            display: block;
            font-size: .85rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }
        .field__label .required {
            display: inline-block;
            background: #ff4d6d;
            color: #fff;
            font-size: .7rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 4px;
            margin-left: 6px;
            vertical-align: middle;
        }
        .field__label .optional {
            display: inline-block;
            background: #e8e8f0;
            color: #9090b0;
            font-size: .7rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 4px;
            margin-left: 6px;
            vertical-align: middle;
        }
        .field__input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: .95rem;
            font-family: inherit;
            color: var(--dark);
            background: #fff;
            transition: border-color .2s;
            outline: none;
        }
        .field__input:focus { border-color: var(--blue); }
        .field__input.is-error { border-color: #ff4d6d; }
        .field__hint {
            font-size: .78rem;
            color: #9090b0;
            margin-top: 5px;
        }
        .field__error {
            font-size: .8rem;
            color: #ff4d6d;
            margin-top: 5px;
        }

        /* File upload */
        .file-upload {
            position: relative;
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .file-upload:hover { border-color: var(--blue); background: #f7f9ff; }
        .file-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }
        .file-upload__icon { font-size: 1.8rem; margin-bottom: 8px; }
        .file-upload__text { font-size: .88rem; color: #9090b0; }
        .file-upload__name { font-size: .85rem; color: var(--blue); font-weight: 600; margin-top: 6px; display: none; }

        /* Ad types checkboxes */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: border-color .2s, background .2s;
            font-size: .9rem;
            font-weight: 500;
        }
        .checkbox-item:hover { border-color: var(--blue); background: #f7f9ff; }
        .checkbox-item input[type="checkbox"] { display: none; }
        .checkbox-item__box {
            width: 18px;
            height: 18px;
            border: 1.5px solid #c0c0d0;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color .2s, background .2s;
        }
        .checkbox-item input:checked ~ .checkbox-item__box {
            background: var(--blue);
            border-color: var(--blue);
        }
        .checkbox-item input:checked ~ .checkbox-item__box::after {
            content: '';
            width: 5px;
            height: 9px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg) translate(-1px, -1px);
        }
        .checkbox-item input:checked + .checkbox-item__box { background: var(--blue); border-color: var(--blue); }
        .checkbox-item:has(input:checked) { border-color: var(--blue); background: #f0f5ff; }

        /* Privacy policy */
        .privacy-box {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 14px 16px;
            font-size: .82rem;
            color: var(--text);
            line-height: 1.7;
            max-height: 160px;
            overflow-y: auto;
            background: #fafafa;
            margin-bottom: 14px;
        }
        .privacy-agree {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: .9rem;
            font-weight: 500;
        }
        .privacy-agree input[type="checkbox"] { width: 18px; height: 18px; accent-color: var(--blue); cursor: pointer; }

        /* Submit */
        .submit-wrap { text-align: center; margin-top: 10px; }
        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 40px;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(47,124,255,.35);
            transition: opacity .2s, transform .1s;
        }
        .btn-submit:hover { opacity: .9; }
        .btn-submit:active { transform: scale(.98); }

        @media (max-width: 600px) {
            .checkbox-grid { grid-template-columns: repeat(2, 1fr); }
            .section { padding: 20px; }
        }
    </style>
</head>
<body>

<div class="header">
    <div class="header__inner">
        <div class="header__brand">
            <span class="header__brand-logo">🏠</span>
            <span class="header__brand-name">ワンステップテックス不動産</span>
        </div>
    </div>
</div>

<div class="hero-strip">
    <div class="hero-strip__inner">
        <h1>掲載承諾フォーム</h1>
        <p>物件情報の広告掲載にご同意いただく際にご利用ください</p>
    </div>
</div>

<div class="back-wrap">
    <a href="{{ route('broker.properties') }}" class="back-link">← 最新状態確認画面に戻る</a>
</div>

<div class="card">

    {{-- エラー表示 --}}
    @if($errors->any())
    <div style="background:#fff0f3;border:1px solid #ffc0cb;border-radius:12px;padding:16px 20px;margin-bottom:20px;font-size:.88rem;color:#c0003c;">
        <strong>入力内容にエラーがあります：</strong>
        <ul style="margin-top:8px;padding-left:18px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 物件情報 --}}
    <div class="section">
        <div class="section__title">物件情報</div>
        <div class="prop-info">
            <span class="prop-info__label">物件種類</span>
            <span class="prop-info__value">{{ $property->typeLabel() }}</span>
            <span class="prop-info__label">物件名称</span>
            <span class="prop-info__value">{{ $property->title }}</span>
            <span class="prop-info__label">価格</span>
            <span class="prop-info__value prop-info__value--price">{{ $property->priceFormatted() }}</span>
        </div>
    </div>

    {{-- 申請者情報 --}}
    <form method="POST" action="{{ route('broker.consent.store', $property) }}" enctype="multipart/form-data">
        @csrf

        <div class="section">
            <div class="section__title">申請者情報</div>

            <div class="field">
                <label class="field__label" for="name">お名前<span class="required">必須</span></label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    class="field__input{{ $errors->has('name') ? ' is-error' : '' }}"
                    value="{{ old('name') }}"
                    placeholder="例：山田 太郎"
                    autocomplete="name"
                >
                @error('name')<p class="field__error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field__label" for="phone">電話番号<span class="required">必須</span></label>
                <input
                    id="phone"
                    type="tel"
                    name="phone"
                    class="field__input{{ $errors->has('phone') ? ' is-error' : '' }}"
                    value="{{ old('phone') }}"
                    placeholder="例：090-1234-5678"
                    autocomplete="tel"
                >
                @error('phone')<p class="field__error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field__label" for="email">メールアドレス<span class="required">必須</span></label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="field__input{{ $errors->has('email') ? ' is-error' : '' }}"
                    value="{{ old('email') }}"
                    placeholder="例：yamada@example.com"
                    autocomplete="email"
                >
                @error('email')<p class="field__error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field__label">名刺<span class="optional">任意</span></label>
                <div class="file-upload" id="fileUploadArea">
                    <input type="file" name="business_card" accept=".jpg,.jpeg,.png,.pdf" id="businessCardInput">
                    <div class="file-upload__icon">📎</div>
                    <div class="file-upload__text">クリックまたはドラッグ＆ドロップ<br>JPG・PNG・PDF（最大5MB）</div>
                    <div class="file-upload__name" id="fileName"></div>
                </div>
                @error('business_card')<p class="field__error">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- 広告宣伝の種類 --}}
        <div class="section">
            <div class="section__title">広告宣伝の種類<span style="color:#ff4d6d;font-size:.8rem;margin-left:8px;font-weight:700;">必須（複数選択可）</span></div>

            <div class="checkbox-grid">
                @php
                    $adOptions = [
                        'own_hp'  => '自社HP',
                        'suumo'   => 'スーモ',
                        'homes'   => 'ホームズ',
                        'athome'  => 'アットホーム',
                        'store'   => '店舗',
                    ];
                    $oldAds = old('ad_types', []);
                @endphp
                @foreach($adOptions as $val => $label)
                <label class="checkbox-item">
                    <input type="checkbox" name="ad_types[]" value="{{ $val }}"
                        {{ in_array($val, $oldAds) ? 'checked' : '' }}>
                    <span class="checkbox-item__box"></span>
                    {{ $label }}
                </label>
                @endforeach
            </div>
            @error('ad_types')<p class="field__error" style="margin-top:10px;">{{ $message }}</p>@enderror
        </div>

        {{-- プライバシーポリシー --}}
        <div class="section">
            <div class="section__title">プライバシーポリシー</div>
            <div class="privacy-box">
                <strong>個人情報の取り扱いについて</strong><br><br>
                ワンステップテックス不動産（以下「当社」）は、掲載承諾フォームにてご提供いただいた個人情報（氏名・電話番号・メールアドレス・名刺等）を、以下の目的のために利用いたします。<br><br>
                <strong>利用目的：</strong><br>
                ・物件の広告掲載に関するご連絡<br>
                ・掲載内容の確認・調整<br>
                ・当社サービスのご案内<br><br>
                収集した個人情報は、法令に基づく場合を除き、ご本人の同意なく第三者に提供することはありません。個人情報の開示・訂正・削除等のお問い合わせは、当社窓口までご連絡ください。
            </div>
            <label class="privacy-agree">
                <input type="checkbox" name="privacy" value="1" {{ old('privacy') ? 'checked' : '' }}>
                プライバシーポリシーに同意します
            </label>
            @error('privacy')<p class="field__error" style="margin-top:8px;">{{ $message }}</p>@enderror
        </div>

        <div class="submit-wrap">
            <button type="submit" class="btn-submit">
                ✅ 掲載を承諾する
            </button>
        </div>

    </form>
</div>

<script>
    const input = document.getElementById('businessCardInput');
    const nameEl = document.getElementById('fileName');
    input.addEventListener('change', () => {
        if (input.files.length > 0) {
            nameEl.textContent = input.files[0].name;
            nameEl.style.display = 'block';
        } else {
            nameEl.style.display = 'none';
        }
    });
</script>

</body>
</html>
