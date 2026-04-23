@extends('admin.layouts.app')

@section('title', '広告掲載許可申請詳細 - ' . $consent->name)

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.properties.consents', $property) }}" class="btn btn--ghost btn--sm">← 広告掲載許可申請一覧に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">広告掲載許可申請詳細</h1>
    <span style="font-size:.85rem;color:#7b7b9a;">{{ $property->title }}</span>
</div>

<div style="max-width:600px;">
    <div class="card">
        <div class="card__header"><div class="card__title">申込者情報</div></div>
        <div class="card__body" style="padding:0;">
            <dl style="margin:0;">
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">お名前</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $consent->name }}</dd>
                </div>
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">電話番号</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $consent->phone }}</dd>
                </div>
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">メールアドレス</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;word-break:break-all;">{{ $consent->email }}</dd>
                </div>
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">広告宣伝種別</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">
                        @php
                            $adLabels = ['own_hp'=>'自社HP','suumo'=>'SUUMO','homes'=>"HOME'S",'athome'=>'athome','store'=>'店頭'];
                        @endphp
                        <div style="display:flex;flex-wrap:wrap;gap:6px;">
                            @foreach($consent->ad_types ?? [] as $type)
                                <span style="display:inline-block;padding:3px 10px;border-radius:50px;font-size:.78rem;font-weight:600;background:#e4f0ff;color:#2f7cff;">
                                    {{ $adLabels[$type] ?? $type }}
                                </span>
                            @endforeach
                        </div>
                    </dd>
                </div>
                @if($consent->business_card)
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">名刺</dt>
                    <dd style="padding:12px 16px;">
                        @if(str_ends_with(strtolower($consent->business_card), '.pdf'))
                            <a href="{{ asset('uploads/'.$consent->business_card) }}" target="_blank"
                               style="font-size:.85rem;color:#2f7cff;">↗ PDFを開く</a>
                        @else
                            <img src="{{ asset('uploads/'.$consent->business_card) }}" alt="名刺"
                                 style="max-width:280px;border-radius:8px;border:1px solid #e4e6f0;">
                        @endif
                    </dd>
                </div>
                @endif
                <div style="display:grid;grid-template-columns:110px 1fr;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">申込日時</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $consent->created_at->format('Y年m月d日 H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

@endsection
