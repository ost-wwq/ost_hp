@extends('admin.layouts.app')

@section('title', '内見予約一覧 - ' . $property->title)

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.properties.show', $property) }}" class="btn btn--ghost btn--sm">← 物件詳細に戻る</a>
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">内見予約申し込み一覧</h1>
    <span style="font-size:.85rem;color:#7b7b9a;">{{ $property->title }}</span>
</div>

<div class="card">
    <div class="card__header">
        <div class="card__title">内見予約 ({{ $viewings->count() }}件)</div>
    </div>
    <div class="card__body" style="padding:0;">
        @if($viewings->isEmpty())
            <div style="padding:40px;text-align:center;color:#7b7b9a;font-size:.9rem;">内見予約の申し込みはありません</div>
        @else
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#fafbfd;border-bottom:2px solid #e4e6f0;">
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">お名前</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">電話番号</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">メールアドレス</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">希望日時</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">申込日時</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewings as $viewing)
                    <tr style="border-bottom:1px solid #f0f2f8;cursor:pointer;transition:background .15s;"
                        onclick="location.href='{{ route('admin.properties.viewing-show', [$property, $viewing]) }}'"
                        onmouseover="this.style.background='#f8f9ff'" onmouseout="this.style.background=''">
                        <td style="padding:12px 16px;font-size:.88rem;font-weight:600;">{{ $viewing->name }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $viewing->phone }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $viewing->email }}</td>
                        <td style="padding:12px 16px;font-size:.85rem;">
                            @if($viewing->reserved_date)
                                {{ \Carbon\Carbon::parse($viewing->reserved_date)->format('Y/m/d') }}
                                @if($viewing->reserved_time)
                                    {{ $viewing->reserved_time }}
                                @endif
                            @else
                                <span style="color:#7b7b9a;">未設定</span>
                            @endif
                        </td>
                        <td style="padding:12px 16px;font-size:.82rem;color:#7b7b9a;">{{ $viewing->created_at->format('Y/m/d H:i') }}</td>
                        <td style="padding:12px 16px;">
                            <a href="{{ route('admin.properties.viewing-show', [$property, $viewing]) }}"
                               class="btn btn--ghost btn--sm" onclick="event.stopPropagation()">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
