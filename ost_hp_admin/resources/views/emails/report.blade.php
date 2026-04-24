<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', sans-serif; background:#f0f2f8; margin:0; padding:24px; color:#2b2d42; }
        .wrap { max-width:680px; margin:0 auto; }
        .header { background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%); border-radius:12px 12px 0 0; padding:28px 32px; text-align:center; }
        .header__logo { font-size:1.8rem; margin-bottom:6px; }
        .header__name { color:#fff; font-size:.95rem; font-weight:700; opacity:.9; }
        .body { background:#fff; padding:32px; border-radius:0 0 12px 12px; }
        h2 { font-size:1.05rem; font-weight:700; margin:0 0 4px; }
        .period { font-size:.9rem; color:#7b7b9a; margin-bottom:24px; }
        .summary-row { display:flex; gap:16px; margin-bottom:28px; }
        .summary-box { flex:1; background:#f8f9ff; border:1px solid #e4e6f0; border-radius:10px; padding:16px 20px; text-align:center; }
        .summary-box__label { font-size:.75rem; font-weight:700; color:#7b7b9a; margin-bottom:6px; }
        .summary-box__num { font-size:2rem; font-weight:700; color:#2f7cff; }
        .section-title { font-size:.85rem; font-weight:700; color:#4a4a6a; border-left:4px solid #2f7cff; padding-left:10px; margin:28px 0 12px; }
        table { width:100%; border-collapse:collapse; font-size:.82rem; }
        th { background:#f0f2f8; padding:8px 10px; text-align:left; font-weight:700; color:#7b7b9a; border-bottom:2px solid #e4e6f0; }
        td { padding:8px 10px; border-bottom:1px solid #f0f2f8; color:#2b2d42; }
        .empty { color:#b0b0c8; font-size:.85rem; padding:16px 0; }
        .footer { text-align:center; font-size:.75rem; color:#b0b0c8; margin-top:24px; line-height:1.7; }
        @php
            $adLabels = ['own_hp'=>'自社HP','suumo'=>'SUUMO','homes'=>"HOME'S",'athome'=>'athome','store'=>'店頭','other'=>'その他'];
        @endphp
    </style>
</head>
<body>
@php
    $adLabels = ['own_hp'=>'自社HP','suumo'=>'SUUMO','homes'=>"HOME'S",'athome'=>'athome','store'=>'店頭','other'=>'その他'];
@endphp
<div class="wrap">
    <div class="header">
        <div class="header__logo">🏠</div>
        <div class="header__name">ワンステップテックス不動産</div>
    </div>
    <div class="body">
        <h2>活動報告レポート</h2>
        <div class="period">
            対象期間：{{ $report->date_from->format('Y年m月d日') }} 〜 {{ $report->date_to->format('Y年m月d日') }}
            @if($report->property)
                ／ 対象物件：{{ $report->property->title }}
            @endif
        </div>

        @if($report->free_text)
        <div style="background:#f8f9ff;border-left:4px solid #2f7cff;border-radius:4px;padding:14px 18px;margin-bottom:24px;font-size:.88rem;line-height:1.8;white-space:pre-wrap;">{{ $report->free_text }}</div>
        @endif

        <div class="summary-row">
            <div class="summary-box">
                <div class="summary-box__label">掲載承諾件数</div>
                <div class="summary-box__num">{{ $report->consents_count }}</div>
            </div>
            <div class="summary-box">
                <div class="summary-box__label">内見申請件数</div>
                <div class="summary-box__num">{{ $report->viewings_count }}</div>
            </div>
        </div>

        <div class="section-title">掲載承諾一覧</div>
        @if(empty($report->consents_data))
            <div class="empty">該当期間の掲載承諾はありません。</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>物件名</th>
                        <th>お名前</th>
                        <th>広告種別</th>
                        <th>申込日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->consents_data as $c)
                    <tr>
                        <td>{{ $c['property_title'] }}</td>
                        <td>{{ $c['name'] }}</td>
                        <td>
                            @php
                                $labels = array_map(function($t) use ($adLabels, $c) {
                                    if ($t === 'other' && !empty($c['ad_other_text'])) return 'その他（'.$c['ad_other_text'].'）';
                                    return $adLabels[$t] ?? $t;
                                }, $c['ad_types'] ?? []);
                            @endphp
                            {{ implode('・', $labels) }}
                        </td>
                        <td>{{ $c['created_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="section-title">内見申請一覧</div>
        @if(empty($report->viewings_data))
            <div class="empty">該当期間の内見申請はありません。</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>物件名</th>
                        <th>お名前</th>
                        <th>希望日時</th>
                        <th>同行者</th>
                        <th>申込日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->viewings_data as $v)
                    <tr>
                        <td>{{ $v['property_title'] }}</td>
                        <td>{{ $v['name'] }}</td>
                        <td>{{ $v['reserved_date'] }} {{ $v['reserved_time'] }}</td>
                        <td>{{ $v['companions'] ?? '—' }}</td>
                        <td>{{ $v['created_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="footer">
        このメールはシステムより自動送信されています。<br>
        ワンステップテックス不動産 管理システム
    </div>
</div>
</body>
</html>
