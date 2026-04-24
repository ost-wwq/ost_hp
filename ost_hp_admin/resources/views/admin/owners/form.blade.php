@extends('admin.layouts.app')

@section('title', $owner->exists ? 'オーナー編集 - ' . $owner->name : 'オーナー新規登録')

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    @if($owner->exists)
        <a href="{{ route('admin.owners.show', $owner) }}" class="btn btn--ghost btn--sm">← 詳細に戻る</a>
        <h1 style="font-size:1.1rem;font-weight:700;margin:0;">オーナー編集</h1>
    @else
        <a href="{{ route('admin.owners.index') }}" class="btn btn--ghost btn--sm">← 一覧に戻る</a>
        <h1 style="font-size:1.1rem;font-weight:700;margin:0;">オーナー新規登録</h1>
    @endif
</div>

<div style="max-width:560px;">
    <div class="card">
        <div class="card__header"><div class="card__title">オーナー情報</div></div>
        <div class="card__body">
            <form method="POST"
                  action="{{ $owner->exists ? route('admin.owners.update', $owner) : route('admin.owners.store') }}"
                  style="display:flex;flex-direction:column;gap:18px;">
                @csrf
                @if($owner->exists) @method('PUT') @endif

                <div>
                    <label style="font-size:.78rem;font-weight:700;color:#7b7b9a;display:block;margin-bottom:5px;">氏名 <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $owner->name) }}"
                           placeholder="例：山田 太郎" required
                           style="width:100%;padding:9px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;box-sizing:border-box;">
                    @error('name')<div style="font-size:.75rem;color:#dc2626;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label style="font-size:.78rem;font-weight:700;color:#7b7b9a;display:block;margin-bottom:5px;">フリガナ</label>
                    <input type="text" name="kana" value="{{ old('kana', $owner->kana) }}"
                           placeholder="例：ヤマダ タロウ"
                           style="width:100%;padding:9px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;box-sizing:border-box;">
                    @error('kana')<div style="font-size:.75rem;color:#dc2626;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label style="font-size:.78rem;font-weight:700;color:#7b7b9a;display:block;margin-bottom:5px;">電話番号</label>
                    <input type="tel" name="phone" value="{{ old('phone', $owner->phone) }}"
                           placeholder="例：090-0000-0000"
                           style="width:100%;padding:9px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;box-sizing:border-box;">
                    @error('phone')<div style="font-size:.75rem;color:#dc2626;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label style="font-size:.78rem;font-weight:700;color:#7b7b9a;display:block;margin-bottom:5px;">メールアドレス</label>
                    <input type="email" name="email" value="{{ old('email', $owner->email) }}"
                           placeholder="例：owner@example.com"
                           style="width:100%;padding:9px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;box-sizing:border-box;">
                    @error('email')<div style="font-size:.75rem;color:#dc2626;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label style="font-size:.78rem;font-weight:700;color:#7b7b9a;display:block;margin-bottom:5px;">住所</label>
                    <input type="text" name="address" value="{{ old('address', $owner->address) }}"
                           placeholder="例：埼玉県さいたま市..."
                           style="width:100%;padding:9px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;box-sizing:border-box;">
                    @error('address')<div style="font-size:.75rem;color:#dc2626;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label style="font-size:.78rem;font-weight:700;color:#7b7b9a;display:block;margin-bottom:5px;">備考</label>
                    <textarea name="note" rows="4"
                              placeholder="連絡時の注意事項など"
                              style="width:100%;padding:9px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;resize:vertical;box-sizing:border-box;">{{ old('note', $owner->note) }}</textarea>
                    @error('note')<div style="font-size:.75rem;color:#dc2626;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn--primary">{{ $owner->exists ? '更新する' : '登録する' }}</button>
                    @if($owner->exists)
                    <form method="POST" action="{{ route('admin.owners.destroy', $owner) }}"
                          onsubmit="return confirm('「{{ $owner->name }}」を削除しますか？')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn--danger">削除</button>
                    </form>
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
