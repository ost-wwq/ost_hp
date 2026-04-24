@extends('admin.layouts.app')

@section('title', 'オーナー管理')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">オーナー管理</h1>
    <a href="{{ route('admin.owners.create') }}" class="btn btn--primary btn--sm">＋ 新規登録</a>
</div>

<div class="card">
    @if($owners->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">👤</div>
            <div class="empty-state__text">オーナーが登録されていません</div>
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>氏名</th>
                    <th>フリガナ</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>物件数</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($owners as $owner)
                <tr>
                    <td style="font-weight:600;">{{ $owner->name }}</td>
                    <td style="color:#7b7b9a;font-size:.85rem;">{{ $owner->kana ?? '—' }}</td>
                    <td style="font-size:.85rem;">{{ $owner->phone ?? '—' }}</td>
                    <td style="font-size:.85rem;word-break:break-all;">{{ $owner->email ?? '—' }}</td>
                    <td>
                        <span style="display:inline-block;padding:2px 10px;border-radius:50px;background:#e8f0fe;color:#2f7cff;font-size:.78rem;font-weight:700;">
                            {{ $owner->properties_count }}件
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                        <a href="{{ route('admin.owners.show', $owner) }}" class="btn btn--ghost btn--sm">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection
