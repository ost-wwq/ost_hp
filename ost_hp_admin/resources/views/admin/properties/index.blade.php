@extends('admin.layouts.app')

@section('title', '物件管理')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
    <div></div>
    <a href="{{ route('admin.properties.create') }}" class="btn btn--primary">＋ 物件を登録</a>
</div>

{{-- Stats --}}
<div class="stats-row" style="grid-template-columns:repeat(5,1fr);">
    @php
        use App\Models\Property;
        $total     = Property::count();
        $published = Property::where('published', true)->count();
        $available = Property::where('status','available')->count();
        $contract  = Property::where('status','contract')->count();
        $closed    = Property::where('status','closed')->count();
    @endphp
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--blue">🏠</div>
        <div><div class="stat-card__num">{{ $total }}</div><div class="stat-card__label">総物件数</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--teal">🌐</div>
        <div><div class="stat-card__num">{{ $published }}</div><div class="stat-card__label">公開中</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--teal">✅</div>
        <div><div class="stat-card__num">{{ $available }}</div><div class="stat-card__label">販売中</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--orange">🤝</div>
        <div><div class="stat-card__num">{{ $contract }}</div><div class="stat-card__label">商談中</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon" style="background:#f0f2f8;">🔒</div>
        <div><div class="stat-card__num">{{ $closed }}</div><div class="stat-card__label">成約済み</div></div>
    </div>
</div>

<div class="card">
    <div class="card__header">
        <div class="filter-tabs">
            @foreach(['all'=>'すべて','published'=>'公開中','draft'=>'非公開','available'=>'販売中','contract'=>'商談中','closed'=>'成約済み'] as $key => $label)
            <a href="{{ route('admin.properties.index', ['filter'=>$key]) }}"
               class="filter-tab {{ $filter === $key ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>
        <span style="font-size:.82rem;color:#7b7b9a;">{{ $properties->total() }} 件</span>
    </div>

    @if($properties->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">🏚</div>
            <div class="empty-state__text">物件がまだ登録されていません</div>
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:56px;">画像</th>
                    <th>物件名</th>
                    <th>種別</th>
                    <th>価格</th>
                    <th>所在地</th>
                    <th>ステータス</th>
                    <th>公開</th>
                    <th style="width:120px;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $p)
                <tr>
                    <td>
                        @if($p->main_image)
                            <img src="{{ asset('uploads/'.$p->main_image) }}" alt=""
                                 style="width:48px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #e4e6f0;">
                        @else
                            <div style="width:48px;height:40px;background:#f0f2f8;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🏠</div>
                        @endif
                    </td>
                    <td style="font-weight:600;">
                        <a href="{{ route('admin.properties.show', $p) }}" style="color:#2f7cff;">{{ $p->title }}</a>
                        @if($p->rooms)<div style="font-size:.78rem;color:#7b7b9a;font-weight:400;">{{ $p->rooms }}</div>@endif
                    </td>
                    <td><span style="font-size:.82rem;">{{ $p->typeLabel() }}</span></td>
                    <td style="font-weight:700;white-space:nowrap;">{{ $p->priceFormatted() }}</td>
                    <td style="font-size:.82rem;color:#7b7b9a;max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $p->address }}</td>
                    <td>
                        @php $sc = $p->statusColor(); @endphp
                        <span style="
                            display:inline-block;padding:3px 10px;border-radius:50px;font-size:.75rem;font-weight:700;
                            background:{{ $sc==='teal'?'#e4f7f2':($sc==='orange'?'#fef0e4':'#f0f2f8') }};
                            color:{{ $sc==='teal'?'#1a7a5a':($sc==='orange'?'#c96400':'#7b7b9a') }};">
                            {{ $p->statusLabel() }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.properties.toggle-publish', $p) }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn--sm {{ $p->published ? 'btn--primary' : 'btn--ghost' }}" title="{{ $p->published ? '公開中（クリックで非公開）' : '非公開（クリックで公開）' }}">
                                {{ $p->published ? '公開中' : '非公開' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <div style="display:flex;gap:4px;">
                            <a href="{{ route('admin.properties.edit', $p) }}" class="btn btn--ghost btn--sm">編集</a>
                            <form method="POST" action="{{ route('admin.properties.destroy', $p) }}"
                                  onsubmit="return confirm('「{{ $p->title }}」を削除しますか？')">
                                @csrf @method('DELETE')
                                <button class="btn btn--danger btn--sm">削除</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="padding:16px 20px;">
        @if($properties->hasPages())
        <div class="pagination">
            @if($properties->onFirstPage())<span>‹</span>@else<a href="{{ $properties->previousPageUrl() }}">‹</a>@endif
            @foreach($properties->getUrlRange(1, $properties->lastPage()) as $page => $url)
                @if($page == $properties->currentPage())<span aria-current="page">{{ $page }}</span>@else<a href="{{ $url }}">{{ $page }}</a>@endif
            @endforeach
            @if($properties->hasMorePages())<a href="{{ $properties->nextPageUrl() }}">›</a>@else<span>›</span>@endif
        </div>
        @endif
    </div>
    @endif
</div>
@endsection
