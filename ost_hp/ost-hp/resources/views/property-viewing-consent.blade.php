<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 遵守事項承諾書</title>
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

        .preamble {
            font-size: .82rem;
            color: #334155;
            line-height: 1.75;
            padding: 14px 16px;
            background: #f8f9ff;
            border-radius: 8px;
        }

        .consent-section { border-top: 1px solid #f0f2f8; padding-top: 14px; }
        .consent-section__title {
            font-size: .78rem;
            font-weight: 700;
            color: #2f7cff;
            margin-bottom: 10px;
            letter-spacing: .04em;
        }
        .consent-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 10px;
            font-size: .8rem;
            color: #334155;
            line-height: 1.65;
        }
        .consent-item:last-child { margin-bottom: 0; }
        .consent-item::before {
            content: "・";
            flex-shrink: 0;
            color: #7b7b9a;
        }
        .consent-item strong { font-weight: 700; }

        .agree-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 8px;
        }
        .agree-row input[type=checkbox] { margin-top: 3px; flex-shrink: 0; width: 17px; height: 17px; cursor: pointer; }
        .agree-row label { font-size: .85rem; font-weight: 700; color: #334155; line-height: 1.6; cursor: pointer; }

        .btn-submit {
            width: 100%; padding: 14px; border: none; border-radius: 10px;
            background: #2f7cff; color: #fff; font-size: .95rem; font-weight: 700;
            font-family: inherit; cursor: pointer; letter-spacing: .03em;
            transition: background .15s;
        }
        .btn-submit:hover { background: #1a6ae8; }
        .error { font-size: .75rem; color: #e53e3e; margin-top: -10px; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">内見予約（ステップ 1/2）</div>
        <div style="font-size:1.1rem;font-weight:700;">物件内見に関する遵守事項承諾書</div>
        <div style="font-size:.82rem;color:#7b7b9a;margin-top:4px;">{{ $property->title }}</div>
    </div>
    <div class="card__body">

        <div class="preamble">
            貴社が管理、または媒介する物件の内見にあたり、下記事項を確認・遵守することを承諾いたします。本承諾の効力は、送信をもって発生し、内見が完了するまで継続するものとします。
        </div>

        <div class="consent-section">
            <div class="consent-section__title">【施設保護・安全管理】</div>
            <div class="consent-item">
                <span><strong>現状有姿の維持：</strong>物件内の設備、建具、備品等に損傷・汚損を与えないよう細心の注意を払い、万が一損傷させた場合は、直ちに貴社へ報告し、その復旧費用を負担します。</span>
            </div>
            <div class="consent-item">
                <span><strong>土足厳禁・衛生管理：</strong>室内では必ずスリッパを着用し、素足での入室は控えます。また、新築物件等の場合は貴社の指示に従い、手袋・養生材を使用します。</span>
            </div>
            <div class="consent-item">
                <span><strong>水回り・火気使用の禁止：</strong>トイレ、洗面、キッチン等の水栓利用、およびバルコニーを含む敷地内での喫煙・火気使用を一切行いません。</span>
            </div>
            <div class="consent-item">
                <span><strong>施錠・消灯の徹底：</strong>退出時は、全ての窓（クレセント錠含む）および玄関扉の施錠、照明の消灯を責任持って確認します。</span>
            </div>
        </div>

        <div class="consent-section">
            <div class="consent-section__title">【プライバシー・情報保持】</div>
            <div class="consent-item">
                <span><strong>撮影およびSNS利用の制限：</strong>室内外の撮影は検討目的に限定し、家主の許可なくSNSやインターネット等へ公開しません。特に居住中物件の場合、所有者の私物や特定につながる情報の撮影は行いません。</span>
            </div>
            <div class="consent-item">
                <span><strong>近隣配慮：</strong>共用部や近隣での大声、迷惑駐車、ポイ捨て等、近隣住民の安寧を妨げる行為をいたしません。</span>
            </div>
        </div>

        <div class="consent-section">
            <div class="consent-section__title">【権利・賠償責任】</div>
            <div class="consent-item">
                <span><strong>損害賠償：</strong>内見中に生じた事故、盗難、汚損等について、私（および同伴者）の過失による場合は、法的責任を負うことを承諾します。</span>
            </div>
            <div class="consent-item">
                <span><strong>直接交渉の禁止：</strong>本内見を通じて知った物件所有者に対し、貴社を介さず直接の契約交渉を行う行為（いわゆる「抜き」行為）を行いません。</span>
            </div>
        </div>

        <form method="POST" action="{{ route('property.viewing.agree', $property->viewing_token) }}"
              style="display:flex;flex-direction:column;gap:14px;">
            @csrf

            <div class="agree-row">
                <input type="checkbox" name="viewing_consent" id="viewing_consent" value="1"
                       {{ old('viewing_consent') ? 'checked' : '' }}>
                <label for="viewing_consent">上記すべての遵守事項を確認し、同意します</label>
            </div>
            @error('viewing_consent')<div class="error">{{ $message }}</div>@enderror

            <button type="submit" class="btn-submit">同意して予約フォームへ進む</button>
        </form>

    </div>
</div>
</body>
</html>
