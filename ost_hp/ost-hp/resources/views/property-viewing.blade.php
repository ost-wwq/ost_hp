<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 内見予約</title>
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
        .card__body { padding: 24px; display: flex; flex-direction: column; gap: 18px; }
        .field label { display:block; font-size:.8rem; font-weight:700; color:#334155; margin-bottom:6px; }
        .field label .req { color:#e53e3e; margin-left:4px; font-size:.72rem; }
        .field input[type=text],
        .field input[type=tel],
        .field input[type=email] {
            width:100%; padding:10px 14px; border:1px solid #e4e6f0; border-radius:8px;
            font-size:.95rem; font-family:inherit; outline:none; transition:border-color .15s;
        }
        .field input:focus { border-color:#2f7cff; }
        .field .error { font-size:.75rem; color:#e53e3e; margin-top:4px; }
        .datetime-grid {
            display:grid; grid-template-columns:1fr 1fr; gap:10px;
        }
        @media (max-width: 480px) {
            .datetime-grid { grid-template-columns:1fr; }
        }
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
        .privacy-row {
            display:flex; align-items:flex-start; gap:10px;
            padding:14px 16px; background:#f8f9ff; border-radius:8px;
        }
        .privacy-row input[type=checkbox] { margin-top:2px; flex-shrink:0; width:16px; height:16px; cursor:pointer; }
        .privacy-row label { font-size:.82rem; color:#334155; line-height:1.6; cursor:pointer; }
        .privacy-row a { color:#2f7cff; text-decoration:underline; }
        .consent-wrap {
            border: 1px solid #e4e6f0;
            border-radius: 10px;
            overflow: hidden;
        }
        .consent-wrap__title {
            padding: 12px 16px;
            background: #f0f2f8;
            font-size: .82rem;
            font-weight: 700;
            color: #334155;
        }
        .consent-wrap__scroll {
            height: 220px;
            overflow-y: auto;
            padding: 14px 16px;
            font-size: .78rem;
            color: #334155;
            line-height: 1.75;
            background: #fff;
        }
        .consent-wrap__scroll::-webkit-scrollbar { width: 4px; }
        .consent-wrap__scroll::-webkit-scrollbar-track { background: #f0f2f8; }
        .consent-wrap__scroll::-webkit-scrollbar-thumb { background: #c8cce0; border-radius: 2px; }
        .consent-section-title {
            font-size: .73rem;
            font-weight: 700;
            color: #2f7cff;
            margin: 12px 0 6px;
            letter-spacing: .04em;
        }
        .consent-section-title:first-child { margin-top: 0; }
        .consent-item {
            display: flex;
            gap: 6px;
            margin-bottom: 8px;
        }
        .consent-item:last-child { margin-bottom: 0; }
        .consent-item::before { content: "・"; flex-shrink: 0; color: #7b7b9a; }
        .consent-item strong { font-weight: 700; }
        .agree-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 16px;
            background: #fff7ed;
            border-top: 1px solid #fed7aa;
        }
        .agree-row input[type=checkbox] { margin-top: 3px; flex-shrink: 0; width: 16px; height: 16px; cursor: pointer; }
        .agree-row label { font-size: .82rem; font-weight: 700; color: #334155; line-height: 1.6; cursor: pointer; }

        .btn-submit {
            width:100%; padding:14px; border:none; border-radius:10px;
            background:#2f7cff; color:#fff; font-size:.95rem; font-weight:700;
            font-family:inherit; cursor:pointer; letter-spacing:.03em;
            transition:background .15s;
        }
        .btn-submit:hover { background:#1a6ae8; }
        .note { padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">内見予約</div>
        <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
    </div>
    <div class="card__body">

        <div class="note">
            内見をご希望の方は、以下のフォームにご入力ください。<br>
            ご入力後にキーボックス情報をご案内いたします。
        </div>

        <form method="POST" action="{{ route('property.viewing.store', $property->viewing_token) }}"
              enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:16px;">
            @csrf

            <div class="field">
                <label>案内担当者名<span class="req">必須</span></label>
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
                <label>予約日時<span class="req">必須</span></label>
                <div class="datetime-grid">
                    <div>
                        <input type="date" name="reserved_date" value="{{ old('reserved_date') }}"
                               min="{{ date('Y-m-d') }}"
                               style="width:100%;padding:10px 14px;border:1px solid #e4e6f0;border-radius:8px;font-size:.95rem;font-family:inherit;outline:none;">
                        @error('reserved_date')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <select name="reserved_time"
                                style="width:100%;padding:10px 14px;border:1px solid #e4e6f0;border-radius:8px;font-size:.95rem;font-family:inherit;outline:none;background:#fff;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237b7b9a' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;">
                            <option value="">時間を選択</option>
                            @php
                                for ($h = 9; $h <= 19; $h++) {
                                    $times[] = sprintf('%02d:00', $h);
                                    if ($h < 19) $times[] = sprintf('%02d:30', $h);
                                }
                            @endphp
                            @foreach($times as $t)
                                <option value="{{ $t }}" {{ old('reserved_time') === $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                        @error('reserved_time')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label>同伴者人数<span class="req">必須</span></label>
                <select name="companions"
                        style="width:100%;padding:10px 14px;border:1px solid #e4e6f0;border-radius:8px;font-size:.95rem;font-family:inherit;outline:none;background:#fff;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237b7b9a' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;">
                    <option value="">人数を選択</option>
                    @for ($i = 0; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('companions') == $i && old('companions') !== null ? 'selected' : '' }}>
                            {{ $i }}人
                        </option>
                    @endfor
                </select>
                @error('companions')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>名刺<span style="font-size:.72rem;color:#7b7b9a;margin-left:4px;">任意・JPG / PNG / PDF</span></label>
                <input type="file" name="business_card" id="business-card-input"
                       accept="image/*,application/pdf" style="display:none;"
                       onchange="onCardSelected(this)">
                <label for="business-card-input" class="file-label" id="file-label-text">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span id="file-label-name">ファイルを選択</span>
                </label>
                <img id="card-preview" class="file-preview" alt="名刺プレビュー">
                @error('business_card')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="consent-wrap">
                <div class="consent-wrap__title">物件内見に関する遵守事項承諾書</div>
                <div class="consent-wrap__scroll">
                    <p style="margin-bottom:10px;">貴社が管理、または媒介する物件の内見にあたり、下記事項を確認・遵守することを承諾いたします。本承諾の効力は、送信をもって発生し、内見が完了するまで継続するものとします。</p>

                    <div class="consent-section-title">【施設保護・安全管理】</div>
                    <div class="consent-item"><span><strong>現状有姿の維持：</strong>物件内の設備、建具、備品等に損傷・汚損を与えないよう細心の注意を払い、万が一損傷させた場合は、直ちに貴社へ報告し、その復旧費用を負担します。</span></div>
                    <div class="consent-item"><span><strong>土足厳禁・衛生管理：</strong>室内では必ずスリッパを着用し、素足での入室は控えます。また、新築物件等の場合は貴社の指示に従い、手袋・養生材を使用します。</span></div>
                    <div class="consent-item"><span><strong>水回り・火気使用の禁止：</strong>トイレ、洗面、キッチン等の水栓利用、およびバルコニーを含む敷地内での喫煙・火気使用を一切行いません。</span></div>
                    <div class="consent-item"><span><strong>施錠・消灯の徹底：</strong>退出時は、全ての窓（クレセント錠含む）および玄関扉の施錠、照明の消灯を責任持って確認します。</span></div>

                    <div class="consent-section-title">【プライバシー・情報保持】</div>
                    <div class="consent-item"><span><strong>撮影およびSNS利用の制限：</strong>室内外の撮影は検討目的に限定し、家主の許可なくSNSやインターネット等へ公開しません。特に居住中物件の場合、所有者の私物や特定につながる情報の撮影は行いません。</span></div>
                    <div class="consent-item"><span><strong>近隣配慮：</strong>共用部や近隣での大声、迷惑駐車、ポイ捨て等、近隣住民の安寧を妨げる行為をいたしません。</span></div>

                    <div class="consent-section-title">【権利・賠償責任】</div>
                    <div class="consent-item"><span><strong>損害賠償：</strong>内見中に生じた事故、盗難、汚損等について、私（および同伴者）の過失による場合は、法的責任を負うことを承諾します。</span></div>
                    <div class="consent-item"><span><strong>直接交渉の禁止：</strong>本内見を通じて知った物件所有者に対し、貴社を介さず直接の契約交渉を行う行為（いわゆる「抜き」行為）を行いません。</span></div>
                </div>
                <div class="agree-row">
                    <input type="checkbox" name="viewing_consent" id="viewing_consent" value="1"
                           {{ old('viewing_consent') ? 'checked' : '' }}>
                    <label for="viewing_consent">上記すべての遵守事項を確認し、同意します</label>
                </div>
            </div>
            @error('viewing_consent')<div style="font-size:.75rem;color:#e53e3e;margin-top:-10px;">{{ $message }}</div>@enderror

            <div class="consent-wrap">
                <div class="consent-wrap__title">プライバシーポリシー</div>
                <div class="consent-wrap__scroll">
                    <p style="margin-bottom:10px;">当社は、お客様の個人情報の保護を重要な社会的責務と認識し、関係法令・ガイドラインを遵守するとともに、適切な管理・利用に努めます。</p>

                    <div class="consent-section-title">取得する個人情報</div>
                    <p style="margin-bottom:6px;">当社は、内見予約申し込みにあたり、以下の個人情報を取得します。</p>
                    <div class="consent-item"><span>お名前</span></div>
                    <div class="consent-item"><span>電話番号</span></div>
                    <div class="consent-item"><span>メールアドレス</span></div>
                    <div class="consent-item"><span>名刺（ファイルアップロードいただいた場合）</span></div>

                    <div class="consent-section-title">利用目的</div>
                    <p style="margin-bottom:6px;">取得した個人情報は、以下の目的に限り利用します。</p>
                    <div class="consent-item"><span>内見予約の受付・管理および担当者からのご連絡</span></div>
                    <div class="consent-item"><span>物件に関するご案内・サービスのご提供</span></div>
                    <div class="consent-item"><span>法令に基づく対応</span></div>

                    <div class="consent-section-title">第三者への提供</div>
                    <p style="margin-bottom:6px;">当社は、以下の場合を除き、取得した個人情報を第三者に提供しません。</p>
                    <div class="consent-item"><span>お客様ご本人の同意がある場合</span></div>
                    <div class="consent-item"><span>法令に基づき開示が必要な場合</span></div>
                    <div class="consent-item"><span>人の生命・身体・財産の保護のために必要な場合</span></div>

                    <div class="consent-section-title">個人情報の管理</div>
                    <p style="margin-bottom:10px;">当社は、個人情報への不正アクセス・紛失・破損・改ざん・漏洩を防止するため、適切な安全管理措置を講じます。また、個人情報の取り扱いを委託する場合は、委託先に対して適切な監督を行います。</p>

                    <div class="consent-section-title">個人情報の開示・訂正・削除</div>
                    <p style="margin-bottom:10px;">お客様は、ご自身の個人情報について開示・訂正・追加・削除・利用停止をご請求いただけます。ご請求の際は、担当者までお問い合わせください。なお、ご本人であることを確認させていただいたうえで対応いたします。</p>

                    <div class="consent-section-title">Cookie・アクセス解析</div>
                    <p style="margin-bottom:10px;">当サイトは、サービス改善を目的としてCookieおよびアクセス解析ツールを使用する場合があります。これらにより個人を特定できる情報を収集することはありません。</p>

                    <div class="consent-section-title">プライバシーポリシーの変更</div>
                    <p>本ポリシーは、法令の改正やサービス内容の変更に応じて改定する場合があります。改定後のポリシーは本ページに掲載した時点から効力を生じます。</p>
                </div>
                <div class="agree-row">
                    <input type="checkbox" name="privacy" id="privacy" value="1"
                           {{ old('privacy') ? 'checked' : '' }}>
                    <label for="privacy">プライバシーポリシーに同意する</label>
                </div>
            </div>
            @error('privacy')<div style="font-size:.75rem;color:#e53e3e;margin-top:-10px;">{{ $message }}</div>@enderror

            <button type="submit" class="btn-submit">内見予約を申し込む</button>
        </form>

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
