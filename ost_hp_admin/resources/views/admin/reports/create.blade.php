@extends('admin.layouts.app')

@section('title', '新規報告を送信')

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.reports.index') }}" class="btn btn--ghost btn--sm">← 報告履歴に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">新規報告を送信</h1>
</div>

<div class="card" style="max-width:560px;">
    <div class="card__header">
        <div class="card__title">報告条件を設定</div>
    </div>
    <div class="card__body">
        @if($errors->any())
            <div class="alert alert--error" style="margin-bottom:20px;">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.reports.store') }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:.82rem;font-weight:700;margin-bottom:6px;">対象物件 <span style="font-weight:400;color:#9090b0;">（任意）</span></label>
                <select name="property_id"
                        style="width:100%;padding:10px 14px;border:1px solid #d8dae6;border-radius:8px;font-size:.9rem;background:#fff;">
                    <option value="">全物件</option>
                    @foreach($properties as $p)
                        <option value="{{ $p->id }}"
                            {{ old('property_id', $propertyId ?? '') == $p->id ? 'selected' : '' }}>
                            {{ $p->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:.82rem;font-weight:700;margin-bottom:6px;">対象期間（開始）</label>
                <input type="date" name="date_from" value="{{ old('date_from') }}"
                       style="width:100%;padding:10px 14px;border:1px solid #d8dae6;border-radius:8px;font-size:.9rem;"
                       required>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:.82rem;font-weight:700;margin-bottom:6px;">対象期間（終了）</label>
                <input type="date" name="date_to" value="{{ old('date_to') }}"
                       style="width:100%;padding:10px 14px;border:1px solid #d8dae6;border-radius:8px;font-size:.9rem;"
                       required>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:.82rem;font-weight:700;margin-bottom:6px;">送信先メールアドレス</label>
                <input type="email" name="sent_to" value="{{ old('sent_to', $sentTo ?? '') }}"
                       placeholder="example@example.com"
                       style="width:100%;padding:10px 14px;border:1px solid #d8dae6;border-radius:8px;font-size:.9rem;"
                       required>
            </div>

            <div style="margin-bottom:28px;">
                <label style="display:block;font-size:.82rem;font-weight:700;margin-bottom:6px;">自由入力文字 <span style="font-weight:400;color:#9090b0;">（任意）</span></label>
                <textarea name="free_text" rows="5"
                          placeholder="オーナーへのメッセージや補足事項など"
                          style="width:100%;padding:10px 14px;border:1px solid #d8dae6;border-radius:8px;font-size:.9rem;resize:vertical;line-height:1.6;">{{ old('free_text') }}</textarea>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn btn--primary">報告メールを送信</button>
                <a href="{{ route('admin.reports.index') }}" class="btn btn--ghost">キャンセル</a>
            </div>
        </form>
    </div>
</div>

@endsection
