<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<style>
body { font-family: 'Hiragino Kaku Gothic ProN', 'Noto Sans JP', sans-serif; background:#f0f2f8; margin:0; padding:32px 16px; }
.wrap { max-width:480px; margin:0 auto; background:#fff; border-radius:12px; padding:32px; }
.title { font-size:1.1rem; font-weight:700; color:#2b2d42; margin-bottom:16px; }
.code-box { background:#f0f5ff; border:2px solid #2f7cff; border-radius:10px; padding:20px; text-align:center; margin:24px 0; }
.code { font-size:2.4rem; font-weight:700; color:#2f7cff; letter-spacing:.25em; }
.note { font-size:.82rem; color:#7b7b9a; line-height:1.7; }
</style>
</head>
<body>
<div class="wrap">
    <p class="title">認証コードのご案内</p>
    <p style="font-size:.9rem;color:#334155;line-height:1.7;">
        「{{ $propertyTitle }}」の内見予約・広告掲載許可申請の確認をご要求いただきました。<br>
        以下の認証コードを入力してください。
    </p>
    <div class="code-box">
        <div class="code">{{ $code }}</div>
    </div>
    <p class="note">
        ・このコードは10分間有効です。<br>
        ・お心当たりのない場合は、このメールを無視してください。
    </p>

    <div style="margin-top:24px;padding-top:16px;border-top:1px solid #e4e6f0;font-size:.82rem;color:#4a4a6a;line-height:2;">
        ────────────────────────────────────<br>
        株式会社ワンステップテックス<br>
        埼玉知事(1)第25759号<br>
        TEL：090-8506-0043<br>
        FAX：048-458-0527<br>
        E-mail：<a href="mailto:info@house.onesteptechs.com" style="color:#1a4cbd;">info@house.onesteptechs.com</a><br>
        WebPage：<a href="https://www.house.onesteptechs.com" style="color:#1a4cbd;">https://www.house.onesteptechs.com</a><br>
        ────────────────────────────────────
    </div>
</div>
</body>
</html>
