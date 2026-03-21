@extends('admin.layouts.app')

@section('title', 'お問い合わせ管理')

@section('content')

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--blue">📨</div>
        <div>
            <div class="stat-card__num">{{ \App\Models\Contact::count() }}</div>
            <div class="stat-card__label">総お問い合わせ数</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--orange">🔔</div>
        <div>
            <div class="stat-card__num">{{ $unreadCount }}</div>
            <div class="stat-card__label">未読</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--teal">✅</div>
        <div>
            <div class="stat-card__num">{{ \App\Models\Contact::whereNotNull('read_at')->count() }}</div>
            <div class="stat-card__label">既読</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card__header">
        <div class="filter-tabs">
            <a href="{{ route('admin.contacts.index', ['filter' => 'all']) }}"
               class="filter-tab {{ $filter === 'all' ? 'active' : '' }}">すべて</a>
            <a href="{{ route('admin.contacts.index', ['filter' => 'unread']) }}"
               class="filter-tab {{ $filter === 'unread' ? 'active' : '' }}">
                未読
                @if($unreadCount > 0)
                    <span style="background:#f17c20;color:#fff;font-size:.7rem;padding:1px 6px;border-radius:50px;margin-left:4px;">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.contacts.index', ['filter' => 'read']) }}"
               class="filter-tab {{ $filter === 'read' ? 'active' : '' }}">既読</a>
        </div>
        <div style="display:flex;gap:8px;align-items:center;">
            <span style="font-size:.82rem;color:#7b7b9a;">{{ $contacts->total() }} 件</span>
        </div>
    </div>

    @if($contacts->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">📭</div>
            <div class="empty-state__text">お問い合わせはまだありません</div>
        </div>
    @else
    <form method="POST" action="{{ route('admin.contacts.bulk-destroy') }}" id="bulkForm">
        @csrf
        @method('DELETE')
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:40px;">
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th>状態</th>
                        <th>お名前</th>
                        <th>メールアドレス</th>
                        <th>件名</th>
                        <th>受信日時</th>
                        <th style="width:100px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr class="{{ $contact->isUnread() ? 'unread' : '' }}">
                        <td>
                            <input type="checkbox" name="ids[]" value="{{ $contact->id }}" class="row-check">
                        </td>
                        <td>
                            @if($contact->isUnread())
                                <span class="badge-unread">● 未読</span>
                            @else
                                <span class="badge-read">既読</span>
                            @endif
                        </td>
                        <td style="font-weight:{{ $contact->isUnread() ? '700' : '400' }};">
                            {{ $contact->name }}
                        </td>
                        <td style="color:#2f7cff;">{{ $contact->email }}</td>
                        <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $contact->subject ?: '（件名なし）' }}
                        </td>
                        <td style="color:#7b7b9a;white-space:nowrap;">
                            {{ $contact->created_at->format('Y/m/d H:i') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn--ghost btn--sm">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="padding:16px 20px;border-top:1px solid #f0f2f8;display:flex;align-items:center;gap:12px;">
            <button type="button" id="bulkDeleteBtn" class="btn btn--danger btn--sm" disabled>
                選択した項目を削除
            </button>
            <span id="selectedCount" style="font-size:.8rem;color:#7b7b9a;"></span>
        </div>
    </form>

    <div style="padding:0 20px 20px;">
        @if($contacts->hasPages())
        <div class="pagination">
            {{-- Previous --}}
            @if($contacts->onFirstPage())
                <span>‹</span>
            @else
                <a href="{{ $contacts->previousPageUrl() }}">‹</a>
            @endif

            {{-- Pages --}}
            @foreach($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                @if($page == $contacts->currentPage())
                    <span aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if($contacts->hasMorePages())
                <a href="{{ $contacts->nextPageUrl() }}">›</a>
            @else
                <span>›</span>
            @endif
        </div>
        @endif
    </div>
    @endif
</div>

<script>
(function() {
    var checkAll = document.getElementById('checkAll');
    var rowChecks = document.querySelectorAll('.row-check');
    var bulkBtn = document.getElementById('bulkDeleteBtn');
    var countEl = document.getElementById('selectedCount');

    function updateBulkBtn() {
        var checked = document.querySelectorAll('.row-check:checked').length;
        bulkBtn.disabled = checked === 0;
        countEl.textContent = checked > 0 ? checked + ' 件選択中' : '';
    }

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            rowChecks.forEach(function(c) { c.checked = checkAll.checked; });
            updateBulkBtn();
        });
    }

    rowChecks.forEach(function(c) {
        c.addEventListener('change', updateBulkBtn);
    });

    if (bulkBtn) {
        bulkBtn.addEventListener('click', function() {
            var count = document.querySelectorAll('.row-check:checked').length;
            if (confirm(count + ' 件のお問い合わせを削除しますか？この操作は元に戻せません。')) {
                document.getElementById('bulkForm').submit();
            }
        });
    }
})();
</script>

@endsection
