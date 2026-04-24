@extends('admin.layouts.app')

@section('title', 'オーナー詳細 - ' . $owner->name)

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.owners.index') }}" class="btn btn--ghost btn--sm">← 一覧に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">{{ $owner->name }}</h1>
    @if($owner->kana)
        <span style="font-size:.85rem;color:#7b7b9a;">{{ $owner->kana }}</span>
    @endif
    <a href="{{ route('admin.owners.edit', $owner) }}" class="btn btn--primary btn--sm" style="margin-left:auto;">編集</a>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">

    <div class="card">
        <div class="card__header"><div class="card__title">オーナー情報</div></div>
        <div class="card__body" style="padding:0;">
            <dl style="margin:0;">
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">氏名</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $owner->name }}</dd>
                </div>
                @if($owner->kana)
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">フリガナ</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $owner->kana }}</dd>
                </div>
                @endif
                @if($owner->phone)
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">電話番号</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $owner->phone }}</dd>
                </div>
                @endif
                @if($owner->email)
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">メール</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;word-break:break-all;">{{ $owner->email }}</dd>
                </div>
                @endif
                @if($owner->address)
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">住所</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $owner->address }}</dd>
                </div>
                @endif
                @if($owner->note)
                <div style="display:grid;grid-template-columns:90px 1fr;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">備考</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;white-space:pre-wrap;">{{ $owner->note }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card__header"><div class="card__title">所有物件（{{ $owner->properties->count() }}件）</div></div>
        @if($owner->properties->isEmpty())
            <div class="card__body" style="color:#9090b0;font-size:.88rem;">紐付けられた物件はありません。</div>
        @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>物件名</th>
                        <th>ステータス</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($owner->properties as $property)
                    @php $sc = $property->statusColor(); @endphp
                    <tr>
                        <td style="font-size:.88rem;font-weight:600;">{{ $property->title }}</td>
                        <td>
                            <span style="display:inline-block;padding:2px 8px;border-radius:50px;font-size:.72rem;font-weight:700;
                                background:{{ $sc==='teal'?'#e4f7f2':($sc==='orange'?'#fef0e4':'#f0f2f8') }};
                                color:{{ $sc==='teal'?'#1a7a5a':($sc==='orange'?'#c96400':'#7b7b9a') }};">
                                {{ $property->statusLabel() }}
                            </span>
                        </td>
                        <td><a href="{{ route('admin.properties.show', $property) }}" class="btn btn--ghost btn--sm">詳細</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>

@endsection
