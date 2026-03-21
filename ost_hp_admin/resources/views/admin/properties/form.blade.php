@extends('admin.layouts.app')

@section('title', $property->exists ? '物件編集' : '物件登録')

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.properties.index') }}" class="btn btn--ghost btn--sm">← 一覧に戻る</a>
    @if($property->exists && $property->published)
        <a href="{{ route('properties.show', $property) }}" target="_blank" class="btn btn--ghost btn--sm">🌐 公開ページを確認</a>
    @endif
</div>

<form method="POST"
      action="{{ $property->exists ? route('admin.properties.update', $property) : route('admin.properties.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($property->exists) @method('PUT') @endif

    @if($errors->any())
        <div class="alert alert--error">
            ⚠ 入力内容にエラーがあります：{{ implode(' / ', $errors->all()) }}
        </div>
    @endif

    <div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;">

        {{-- 左カラム --}}
        <div style="display:flex;flex-direction:column;gap:20px;">

            <div class="card">
                <div class="card__header"><div class="card__title">基本情報</div></div>
                <div class="card__body" style="display:flex;flex-direction:column;gap:16px;">

                    <div class="form-group" style="margin:0;">
                        <label class="form-label">物件名 <span style="color:#f17c20;">*</span></label>
                        <input type="text" name="title" class="form-input" value="{{ old('title', $property->title) }}" placeholder="例）○○マンション 301号室" required>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">種別 <span style="color:#f17c20;">*</span></label>
                            <select name="property_type" class="form-input" required>
                                @foreach(\App\Models\Property::typeOptions() as $val => $label)
                                    <option value="{{ $val }}" {{ old('property_type', $property->property_type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">ステータス <span style="color:#f17c20;">*</span></label>
                            <select name="status" class="form-input" required>
                                @foreach(\App\Models\Property::statusOptions() as $val => $info)
                                    <option value="{{ $val }}" {{ old('status', $property->status ?? 'available') === $val ? 'selected' : '' }}>{{ $info['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin:0;">
                        <label class="form-label">所在地 <span style="color:#f17c20;">*</span></label>
                        <input type="text" name="address" class="form-input" value="{{ old('address', $property->address) }}" placeholder="例）東京都渋谷区○○1-2-3" required>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">価格（万円）<span style="color:#f17c20;">*</span></label>
                            <input type="number" name="price" class="form-input" value="{{ old('price', $property->price) }}" placeholder="3500" min="0" required>
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">面積（㎡）</label>
                            <input type="number" name="area" class="form-input" value="{{ old('area', $property->area) }}" placeholder="65.00" step="0.01" min="0">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">築年数（年）</label>
                            <input type="number" name="age" class="form-input" value="{{ old('age', $property->age) }}" placeholder="5" min="0">
                        </div>
                    </div>

                    <div class="form-group" style="margin:0;">
                        <label class="form-label">間取り</label>
                        <input type="text" name="rooms" class="form-input" value="{{ old('rooms', $property->rooms) }}" placeholder="例）3LDK">
                    </div>

                    <div class="form-group" style="margin:0;">
                        <label class="form-label">物件説明</label>
                        <textarea name="description" class="form-input" rows="6" placeholder="物件の特徴や周辺環境などをご記入ください">{{ old('description', $property->description) }}</textarea>
                    </div>

                </div>
            </div>

            {{-- 画像アップロード --}}
            <div class="card">
                <div class="card__header"><div class="card__title">画像</div></div>
                <div class="card__body" style="display:flex;flex-direction:column;gap:20px;">

                    <div>
                        <label class="form-label">メイン画像</label>
                        @if($property->main_image)
                            <div style="margin-bottom:10px;">
                                <img src="{{ asset('uploads/'.$property->main_image) }}" alt=""
                                     style="height:120px;object-fit:cover;border-radius:8px;border:1px solid #e4e6f0;">
                            </div>
                        @endif
                        <input type="file" name="main_image" class="form-input" accept="image/*"
                               style="padding:8px;">
                        <div style="font-size:.78rem;color:#7b7b9a;margin-top:4px;">JPG・PNG・WEBP / 最大5MB</div>
                    </div>

                    <div>
                        <label class="form-label">追加画像（複数選択可）</label>
                        @if($property->images)
                            <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:12px;">
                                @foreach($property->images as $img)
                                <div style="position:relative;">
                                    <img src="{{ asset('uploads/'.$img) }}" alt=""
                                         style="width:80px;height:70px;object-fit:cover;border-radius:6px;border:1px solid #e4e6f0;">
                                    <label style="position:absolute;top:2px;right:2px;background:rgba(185,28,28,.85);color:#fff;border-radius:4px;padding:2px 4px;font-size:.65rem;cursor:pointer;">
                                        <input type="checkbox" name="delete_images[]" value="{{ $img }}" style="display:none;">削除
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="extra_images[]" class="form-input" accept="image/*" multiple
                               style="padding:8px;">
                    </div>

                </div>
            </div>

        </div>

        {{-- 右カラム --}}
        <div style="display:flex;flex-direction:column;gap:20px;">

            <div class="card">
                <div class="card__header"><div class="card__title">公開設定</div></div>
                <div class="card__body">
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:12px;background:#f8f9ff;border-radius:8px;border:1.5px solid #e4e6f0;">
                        <input type="checkbox" name="published" value="1"
                               {{ old('published', $property->published) ? 'checked' : '' }}
                               style="width:18px;height:18px;accent-color:#2f7cff;">
                        <div>
                            <div style="font-weight:700;font-size:.9rem;">サイトに公開する</div>
                            <div style="font-size:.78rem;color:#7b7b9a;margin-top:2px;">チェックを入れると物件一覧に表示されます</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="card">
                <div class="card__header"><div class="card__title">操作</div></div>
                <div class="card__body" style="display:flex;flex-direction:column;gap:10px;">
                    <button type="submit" class="btn btn--primary btn--full">
                        {{ $property->exists ? '💾 更新する' : '✅ 登録する' }}
                    </button>
                    @if($property->exists)
                    <form method="POST" action="{{ route('admin.properties.destroy', $property) }}"
                          onsubmit="return confirm('この物件を削除しますか？画像も削除されます。')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn--danger btn--full">🗑 削除する</button>
                    </form>
                    @endif
                </div>
            </div>

            @if($property->exists)
            <div class="card">
                <div class="card__header"><div class="card__title">物件情報</div></div>
                <div class="card__body" style="font-size:.82rem;color:#7b7b9a;display:flex;flex-direction:column;gap:6px;">
                    <div>ID: #{{ $property->id }}</div>
                    <div>登録日: {{ $property->created_at->format('Y/m/d H:i') }}</div>
                    <div>更新日: {{ $property->updated_at->format('Y/m/d H:i') }}</div>
                </div>
            </div>
            @endif

        </div>
    </div>

</form>

<style>
.form-input { width:100%; padding:10px 14px; border:1.5px solid #e4e6f0; border-radius:8px; font-size:.9rem; font-family:inherit; outline:none; transition:.2s; background:#fff; }
.form-input:focus { border-color:#2f7cff; box-shadow:0 0 0 3px rgba(47,124,255,.1); }
select.form-input { cursor:pointer; }
textarea.form-input { resize:vertical; }
.form-label { display:block; font-size:.82rem; font-weight:700; color:#2b2d42; margin-bottom:6px; }
</style>

@endsection
