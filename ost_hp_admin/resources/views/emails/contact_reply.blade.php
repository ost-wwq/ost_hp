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
        .reply-box { background:#f8f9ff; border-left:4px solid #2f7cff; border-radius:4px; padding:16px 20px; margin:20px 0; line-height:1.8; white-space:pre-wrap; font-size:.9rem; }
        .divider { border:none; border-top:1px solid #e8e8f0; margin:24px 0; }
        .original-label { font-size:.78rem; font-weight:700; color:#9090b0; letter-spacing:.05em; text-transform:uppercase; margin-bottom:12px; }
        .original-box { background:#f8f9ff; border:1px solid #e4e6f0; border-radius:8px; padding:16px; font-size:.82rem; color:#7b7b9a; line-height:1.7; }
        .original-box dl { margin:0; }
        .original-box dt { font-weight:700; color:#4a4a6a; display:inline; }
        .original-box dd { display:inline; margin:0; }
        .original-box .msg { margin-top:12px; white-space:pre-wrap; border-top:1px solid #e4e6f0; padding-top:12px; }
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
        <p class="greeting">{{ $contact->name }} 様</p>

        <p style="font-size:.9rem;line-height:1.8;margin-bottom:20px;">
            お問い合わせいただきありがとうございます。<br>
            以下の通りご返信申し上げます。
        </p>

        <div class="reply-box">{{ $reply->body }}</div>

        <hr class="divider">

        <div class="original-label">元のお問い合わせ内容</div>
        <div class="original-box">
            <dl>
                <dt>件名：</dt>
                <dd>{{ $contact->subject ?: '（件名なし）' }}</dd>
            </dl>
            <dl>
                <dt>受信日時：</dt>
                <dd>{{ $contact->created_at->format('Y年m月d日 H:i') }}</dd>
            </dl>
            <div class="msg">{{ $contact->message }}</div>
        </div>
    </div>
    <div class="footer">
        〒 ワンステップテックス不動産<br>
        このメールはお問い合わせへの返信です。ご不明な点はご返信ください。
    </div>
</div>
</body>
</html>
