<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>広告掲載許可申請 | ワンステップテックス不動産</title>
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

        /* 注意事項 */
        .consent-wrap { border: 1px solid var(--border); border-radius: 10px; overflow: hidden; }
        .consent-wrap__title { padding: 12px 16px; background: #f0f2f8; font-size: .82rem; font-weight: 700; color: #334155; }
        .consent-wrap__scroll {
            height: 220px; overflow-y: auto; padding: 14px 16px;
            font-size: .78rem; color: #334155; line-height: 1.75; background: #fff;
        }
        .consent-wrap__scroll::-webkit-scrollbar { width: 4px; }
        .consent-wrap__scroll::-webkit-scrollbar-track { background: #f0f2f8; }
        .consent-wrap__scroll::-webkit-scrollbar-thumb { background: #c8cce0; border-radius: 2px; }
        .consent-section-title { font-size: .73rem; font-weight: 700; color: var(--blue); margin: 12px 0 6px; letter-spacing: .04em; }
        .consent-section-title:first-child { margin-top: 0; }
        .consent-item { display: flex; gap: 6px; margin-bottom: 8px; }
        .consent-item:last-child { margin-bottom: 0; }
        .consent-item strong { font-weight: 700; }
        .agree-row {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 16px; background: #fff7ed; border-top: 1px solid #fed7aa;
        }
        .agree-row input[type=checkbox] { margin-top: 3px; flex-shrink: 0; width: 16px; height: 16px; cursor: pointer; accent-color: var(--blue); }
        .agree-row label { font-size: .82rem; font-weight: 700; color: #334155; line-height: 1.6; cursor: pointer; }


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
        <h1>広告掲載許可申請フォーム</h1>
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
                <label class="field__label" for="name">担当者名<span class="required">必須</span></label>
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
                        'other'   => 'その他',
                    ];
                    $oldAds = old('ad_types', []);
                @endphp
                @foreach($adOptions as $val => $label)
                <label class="checkbox-item">
                    @if($val === 'other')
                    <input type="checkbox" name="ad_types[]" value="{{ $val }}"
                        id="ad_other_check"
                        {{ in_array($val, $oldAds) ? 'checked' : '' }}>
                    @else
                    <input type="checkbox" name="ad_types[]" value="{{ $val }}"
                        {{ in_array($val, $oldAds) ? 'checked' : '' }}>
                    @endif
                    <span class="checkbox-item__box"></span>
                    {{ $label }}
                </label>
                @endforeach
            </div>
            <div id="ad_other_wrap" style="margin-top:10px;display:{{ in_array('other', $oldAds) ? 'block' : 'none' }};">
                <input type="text" name="ad_other_text" id="ad_other_text"
                    class="field__input{{ $errors->has('ad_other_text') ? ' is-error' : '' }}"
                    value="{{ old('ad_other_text') }}"
                    placeholder="その他の広告媒体を入力してください"
                    maxlength="200">
                @error('ad_other_text')<p class="field__error">{{ $message }}</p>@enderror
            </div>
            @error('ad_types')<p class="field__error" style="margin-top:10px;">{{ $message }}</p>@enderror
            <script>
                document.getElementById('ad_other_check').addEventListener('change', function() {
                    document.getElementById('ad_other_wrap').style.display = this.checked ? 'block' : 'none';
                    if (!this.checked) document.getElementById('ad_other_text').value = '';
                });
            </script>
        </div>

        {{-- 注意事項 --}}
        <div class="section">
            <div class="section__title">注意事項</div>
            <div class="consent-wrap">
                <div class="consent-wrap__title">広告掲載に関する注意事項</div>
                <div class="consent-wrap__scroll">
                    <div class="consent-section-title">1. 弊社都合による掲載停止について（重要項目）</div>
                    <div class="consent-item"><span><strong>掲載の中止・変更：</strong>弊社の判断（専任媒介契約への切り替え、オーナー意向の変更、成約、または管理上の理由等）により、事前の通知なく広告掲載の停止または掲載内容の変更を要請、あるいはシステム上で公開を停止する場合があります。</span></div>
                    <div class="consent-item"><span><strong>即時取り下げの義務：</strong>弊社より掲載停止の通知（システム通知またはメール）があった際は、速やかにポータルサイトおよび自社サイトからの取り下げ作業を行ってください。</span></div>
                    <div class="consent-item"><span><strong>免責事項：</strong>掲載停止に伴い仲介会社様に生じた損害（広告費、入力作業代、反響喪失等）について、弊社は一切の責任を負いかねます。</span></div>

                    <div class="consent-section-title">2. その他の基本ルール</div>
                    <div class="consent-item"><span><strong>おとり広告の禁止：</strong>成約済み物件の掲載継続は固く禁じます。弊社から成約通知があった場合、またはシステム上のステータスが「成約」となった場合は、直ちに掲載を終了してください。</span></div>
                    <div class="consent-item"><span><strong>表記の正確性：</strong>広告内容は弊社提供の資料に基づき、正確に表記してください。現状と図面・情報が異なる場合は「現況優先」となります。</span></div>
                    <div class="consent-item"><span><strong>直接交渉の禁止：</strong>本物件の掲載を通じて、オーナー様（貸主・売主）への直接の交渉や営業活動を行うことを禁じます。</span></div>
                </div>
                <div class="agree-row">
                    <input type="checkbox" name="ad_consent" id="ad_consent" value="1"
                           {{ old('ad_consent') ? 'checked' : '' }}>
                    <label for="ad_consent">上記の注意事項をすべて確認し、同意します</label>
                </div>
            </div>
            @error('ad_consent')<p class="field__error" style="margin-top:8px;">{{ $message }}</p>@enderror
        </div>

        {{-- プライバシーポリシー --}}
        <div class="section">
            <div class="section__title">プライバシーポリシー</div>
            <div class="consent-wrap">
                <div class="consent-wrap__title">プライバシーポリシー</div>
                <div class="consent-wrap__scroll">
                    <p style="margin-bottom:10px;">当社は、お客様の個人情報の保護を重要な社会的責務と認識し、関係法令・ガイドラインを遵守するとともに、適切な管理・利用に努めます。</p>

                    <div class="consent-section-title">取得する個人情報</div>
                    <p style="margin-bottom:6px;">当社は、広告掲載許可申請にあたり、以下の個人情報を取得します。</p>
                    <div class="consent-item"><span>担当者名</span></div>
                    <div class="consent-item"><span>電話番号</span></div>
                    <div class="consent-item"><span>メールアドレス</span></div>
                    <div class="consent-item"><span>名刺（ファイルアップロードいただいた場合）</span></div>

                    <div class="consent-section-title">利用目的</div>
                    <p style="margin-bottom:6px;">取得した個人情報は、以下の目的に限り利用します。</p>
                    <div class="consent-item"><span>物件の広告掲載に関するご連絡・管理</span></div>
                    <div class="consent-item"><span>掲載内容の確認・調整</span></div>
                    <div class="consent-item"><span>法令に基づく対応</span></div>

                    <div class="consent-section-title">第三者への提供</div>
                    <p style="margin-bottom:6px;">当社は、以下の場合を除き、取得した個人情報を第三者に提供しません。</p>
                    <div class="consent-item"><span>お客様ご本人の同意がある場合</span></div>
                    <div class="consent-item"><span>法令に基づき開示が必要な場合</span></div>
                    <div class="consent-item"><span>人の生命・身体・財産の保護のために必要な場合</span></div>

                    <div class="consent-section-title">個人情報の管理</div>
                    <p style="margin-bottom:10px;">当社は、個人情報への不正アクセス・紛失・破損・改ざん・漏洩を防止するため、適切な安全管理措置を講じます。</p>

                    <div class="consent-section-title">個人情報の開示・訂正・削除</div>
                    <p>お客様は、ご自身の個人情報について開示・訂正・追加・削除・利用停止をご請求いただけます。ご請求の際は、担当者までお問い合わせください。</p>
                </div>
                <div class="agree-row">
                    <input type="checkbox" name="privacy" id="privacy" value="1"
                           {{ old('privacy') ? 'checked' : '' }}>
                    <label for="privacy">プライバシーポリシーに同意する</label>
                </div>
            </div>
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
