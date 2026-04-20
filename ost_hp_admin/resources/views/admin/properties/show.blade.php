@extends('admin.layouts.app')

@section('title', $property->title)

@section('content')

@php $sc = $property->statusColor(); @endphp

{{-- ヘッダー --}}
<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.properties.index') }}" class="btn btn--ghost btn--sm">← 一覧に戻る</a>
    <div style="flex:1;min-width:0;">
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <h1 style="font-size:1.2rem;font-weight:700;margin:0;">{{ $property->title }}</h1>
            <span style="
                display:inline-block;padding:3px 12px;border-radius:50px;font-size:.75rem;font-weight:700;
                background:{{ $sc==='teal'?'#e4f7f2':($sc==='orange'?'#fef0e4':'#f0f2f8') }};
                color:{{ $sc==='teal'?'#1a7a5a':($sc==='orange'?'#c96400':'#7b7b9a') }};">
                {{ $property->statusLabel() }}
            </span>
            @if($property->published)
                <span style="display:inline-block;padding:3px 12px;border-radius:50px;font-size:.75rem;font-weight:700;background:#e4f0ff;color:#2f7cff;">公開中</span>
            @else
                <span style="display:inline-block;padding:3px 12px;border-radius:50px;font-size:.75rem;font-weight:700;background:#f0f2f8;color:#7b7b9a;">非公開</span>
            @endif
        </div>
    </div>
    <div style="display:flex;gap:8px;flex-shrink:0;">
        <form method="POST" action="{{ route('admin.properties.toggle-publish', $property) }}" style="display:inline;">
            @csrf @method('PATCH')
            <button class="btn btn--sm {{ $property->published ? 'btn--ghost' : 'btn--primary' }}">
                {{ $property->published ? '非公開にする' : '公開する' }}
            </button>
        </form>
        <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn--primary btn--sm">編集</a>
        <form method="POST" action="{{ route('admin.properties.destroy', $property) }}"
              onsubmit="return confirm('「{{ $property->title }}」を削除しますか？この操作は元に戻せません。')">
            @csrf @method('DELETE')
            <button class="btn btn--danger btn--sm">削除</button>
        </form>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 280px;gap:20px;align-items:start;">

    {{-- 左カラム --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- メイン画像 / PDF --}}
        @if($property->main_image)
        <div class="card">
            <div class="card__header"><div class="card__title">メイン画像 / PDF</div></div>
            <div class="card__body" style="padding:0;">
                @if(str_ends_with(strtolower($property->main_image), '.pdf'))
                    <iframe src="{{ asset('uploads/'.$property->main_image) }}"
                            style="width:100%;height:600px;border:none;border-radius:0 0 12px 12px;display:block;"></iframe>
                @else
                    <img src="{{ asset('uploads/'.$property->main_image) }}" alt="{{ $property->title }}"
                         style="width:100%;display:block;border-radius:0 0 12px 12px;">
                @endif
            </div>
        </div>
        @endif

        {{-- 追加画像 --}}
        @if($property->images && count($property->images) > 0)
        <div class="card">
            <div class="card__header"><div class="card__title">追加画像</div></div>
            <div class="card__body">
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;">
                    @foreach($property->images as $img)
                    <img src="{{ asset('uploads/'.$img) }}" alt=""
                         style="width:100%;height:110px;object-fit:cover;border-radius:8px;border:1px solid #e4e6f0;">
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- 物件説明 --}}
        @if($property->description)
        <div class="card">
            <div class="card__header"><div class="card__title">物件説明</div></div>
            <div class="card__body">
                <p style="white-space:pre-wrap;word-break:break-word;line-height:1.8;font-size:.9rem;">{{ $property->description }}</p>
            </div>
        </div>
        @endif

        {{-- 物件情報 --}}
        <div class="card">
            <div class="card__header"><div class="card__title">物件情報</div></div>
            <div class="card__body" style="padding:0;">
                <dl style="margin:0;">
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">種別</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->typeLabel() }}</dd>
                    </div>
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">価格</dt>
                        <dd style="padding:12px 16px;font-size:1rem;font-weight:700;color:#2f7cff;">{{ $property->priceFormatted() }}</dd>
                    </div>
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">所在地</dt>
                        <dd style="padding:12px 16px;font-size:.85rem;word-break:break-all;">{{ $property->address }}</dd>
                    </div>
                    @if($property->area)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">面積</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->area }} ㎡</dd>
                    </div>
                    @endif
                    @if($property->rooms)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">間取り</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->rooms }}</dd>
                    </div>
                    @endif
                    @if($property->age !== null)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">築年数</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->age }} 年</dd>
                    </div>
                    @endif
                    <div style="display:grid;grid-template-columns:90px 1fr;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">ステータス</dt>
                        <dd style="padding:12px 16px;">
                            <span style="
                                display:inline-block;padding:3px 10px;border-radius:50px;font-size:.75rem;font-weight:700;
                                background:{{ $sc==='teal'?'#e4f7f2':($sc==='orange'?'#fef0e4':'#f0f2f8') }};
                                color:{{ $sc==='teal'?'#1a7a5a':($sc==='orange'?'#c96400':'#7b7b9a') }};">
                                {{ $property->statusLabel() }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

    </div>

    {{-- 右カラム --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- 公開設定 --}}
        <div class="card">
            <div class="card__header"><div class="card__title">公開設定</div></div>
            <div class="card__body">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <span style="font-size:.9rem;">{{ $property->published ? '公開中' : '非公開' }}</span>
                    <form method="POST" action="{{ route('admin.properties.toggle-publish', $property) }}">
                        @csrf @method('PATCH')
                        <button class="btn btn--sm {{ $property->published ? 'btn--ghost' : 'btn--primary' }}">
                            {{ $property->published ? '非公開にする' : '公開する' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- 登録情報 --}}
        <div class="card">
            <div class="card__header"><div class="card__title">登録情報</div></div>
            <div class="card__body" style="padding:0;">
                <dl style="margin:0;">
                    <div style="display:grid;grid-template-columns:80px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:10px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">登録日</dt>
                        <dd style="padding:10px 16px;font-size:.82rem;">{{ $property->created_at->format('Y/m/d H:i') }}</dd>
                    </div>
                    <div style="display:grid;grid-template-columns:80px 1fr;">
                        <dt style="padding:10px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">更新日</dt>
                        <dd style="padding:10px 16px;font-size:.82rem;">{{ $property->updated_at->format('Y/m/d H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

    </div>

</div>

@endsection
