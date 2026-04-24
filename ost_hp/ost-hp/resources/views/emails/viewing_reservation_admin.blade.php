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
        .message { margin-bottom:24px; }
        .section { margin-bottom:20px; }
        .section-title { font-weight:700; border-bottom:1px solid #e8e8f0; padding-bottom:6px; margin-bottom:10px; }
        .detail-table { width:100%; border-collapse:collapse; }
        .detail-table td { padding:6px 0; vertical-align:top; }
        .detail-table td:first-child { white-space:nowrap; padding-right:16px; color:#4a4a6a; font-weight:700; width:120px; }
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
        <p class="message">
            新しい内見予約が入りました。
        </p>

        <div class="section">
            <div class="section-title">■ 物件情報</div>
            <table class="detail-table">
                <tr>
                    <td>物件名</td>
                    <td>{{ $reservation->property->title }}</td>
                </tr>
                <tr>
                    <td>予約完了ページ</td>
                    <td><a href="{{ $completeUrl }}" style="color:#1a4cbd; word-break:break-all;">{{ $completeUrl }}</a></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">■ 予約情報</div>
            <table class="detail-table">
                <tr>
                    <td>予約日時</td>
                    <td class="highlight">{{ \Carbon\Carbon::parse($reservation->reserved_date)->format('Y年n月j日') }}（{{ ['日','月','火','水','木','金','土'][\Carbon\Carbon::parse($reservation->reserved_date)->dayOfWeek] }}）{{ $reservation->reserved_time }}</td>
                </tr>
                <tr>
                    <td>受付日時</td>
                    <td>{{ $reservation->created_at->format('Y年n月j日 H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">■ 申込者情報</div>
            <table class="detail-table">
                <tr>
                    <td>案内担当者名</td>
                    <td>{{ $reservation->name }}</td>
                </tr>
                <tr>
                    <td>電話番号</td>
                    <td>{{ $reservation->phone }}</td>
                </tr>
                <tr>
                    <td>メールアドレス</td>
                    <td>{{ $reservation->email }}</td>
                </tr>
                <tr>
                    <td>同伴者人数</td>
                    <td>{{ $reservation->companions }}名</td>
                </tr>
                @if($reservation->business_card)
                <tr>
                    <td>名刺</td>
                    <td>添付あり</td>
                </tr>
                @endif
            </table>
        </div>

        <p class="note">※ 本メールはシステムより自動送信されています。</p>
    </div>
    <div class="footer">
        ワンステップテックス不動産<br>
        &copy; {{ date('Y') }} house.onesteptechs.com. All rights reserved.
    </div>
</div>
</body>
</html>
