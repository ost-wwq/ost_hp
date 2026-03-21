@extends('admin.layouts.app')

@section('title', 'お問い合わせ詳細')

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.contacts.index') }}" class="btn btn--ghost btn--sm">← 一覧に戻る</a>
    <span style="color:#e4e6f0;">|</span>
    @if($contact->isUnread())
        <form method="POST" action="{{ route('admin.contacts.mark-read', $contact) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <button class="btn btn--ghost btn--sm">✅ 既読にする</button>
        </form>
    @else
        <form method="POST" action="{{ route('admin.contacts.mark-unread', $contact) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <button class="btn btn--ghost btn--sm">🔔 未読に戻す</button>
        </form>
    @endif
    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" style="display:inline;margin-left:auto;"
          onsubmit="return confirm('このお問い合わせを削除しますか？')">
        @csrf
        @method('DELETE')
        <button class="btn btn--danger btn--sm">🗑 削除</button>
    </form>
</div>

@if(session('success'))
    <div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:8px;padding:12px 16px;margin-bottom:20px;font-size:.875rem;color:#065f46;">
        ✅ {{ session('success') }}
    </div>
@endif

{{-- 元のお問い合わせ --}}
<div class="card">
    <div class="card__header">
        <div>
            <div class="card__title">
                {{ $contact->subject ?: '（件名なし）' }}
            </div>
            <div style="margin-top:4px;display:flex;gap:8px;align-items:center;">
                @if($contact->isUnread())
                    <span class="badge-unread">● 未読</span>
                @else
                    <span class="badge-read">既読</span>
                @endif
                <span style="font-size:.8rem;color:#7b7b9a;">
                    受信: {{ $contact->created_at->format('Y年m月d日 H:i') }}
                </span>
            </div>
        </div>
    </div>

    <dl class="detail-grid">
        <div class="detail-row">
            <dt>お名前</dt>
            <dd>{{ $contact->name }}</dd>
        </div>
        <div class="detail-row">
            <dt>メールアドレス</dt>
            <dd>
                <a href="mailto:{{ $contact->email }}" style="color:#2f7cff;">{{ $contact->email }}</a>
            </dd>
        </div>
        <div class="detail-row">
            <dt>件名</dt>
            <dd>{{ $contact->subject ?: '（件名なし）' }}</dd>
        </div>
        <div class="detail-row">
            <dt>受信日時</dt>
            <dd>{{ $contact->created_at->format('Y年m月d日 H:i:s') }}</dd>
        </div>
        @if($contact->read_at)
        <div class="detail-row">
            <dt>既読日時</dt>
            <dd>{{ $contact->read_at->format('Y年m月d日 H:i:s') }}</dd>
        </div>
        @endif
        <div class="detail-row">
            <dt>お問い合わせ内容</dt>
            <dd style="line-height:1.8;white-space:pre-wrap;">{{ $contact->message }}</dd>
        </div>
    </dl>
</div>

{{-- 返信スレッド --}}
@if($replies->isNotEmpty())
<div style="margin-top:24px;">
    <div style="font-size:.82rem;font-weight:700;color:#7b7b9a;letter-spacing:.05em;text-transform:uppercase;margin-bottom:12px;">
        返信スレッド（{{ $replies->count() }}件）
    </div>

    @foreach($replies as $r)
    <div class="reply-bubble {{ $r->isOutbound() ? 'reply-bubble--out' : 'reply-bubble--in' }}">
        <div class="reply-bubble__meta">
            @if($r->isOutbound())
                <span class="reply-dir reply-dir--out">📤 管理者から送信</span>
            @else
                <span class="reply-dir reply-dir--in">📥 {{ $contact->name }}さんから受信</span>
            @endif
            <span style="font-size:.75rem;color:#9090b0;">{{ $r->created_at->format('Y/m/d H:i') }}</span>
        </div>
        <div class="reply-bubble__body">{{ $r->body }}</div>
    </div>
    @endforeach
</div>
@endif

{{-- 返信フォーム --}}
<div class="card" style="margin-top:24px;">
    <div class="card__header">
        <div class="card__title">✉ 返信を送信する</div>
    </div>
    <div class="card__body">
        <div style="font-size:.82rem;color:#7b7b9a;margin-bottom:16px;">
            送信先: <strong style="color:#2b2d42;">{{ $contact->name }}</strong>
            &lt;<a href="mailto:{{ $contact->email }}" style="color:#2f7cff;">{{ $contact->email }}</a>&gt;
        </div>

        <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}">
            @csrf

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:.82rem;font-weight:700;color:#2b2d42;margin-bottom:8px;">
                    返信内容 <span style="color:#f17c20;">*</span>
                </label>
                <textarea
                    name="body"
                    rows="8"
                    style="width:100%;padding:12px 14px;border:1.5px solid #e4e6f0;border-radius:8px;font-size:.9rem;font-family:inherit;outline:none;transition:.2s;resize:vertical;line-height:1.7;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#2f7cff';this.style.boxShadow='0 0 0 3px rgba(47,124,255,.1)'"
                    onblur="this.style.borderColor='#e4e6f0';this.style.boxShadow=''"
                    placeholder="返信内容を入力してください..."
                    required>{{ old('body') }}</textarea>
                @error('body')
                    <div style="color:#b91c1c;font-size:.8rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;justify-content:flex-end;">
                <button type="submit" class="btn btn--primary">
                    📨 返信を送信する
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.reply-bubble {
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 10px;
    border: 1px solid;
}
.reply-bubble--out {
    background: #eef4ff;
    border-color: #c7d9ff;
    margin-left: 40px;
}
.reply-bubble--in {
    background: #f0faf6;
    border-color: #b6e8d4;
    margin-right: 40px;
}
.reply-bubble__meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}
.reply-dir {
    font-size: .78rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 50px;
}
.reply-dir--out {
    background: #dbeafe;
    color: #1e40af;
}
.reply-dir--in {
    background: #d1fae5;
    color: #065f46;
}
.reply-bubble__body {
    font-size: .9rem;
    line-height: 1.8;
    color: #2b2d42;
    white-space: pre-wrap;
}
</style>

@endsection
