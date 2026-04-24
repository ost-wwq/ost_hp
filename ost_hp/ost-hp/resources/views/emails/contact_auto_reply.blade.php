<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', sans-serif; background:#f0f2f8; margin:0; padding:24px; color:#2b2d42; }
        .wrap { max-width:600px; margin:0 auto; }
        .header { background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%); border-radius:12px 12px 0 0; padding:28px 32px; text-align:center; }
        .header__logo { font-size:1.8rem; margin-bottom:6px; }
        .header__name { color:#fff; font-size:.95rem; font-weight:700; opacity:.9; }
        .body { background:#fff; padding:32px; border-radius:0 0 12px 12px; }
        .greeting { font-size:1rem; font-weight:700; margin-bottom:20px; }
        .message { font-size:.9rem; line-height:1.8; margin-bottom:24px; }
        .divider { border:none; border-top:1px solid #e8e8f0; margin:24px 0; }
        .section-label { font-size:.78rem; font-weight:700; color:#9090b0; letter-spacing:.05em; text-transform:uppercase; margin-bottom:12px; }
        .detail-box { background:#f8f9ff; border:1px solid #e4e6f0; border-radius:8px; padding:16px 20px; font-size:.88rem; line-height:1.8; }
        .detail-row { display:flex; gap:12px; margin-bottom:8px; }
        .detail-row:last-child { margin-bottom:0; }
        .detail-label { font-weight:700; color:#4a4a6a; min-width:80px; flex-shrink:0; }
        .detail-value { color:#2b2d42; }
        .message-content { margin-top:12px; padding-top:12px; border-top:1px solid #e4e6f0; white-space:pre-wrap; color:#2b2d42; }
        .note { background:#f0f7ff; border-left:4px solid #2f7cff; border-radius:4px; padding:14px 16px; font-size:.82rem; line-height:1.7; color:#4a4a7a; margin-top:24px; }
        .footer { text-align:center; font-size:.75rem; color:#b0b0c8; margin-top:24px; line-height:1.7; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="header__logo">🏠</div>
        <div class="header__name">ワンステップテックス不動産</div>
    </div>
    <div class="body">
        <p class="greeting">{{ $data['name'] }} 様</p>

        <p class="message">
            この度はワンステップテックス不動産へのお問い合わせありがとうございます。<br>
            以下の内容でお問い合わせを受け付けいたしました。<br><br>
            担当者より改めてご連絡させていただきます。<br>
            しばらくお待ちいただきますようお願い申し上げます。
        </p>

        <hr class="divider">

        <div class="section-label">お問い合わせ内容</div>
        <div class="detail-box">
            <div class="detail-row">
                <span class="detail-label">お名前</span>
                <span class="detail-value">{{ $data['name'] }} 様</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">メール</span>
                <span class="detail-value">{{ $data['email'] }}</span>
            </div>
            @if(!empty($data['subject']))
            <div class="detail-row">
                <span class="detail-label">件名</span>
                <span class="detail-value">{{ $data['subject'] }}</span>
            </div>
            @endif
            <div class="message-content">{{ $data['message'] }}</div>
        </div>

        <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e4e6f0;font-size:.82rem;color:#4a4a6a;line-height:2;">
            ────────────────────────────────────<br>
            株式会社ワンステップテックス<br>
            埼玉知事(1)第25759号<br>
            TEL：090-8506-0043<br>
            FAX：048-458-0527<br>
            E-mail：<a href="mailto:info@house.onesteptechs.com" style="color:#1a4cbd;">info@house.onesteptechs.com</a><br>
            WebPage：<a href="https://www.house.onesteptechs.com" style="color:#1a4cbd;">https://www.house.onesteptechs.com</a><br>
            ────────────────────────────────────
        </div>

        <div class="note">
            ※ このメールは自動送信です。ご返信いただいても対応できない場合がございます。<br>
            お急ぎの場合は、直接 <a href="mailto:info@house.onesteptechs.com" style="color:#2f7cff;">info@house.onesteptechs.com</a> までご連絡ください。
        </div>
    </div>
    <div class="footer">
        ワンステップテックス不動産<br>
        &copy; {{ date('Y') }} house.onesteptechs.com. All rights reserved.
    </div>
</div>
</body>
</html>
