@extends('admin.layouts.app')

@section('title', 'お知らせ管理')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
    <div></div>
    <a href="{{ route('admin.news.create') }}" class="btn btn--primary">＋ お知らせを作成</a>
</div>

<div class="card">
    <div class="card__header">
        <div class="filter-tabs">
            <a href="{{ route('admin.news.index', ['filter' => 'all']) }}"
               class="filter-tab {{ $filter === 'all' ? 'active' : '' }}">すべて</a>
            <a href="{{ route('admin.news.index', ['filter' => 'published']) }}"
               class="filter-tab {{ $filter === 'published' ? 'active' : '' }}">公開中</a>
            <a href="{{ route('admin.news.index', ['filter' => 'draft']) }}"
               class="filter-tab {{ $filter === 'draft' ? 'active' : '' }}">下書き</a>
        </div>
        <span style="font-size:.82rem;color:#7b7b9a;">{{ $newsList->total() }} 件</span>
    </div>

    @if($newsList->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">📰</div>
            <div class="empty-state__text">お知らせはまだありません</div>
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>公開日</th>
                    <th>状態</th>
                    <th>作成日時</th>
                    <th style="width:120px;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newsList as $news)
                <tr style="cursor:pointer;" onclick="location.href='{{ route('admin.news.show', $news) }}'">
                    <td style="font-weight:600;">{{ $news->title }}</td>
                    <td style="color:#7b7b9a;white-space:nowrap;">
                        {{ $news->published_at ? $news->published_at->format('Y/m/d') : '—' }}
                    </td>
                    <td>
                        @if($news->published)
                            <span style="display:inline-block;padding:3px 10px;border-radius:50px;font-size:.75rem;font-weight:700;background:#e4f7f2;color:#1a7a5a;">公開中</span>
                        @else
                            <span style="display:inline-block;padding:3px 10px;border-radius:50px;font-size:.75rem;font-weight:700;background:#f0f2f8;color:#7b7b9a;">下書き</span>
                        @endif
                    </td>
                    <td style="color:#7b7b9a;white-space:nowrap;">
                        {{ $news->created_at->format('Y/m/d H:i') }}
                    </td>
                    <td onclick="event.stopPropagation()">
                        <div style="display:flex;gap:4px;">
                            <a href="{{ route('admin.news.show', $news) }}" class="btn btn--ghost btn--sm">詳細</a>
                            <a href="{{ route('admin.news.edit', $news) }}" class="btn btn--ghost btn--sm">編集</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="padding:16px 20px;">
        @if($newsList->hasPages())
        <div class="pagination">
            @if($newsList->onFirstPage())<span>‹</span>@else<a href="{{ $newsList->previousPageUrl() }}">‹</a>@endif
            @foreach($newsList->getUrlRange(1, $newsList->lastPage()) as $page => $url)
                @if($page == $newsList->currentPage())<span aria-current="page">{{ $page }}</span>@else<a href="{{ $url }}">{{ $page }}</a>@endif
            @endforeach
            @if($newsList->hasMorePages())<a href="{{ $newsList->nextPageUrl() }}">›</a>@else<span>›</span>@endif
        </div>
        @endif
    </div>
    @endif
</div>

@endsection
