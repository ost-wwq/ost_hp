@extends('admin.layouts.app')

@section('title', '報告詳細')

@section('content')
@php
    $adLabels = ['own_hp'=>'自社HP','suumo'=>'SUUMO','homes'=>"HOME'S",'athome'=>'athome','store'=>'店頭','other'=>'その他'];
@endphp

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.reports.index') }}" class="btn btn--ghost btn--sm">← 報告履歴に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">報告詳細</h1>
</div>

{{-- サマリー --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:16px;">
    <div class="stat-card">
        <div>
            <div style="font-size:.75rem;font-weight:700;color:#7b7b9a;margin-bottom:4px;">対象期間</div>
            <div style="font-size:.95rem;font-weight:700;">{{ $report->date_from->format('Y/m/d') }} 〜 {{ $report->date_to->format('Y/m/d') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div style="font-size:.75rem;font-weight:700;color:#7b7b9a;margin-bottom:4px;">掲載承諾件数</div>
            <div style="font-size:1.6rem;font-weight:700;color:#2f7cff;">{{ $report->consents_count }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div style="font-size:.75rem;font-weight:700;color:#7b7b9a;margin-bottom:4px;">内見申請件数</div>
            <div style="font-size:1.6rem;font-weight:700;color:#2f7cff;">{{ $report->viewings_count }}</div>
        </div>
    </div>
</div>

<div style="font-size:.82rem;color:#7b7b9a;margin-bottom:12px;">
    @if($report->property)
        対象物件: <strong style="color:#2b2d42;">{{ $report->property->title }}</strong> ／
    @else
        対象物件: 全物件 ／
    @endif
    送信先: {{ $report->sent_to }} ／ 送信日時: {{ $report->created_at->format('Y/m/d H:i') }}
</div>

@if($report->free_text)
<div class="card" style="margin-bottom:24px;">
    <div class="card__header">
        <div class="card__title">自由入力文字</div>
    </div>
    <div class="card__body">
        <p style="white-space:pre-wrap;font-size:.9rem;line-height:1.7;margin:0;">{{ $report->free_text }}</p>
    </div>
</div>
@endif

{{-- 掲載承諾一覧 --}}
<div class="card" style="margin-bottom:24px;">
    <div class="card__header">
        <div class="card__title">掲載承諾一覧 ({{ $report->consents_count }}件)</div>
    </div>
    <div class="card__body" style="padding:0;">
        @if(empty($report->consents_data))
            <div style="padding:32px;text-align:center;color:#7b7b9a;font-size:.9rem;">該当期間の掲載承諾はありません</div>
        @else
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#fafbfd;border-bottom:2px solid #e4e6f0;">
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">物件名</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">お名前</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">電話番号</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">広告種別</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">申込日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->consents_data as $c)
                    <tr style="border-bottom:1px solid #f0f2f8;">
                        <td style="padding:12px 16px;font-size:.85rem;font-weight:600;">{{ $c['property_title'] }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $c['name'] }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $c['phone'] }}</td>
                        <td style="padding:12px 16px;font-size:.82rem;">
                            @php
                                $labels = array_map(function($t) use ($adLabels, $c) {
                                    if ($t === 'other' && !empty($c['ad_other_text'])) return 'その他（'.$c['ad_other_text'].'）';
                                    return $adLabels[$t] ?? $t;
                                }, $c['ad_types'] ?? []);
                            @endphp
                            {{ implode('・', $labels) }}
                        </td>
                        <td style="padding:12px 16px;font-size:.82rem;color:#7b7b9a;">{{ $c['created_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- 内見申請一覧 --}}
<div class="card">
    <div class="card__header">
        <div class="card__title">内見申請一覧 ({{ $report->viewings_count }}件)</div>
    </div>
    <div class="card__body" style="padding:0;">
        @if(empty($report->viewings_data))
            <div style="padding:32px;text-align:center;color:#7b7b9a;font-size:.9rem;">該当期間の内見申請はありません</div>
        @else
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#fafbfd;border-bottom:2px solid #e4e6f0;">
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">物件名</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">お名前</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">電話番号</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">希望日時</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">同行者</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">申込日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->viewings_data as $v)
                    <tr style="border-bottom:1px solid #f0f2f8;">
                        <td style="padding:12px 16px;font-size:.85rem;font-weight:600;">{{ $v['property_title'] }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $v['name'] }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $v['phone'] }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $v['reserved_date'] }} {{ $v['reserved_time'] }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $v['companions'] ?? '—' }}</td>
                        <td style="padding:12px 16px;font-size:.82rem;color:#7b7b9a;">{{ $v['created_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
