@extends('admin.layouts.app')

@section('title', 'オーナー設定 - ' . $property->title)

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.properties.show', $property) }}" class="btn btn--ghost btn--sm">← 物件詳細に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">オーナー設定</h1>
    <span style="font-size:.85rem;color:#7b7b9a;">{{ $property->title }}</span>
</div>

@if(session('success'))
<div class="alert alert--success">✅ {{ session('success') }}</div>
@endif

<div style="max-width:560px;display:flex;flex-direction:column;gap:20px;">

    <div class="card">
        <div class="card__header"><div class="card__title">オーナーを選択</div></div>
        <div class="card__body">
            <form method="POST" action="{{ route('admin.properties.owner.update', $property) }}"
                  style="display:flex;flex-direction:column;gap:16px;">
                @csrf @method('PUT')

                <div>
                    <label style="font-size:.78rem;font-weight:700;color:#7b7b9a;display:block;margin-bottom:6px;">オーナー</label>
                    @if($owners->isEmpty())
                        <p style="font-size:.88rem;color:#9090b0;">登録済みのオーナーがいません。先にオーナーを登録してください。</p>
                    @else
                    <select name="owner_id"
                            style="width:100%;padding:9px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;background:#fff;">
                        <option value="">— 未設定 —</option>
                        @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" {{ $property->owner_id == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }}{{ $owner->kana ? '（' . $owner->kana . '）' : '' }}
                        </option>
                        @endforeach
                    </select>
                    @endif
                </div>

                <div style="display:flex;align-items:center;gap:10px;">
                    <button type="submit" class="btn btn--primary" @if($owners->isEmpty()) disabled @endif>設定する</button>
                    <a href="{{ route('admin.owners.create') }}" class="btn btn--ghost btn--sm">＋ 新しいオーナーを登録</a>
                </div>

            </form>
        </div>
    </div>

    @if($property->owner)
    <div class="card">
        <div class="card__header">
            <div class="card__title">現在のオーナー</div>
            <a href="{{ route('admin.owners.show', $property->owner) }}" class="btn btn--ghost btn--sm">詳細を見る</a>
        </div>
        <div class="card__body" style="padding:0;">
            <dl style="margin:0;">
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">氏名</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;font-weight:600;">{{ $property->owner->name }}</dd>
                </div>
                @if($property->owner->kana)
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">フリガナ</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->owner->kana }}</dd>
                </div>
                @endif
                @if($property->owner->phone)
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">電話番号</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->owner->phone }}</dd>
                </div>
                @endif
                @if($property->owner->email)
                <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">メール</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;word-break:break-all;">{{ $property->owner->email }}</dd>
                </div>
                @endif
                @if($property->owner->address)
                <div style="display:grid;grid-template-columns:90px 1fr;">
                    <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">住所</dt>
                    <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->owner->address }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
    @endif

</div>

@endsection
