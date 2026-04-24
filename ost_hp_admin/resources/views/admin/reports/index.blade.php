@extends('admin.layouts.app')

@section('title', '報告履歴')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <h1 style="font-size:1.1rem;font-weight:700;margin:0;">報告履歴</h1>
    <a href="{{ route('admin.reports.create') }}" class="btn btn--primary btn--sm">＋ 新規報告を送信</a>
</div>

<div class="card">
    <div class="card__header">
        <div class="card__title">送信済み報告一覧 ({{ $reports->total() }}件)</div>
    </div>
    <div class="card__body" style="padding:0;">
        @if($reports->isEmpty())
            <div style="padding:40px;text-align:center;color:#7b7b9a;font-size:.9rem;">報告の送信履歴はありません</div>
        @else
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#fafbfd;border-bottom:2px solid #e4e6f0;">
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">対象期間</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">送信先</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:center;">掲載承諾</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:center;">内見申請</th>
                        <th style="padding:10px 16px;font-size:.75rem;font-weight:700;color:#7b7b9a;text-align:left;">送信日時</th>
                        <th style="padding:10px 16px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                    <tr style="border-bottom:1px solid #f0f2f8;cursor:pointer;transition:background .15s;"
                        onclick="location.href='{{ route('admin.reports.show', $report) }}'"
                        onmouseover="this.style.background='#f8f9ff'" onmouseout="this.style.background=''">
                        <td style="padding:12px 16px;font-size:.88rem;font-weight:600;">
                            {{ $report->date_from->format('Y/m/d') }} 〜 {{ $report->date_to->format('Y/m/d') }}
                        </td>
                        <td style="padding:12px 16px;font-size:.85rem;">{{ $report->sent_to }}</td>
                        <td style="padding:12px 16px;font-size:.95rem;font-weight:700;color:#2f7cff;text-align:center;">{{ $report->consents_count }}</td>
                        <td style="padding:12px 16px;font-size:.95rem;font-weight:700;color:#2f7cff;text-align:center;">{{ $report->viewings_count }}</td>
                        <td style="padding:12px 16px;font-size:.82rem;color:#7b7b9a;">{{ $report->created_at->format('Y/m/d H:i') }}</td>
                        <td style="padding:12px 16px;">
                            <a href="{{ route('admin.reports.show', $report) }}"
                               class="btn btn--ghost btn--sm" onclick="event.stopPropagation()">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($reports->hasPages())
                <div style="padding:16px 24px;">{{ $reports->links() }}</div>
            @endif
        @endif
    </div>
</div>

@endsection
