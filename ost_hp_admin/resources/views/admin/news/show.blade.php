@extends('admin.layouts.app')

@section('title', 'お知らせ詳細')

@section('content')

<div style="margin-bottom:20px;display:flex;align-items:center;gap:12px;">
    <a href="{{ route('admin.news.index') }}" class="btn btn--ghost btn--sm">← 一覧へ戻る</a>
</div>

<div class="card" style="max-width:860px;">
    <div class="card__header">
        <div>
            <div class="card__title">{{ $news->title }}</div>
            <div style="font-size:.8rem;color:#7b7b9a;margin-top:4px;">
                @if($news->published_at)
                    公開日: {{ $news->published_at->format('Y年m月d日') }}
                @endif
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:8px;">
            @if($news->published)
                <span style="display:inline-block;padding:4px 12px;border-radius:50px;font-size:.78rem;font-weight:700;background:#e4f7f2;color:#1a7a5a;">公開中</span>
            @else
                <span style="display:inline-block;padding:4px 12px;border-radius:50px;font-size:.78rem;font-weight:700;background:#f0f2f8;color:#7b7b9a;">下書き</span>
            @endif
            <a href="{{ route('admin.news.edit', $news) }}" class="btn btn--primary btn--sm">編集</a>
            <form method="POST" action="{{ route('admin.news.destroy', $news) }}"
                  onsubmit="return confirm('このお知らせを削除しますか？')">
                @csrf @method('DELETE')
                <button class="btn btn--danger btn--sm">削除</button>
            </form>
        </div>
    </div>

    <div class="card__body">
        <dl class="detail-grid">
            <div class="detail-row">
                <dt>タイトル</dt>
                <dd>{{ $news->title }}</dd>
            </div>
            <div class="detail-row">
                <dt>公開状態</dt>
                <dd>{{ $news->published ? '公開中' : '下書き' }}</dd>
            </div>
            <div class="detail-row">
                <dt>公開日</dt>
                <dd>{{ $news->published_at ? $news->published_at->format('Y年m月d日') : '—' }}</dd>
            </div>
            <div class="detail-row">
                <dt>作成日時</dt>
                <dd>{{ $news->created_at->format('Y/m/d H:i') }}</dd>
            </div>
            <div class="detail-row">
                <dt>更新日時</dt>
                <dd>{{ $news->updated_at->format('Y/m/d H:i') }}</dd>
            </div>
        </dl>

        <div style="margin-top:24px;">
            <div style="font-size:.75rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:#7b7b9a;margin-bottom:12px;">本文</div>
            <div style="background:#f8f9ff;border-radius:8px;padding:20px;font-size:.9rem;line-height:1.8;white-space:pre-wrap;word-break:break-word;border:1px solid #e4e6f0;">{{ $news->body }}</div>
        </div>
    </div>
</div>

@endsection
