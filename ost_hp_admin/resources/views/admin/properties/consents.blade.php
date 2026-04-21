@extends('admin.layouts.app')

@section('title', '物件掲載承諾一覧 - ' . $property->title)

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.properties.show', $property) }}" class="btn btn--ghost btn--sm">← 物件詳細に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">物件掲載承諾一覧</h1>
    <span style="font-size:.85rem;color:#7b7b9a;">{{ $property->title }}</span>
</div>

<div class="card">
    <div class="card__header">
        <div class="card__title">掲載承諾 ({{ $consents->count() }}件)</div>
    </div>
    <div class="card__body" style="padding:0;">
        @if($consents->isEmpty())
            <div style="padding:40px;text-align:center;color:#7b7b9a;font-size:.9rem;">掲載承諾の申し込みはありません</div>
        @else
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#fafbfd;border-bottom:2px solid #e4e6f0;">
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">お名前</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">電話番号</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">メールアドレス</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">広告種別</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">申込日時</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consents as $consent)
                    <tr style="border-bottom:1px solid #f0f2f8;cursor:pointer;transition:background .15s;"
                        onclick="location.href='{{ route('admin.properties.consent-show', [$property, $consent]) }}'"
                        onmouseover="this.style.background='#f8f9ff'" onmouseout="this.style.background=''">
                        <td style="padding:12px 16px;font-size:.88rem;font-weight:600;">{{ $consent->name }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $consent->phone }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $consent->email }}</td>
                        <td style="padding:12px 16px;font-size:.82rem;">
                            @php
                                $adLabels = ['own_hp'=>'自社HP','suumo'=>'SUUMO','homes'=>"HOME'S",'athome'=>'athome','store'=>'店頭'];
                            @endphp
                            {{ implode('・', array_map(fn($t) => $adLabels[$t] ?? $t, $consent->ad_types ?? [])) }}
                        </td>
                        <td style="padding:12px 16px;font-size:.82rem;color:#7b7b9a;">{{ $consent->created_at->format('Y/m/d H:i') }}</td>
                        <td style="padding:12px 16px;">
                            <a href="{{ route('admin.properties.consent-show', [$property, $consent]) }}"
                               class="btn btn--ghost btn--sm" onclick="event.stopPropagation()">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
