@extends('admin.layouts.app')

@section('title', '内見予約詳細 - ' . $viewing->name)

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.properties.viewings', $property) }}" class="btn btn--ghost btn--sm">← 内見予約一覧に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">内見予約詳細</h1>
    <span style="font-size:.85rem;color:#7b7b9a;">{{ $property->title }}</span>
</div>

<div style="max-width:600px;">
    <div class="card">
        <div class="card__header"><div class="card__title">予約者情報</div></div>
        <div class="card__body" style="padding:0;">
            <dl style="margin:0;">
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">お名前</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $viewing->name }}</dd>
                </div>
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">電話番号</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $viewing->phone }}</dd>
                </div>
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">メールアドレス</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;word-break:break-all;">{{ $viewing->email }}</dd>
                </div>
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">希望日</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">
                        @if($viewing->reserved_date)
                            {{ \Carbon\Carbon::parse($viewing->reserved_date)->format('Y年m月d日') }}
                        @else
                            <span style="color:#7b7b9a;">未設定</span>
                        @endif
                    </dd>
                </div>
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">希望時間</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">
                        @if($viewing->reserved_time)
                            {{ $viewing->reserved_time }}
                        @else
                            <span style="color:#7b7b9a;">未設定</span>
                        @endif
                    </dd>
                </div>
                @if($viewing->business_card)
                <div style="display:grid;grid-template-columns:110px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">名刺</dt>
                    <dd style="padding:12px 16px;">
                        @if(str_ends_with(strtolower($viewing->business_card), '.pdf'))
                            <a href="{{ asset('uploads/'.$viewing->business_card) }}" target="_blank"
                               style="font-size:.85rem;color:#2f7cff;">↗ PDFを開く</a>
                        @else
                            <img src="{{ asset('uploads/'.$viewing->business_card) }}" alt="名刺"
                                 style="max-width:280px;border-radius:8px;border:1px solid #e4e6f0;">
                        @endif
                    </dd>
                </div>
                @endif
                <div style="display:grid;grid-template-columns:110px 1fr;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">申込日時</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $viewing->created_at->format('Y年m月d日 H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

@endsection
