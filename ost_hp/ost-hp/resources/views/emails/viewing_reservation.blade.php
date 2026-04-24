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
        .body { background:#fff; padding:32px; border-radius:0 0 12px 12px; font-size:.9rem; line-height:1.9; }
        .greeting { font-weight:700; margin-bottom:20px; }
        .message { margin-bottom:24px; }
        .section { margin-bottom:20px; }
        .section-title { font-weight:700; border-bottom:1px solid #e8e8f0; padding-bottom:6px; margin-bottom:10px; }
        .detail-table { width:100%; border-collapse:collapse; }
        .detail-table td { padding:6px 0; vertical-align:top; }
        .detail-table td:first-child { white-space:nowrap; padding-right:16px; color:#4a4a6a; font-weight:700; width:120px; }
        .caution { background:#fff8e1; border-left:4px solid #f59e0b; border-radius:4px; padding:12px 16px; font-size:.85rem; line-height:1.8; color:#5a4500; margin-bottom:24px; }
        .caution ul { margin:6px 0 0 0; padding-left:1.2em; }
        .highlight { font-weight:700; color:#1a4cbd; }
        .note { font-size:.8rem; color:#9090b0; margin-top:24px; }
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
        <p class="greeting">{{ $reservation->name }} 様</p>
        <p class="note">※ 本メールはシステムより自動送信されています。</p>

        <p class="message">
            お世話になっております。<br>
            ワンステップテックス不動産 運営事務局です。<br><br>
            内見予約を受け付けました。以下の内容をご確認ください。
        </p>

        <div class="section">
            <div class="section-title">■ 予約内容</div>
            <table class="detail-table">
                <tr>
                    <td>物件名</td>
                    <td>{{ $reservation->property->title }}</td>
                </tr>
                <tr>
                    <td>予約日時</td>
                    <td class="highlight">{{ \Carbon\Carbon::parse($reservation->reserved_date)->format('Y年n月j日') }}（{{ ['日','月','火','水','木','金','土'][\Carbon\Carbon::parse($reservation->reserved_date)->dayOfWeek] }}）{{ $reservation->reserved_time }}</td>
                </tr>
                <tr>
                    <td>案内担当者名</td>
                    <td>{{ $reservation->name }}</td>
                </tr>
                <tr>
                    <td>電話番号</td>
                    <td>{{ $reservation->phone }}</td>
                </tr>
                <tr>
                    <td>同伴者人数</td>
                    <td>{{ $reservation->companions }}名</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">■ 予約完了ページ</div>
            <p style="margin:0">キーボックスの番号・開け方など、当日の詳細は以下のページでご確認ください。</p>
            <p style="margin:12px 0 0;"><a href="{{ $completeUrl }}" style="color:#1a4cbd; word-break:break-all;">{{ $completeUrl }}</a></p>
        </div>

        <div class="caution">
            <strong>■ ご注意事項</strong>
            <ul>
                <li>予約のキャンセル・変更は、お電話にてご連絡ください。</li>
                <li>当日は時間厳守でお越しください。</li>
                <li>内見時は遵守事項承諾書の内容をお守りください。</li>
            </ul>
        </div>

        <p class="message">
            ご不明な点がございましたら、お気軽にお問い合わせください。<br>
            どうぞよろしくお願い申し上げます。
        </p>

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

    </div>
    <div class="footer">
        ワンステップテックス不動産<br>
        &copy; {{ date('Y') }} house.onesteptechs.com. All rights reserved.
    </div>
</div>
</body>
</html>
