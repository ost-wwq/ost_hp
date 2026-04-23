<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 広告掲載許可申請</title>
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

        /* 注意事項 */
        .consent-wrap { border:1px solid #e4e6f0; border-radius:10px; overflow:hidden; }
        .consent-wrap__title { padding:12px 16px; background:#f0f2f8; font-size:.82rem; font-weight:700; color:#334155; }
        .consent-wrap__scroll {
            height:220px; overflow-y:auto; padding:14px 16px;
            font-size:.78rem; color:#334155; line-height:1.75; background:#fff;
        }
        .consent-wrap__scroll::-webkit-scrollbar { width:4px; }
        .consent-wrap__scroll::-webkit-scrollbar-track { background:#f0f2f8; }
        .consent-wrap__scroll::-webkit-scrollbar-thumb { background:#c8cce0; border-radius:2px; }
        .consent-section-title { font-size:.73rem; font-weight:700; color:#2f7cff; margin:12px 0 6px; letter-spacing:.04em; }
        .consent-section-title:first-child { margin-top:0; }
        .consent-item { display:flex; gap:6px; margin-bottom:8px; }
        .consent-item:last-child { margin-bottom:0; }
        .consent-item strong { font-weight:700; }
        .agree-row {
            display:flex; align-items:flex-start; gap:10px;
            padding:12px 16px; background:#fff7ed; border-top:1px solid #fed7aa;
        }
        .agree-row input[type=checkbox] { margin-top:3px; flex-shrink:0; width:16px; height:16px; cursor:pointer; accent-color:#2f7cff; }
        .agree-row label { font-size:.82rem; font-weight:700; color:#334155; line-height:1.6; cursor:pointer; }


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
            <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">広告掲載許可申請</div>
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
                <label>担当者名<span class="req">必須</span></label>
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
                            'other'  => 'その他',
                        ];
                        $oldAds = old('ad_types', []);
                    @endphp
                    @foreach($adOptions as $val => $label)
                    <label class="ad-item">
                        @if($val === 'other')
                        <input type="checkbox" name="ad_types[]" value="{{ $val }}"
                               id="ad_other_check"
                               {{ in_array($val, $oldAds) ? 'checked' : '' }}>
                        @else
                        <input type="checkbox" name="ad_types[]" value="{{ $val }}"
                               {{ in_array($val, $oldAds) ? 'checked' : '' }}>
                        @endif
                        <span class="ad-item__box"></span>
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
                <div id="ad_other_wrap" style="margin-top:8px;display:{{ in_array('other', $oldAds) ? 'block' : 'none' }};">
                    <input type="text" name="ad_other_text" id="ad_other_text"
                        style="width:100%;padding:10px 14px;border:1px solid #e4e6f0;border-radius:8px;font-size:.95rem;font-family:inherit;outline:none;{{ $errors->has('ad_other_text') ? 'border-color:#e53e3e;' : '' }}"
                        value="{{ old('ad_other_text') }}"
                        placeholder="その他の広告媒体を入力してください"
                        maxlength="200">
                    @error('ad_other_text')<div class="error" style="margin-top:4px;">{{ $message }}</div>@enderror
                </div>
                @error('ad_types')<div class="error" style="margin-top:6px;">{{ $message }}</div>@enderror
                <script>
                    document.getElementById('ad_other_check').addEventListener('change', function() {
                        document.getElementById('ad_other_wrap').style.display = this.checked ? 'block' : 'none';
                        if (!this.checked) document.getElementById('ad_other_text').value = '';
                    });
                </script>
            </div>

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
            @error('ad_consent')<div style="font-size:.75rem;color:#e53e3e;margin-top:-10px;">{{ $message }}</div>@enderror

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
