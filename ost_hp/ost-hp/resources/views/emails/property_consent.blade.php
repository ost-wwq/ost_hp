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
        .detail-table td:first-child { white-space:nowrap; padding-right:16px; color:#4a4a6a; font-weight:700; width:80px; }
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
        <p class="greeting">{{ $consent->name }} 様</p>

        <p class="message">
            お世話になっております。<br>
            ワンステップテックス不動産 運営事務局です。<br><br>
            申請いただいた物件の広告掲載について、以下の通り<span class="highlight">「承認」</span>されましたので通知いたします。
        </p>

        <div class="section">
            <div class="section-title">■ 掲載承認物件</div>
            <table class="detail-table">
                <tr>
                    <td>物件名</td>
                    <td>{{ $consent->property->title }}</td>
                </tr>
                @if($consent->property->rooms)
                <tr>
                    <td>間取り</td>
                    <td>{{ $consent->property->rooms }}</td>
                </tr>
                @endif
                <tr>
                    <td>価格</td>
                    <td>{{ $consent->property->priceFormatted() }}</td>
                </tr>
                <tr>
                    <td>広告種別</td>
                    <td>
                        @php
                            $adLabels = [
                                'own_hp' => '自社HP',
                                'suumo'  => 'スーモ',
                                'homes'  => 'ホームズ',
                                'athome' => 'アットホーム',
                                'store'  => '店舗',
                                'other'  => 'その他',
                            ];
                            $labels = collect($consent->ad_types)->map(function($type) use ($adLabels, $consent) {
                                if ($type === 'other' && $consent->ad_other_text) {
                                    return 'その他（' . $consent->ad_other_text . '）';
                                }
                                return $adLabels[$type] ?? $type;
                            })->join('、');
                        @endphp
                        {{ $labels }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="caution">
            <strong>■ 注意事項</strong>
            <ul>
                <li>おとり広告防止のため、成約時は速やかに掲載を終了してください。</li>
                <li>掲載内容が現状と異なる場合は、現況を優先とします。</li>
            </ul>
        </div>

        <p class="message">
            本メールをもって広告掲載承諾の証明とさせていただきます。<br>
            早期の成約に向けて、積極的なご紹介を何卒よろしくお願い申し上げます。
        </p>

        <p class="note">※ 本メールはシステムより自動送信されています。</p>
    </div>
    <div class="footer">
        ワンステップテックス不動産<br>
        &copy; {{ date('Y') }} house.onesteptechs.com. All rights reserved.
    </div>
</div>
</body>
</html>
