@extends('layouts.app')

@section('title', '物件一覧 | ワンステップテックス不動産')

@section('content')

<!-- ナビゲーション（再利用） -->
<nav id="navbar" class="navbar navbar--dark">
    <div class="container navbar__inner">
        <a href="{{ url('/') }}" class="navbar__logo">
            <span class="navbar__logo-icon">🏠</span>
            <span class="navbar__logo-text">ワンステップテックス不動産</span>
        </a>
        <ul class="navbar__menu">
            <li><a href="{{ url('/') }}" class="navbar__link">ホーム</a></li>
            <li><a href="{{ route('properties.index') }}" class="navbar__link navbar__link--active">物件一覧</a></li>
            <li><a href="{{ url('/') }}#contact" class="navbar__link navbar__link--cta">お問い合わせ</a></li>
        </ul>
    </div>
</nav>

<!-- ページヘッダー -->
<section style="padding:120px 0 60px;background:linear-gradient(135deg,#1a4cbd 0%,#2f7cff 100%);">
    <div class="container" style="text-align:center;">
        <p style="color:rgba(255,255,255,.7);font-size:.85rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:12px;">Properties</p>
        <h1 style="color:#fff;font-size:clamp(1.8rem,3vw,2.6rem);font-weight:700;margin-bottom:12px;">物件一覧</h1>
        <p style="color:rgba(255,255,255,.8);">現在掲載中の物件をご覧ください</p>
    </div>
</section>

<!-- フィルター -->
<section style="background:#fff;border-bottom:1px solid var(--border);padding:0;">
    <div class="container">
        <div style="display:flex;gap:0;overflow-x:auto;-webkit-overflow-scrolling:touch;">
            @foreach(['all'=>'すべて','available'=>'販売中','contract'=>'商談中'] as $val => $label)
            <a href="{{ route('properties.index', array_merge(request()->query(), ['status'=>$val])) }}"
               style="padding:16px 24px;font-size:.88rem;font-weight:600;white-space:nowrap;border-bottom:2px solid {{ $status===$val ? 'var(--blue)' : 'transparent' }};color:{{ $status===$val ? 'var(--blue)' : 'var(--text-light)' }};transition:.2s;">
                {{ $label }}
            </a>
            @endforeach
            <div style="margin-left:auto;display:flex;align-items:center;gap:8px;padding:8px 0;">
                @foreach(\App\Models\Property::typeOptions() as $val => $label)
                <a href="{{ route('properties.index', array_merge(request()->query(), ['type'=>$val])) }}"
                   style="padding:6px 14px;border-radius:50px;font-size:.78rem;font-weight:600;border:1px solid {{ $type===$val ? 'var(--blue)' : 'var(--border)' }};background:{{ $type===$val ? 'var(--blue)' : 'transparent' }};color:{{ $type===$val ? '#fff' : 'var(--text)' }};">
                    {{ $label }}
                </a>
                @endforeach
                @if($type)
                <a href="{{ route('properties.index', array_filter(request()->query(), fn($k)=>$k!=='type', ARRAY_FILTER_USE_KEY)) }}"
                   style="font-size:.78rem;color:var(--text-light);">✕ 解除</a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- 物件グリッド -->
<section style="padding:60px 0;background:var(--bg-light);">
    <div class="container">
        @if($properties->isEmpty())
            <div style="text-align:center;padding:80px 24px;color:var(--text-light);">
                <div style="font-size:3rem;margin-bottom:16px;">🏚</div>
                <p>条件に合う物件が見つかりませんでした</p>
                <a href="{{ route('properties.index') }}" style="display:inline-block;margin-top:16px;color:var(--blue);">すべての物件を見る →</a>
            </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:28px;">
            @foreach($properties as $p)
            <a href="{{ route('properties.show', $p) }}" class="prop-card">
                <div class="prop-card__img">
                    @if($p->main_image)
                        <img src="{{ asset('uploads/'.$p->main_image) }}" alt="{{ $p->title }}">
                    @else
                        <div class="prop-card__img-placeholder">🏠</div>
                    @endif
                    <div class="prop-card__badges">
                        @php $sc = $p->statusColor(); @endphp
                        <span class="prop-badge prop-badge--{{ $sc }}">{{ $p->statusLabel() }}</span>
                        <span class="prop-badge prop-badge--type">{{ $p->typeLabel() }}</span>
                    </div>
                </div>
                <div class="prop-card__body">
                    <div class="prop-card__price">{{ $p->priceFormatted() }}</div>
                    <h3 class="prop-card__title">{{ $p->title }}</h3>
                    <div class="prop-card__meta">
                        @if($p->rooms)<span>🚪 {{ $p->rooms }}</span>@endif
                        @if($p->area)<span>📐 {{ number_format($p->area, 1) }}㎡</span>@endif
                        @if($p->age !== null)<span>🏗 築{{ $p->age }}年</span>@endif
                    </div>
                    <div class="prop-card__address">📍 {{ $p->address }}</div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- ページネーション --}}
        @if($properties->hasPages())
        <div style="display:flex;gap:4px;justify-content:center;margin-top:48px;">
            @if($properties->onFirstPage())<span class="pg-btn pg-btn--disabled">‹</span>@else<a href="{{ $properties->previousPageUrl() }}" class="pg-btn">‹</a>@endif
            @foreach($properties->getUrlRange(1,$properties->lastPage()) as $page=>$url)
                @if($page==$properties->currentPage())<span class="pg-btn pg-btn--active">{{ $page }}</span>@else<a href="{{ $url }}" class="pg-btn">{{ $page }}</a>@endif
            @endforeach
            @if($properties->hasMorePages())<a href="{{ $properties->nextPageUrl() }}" class="pg-btn">›</a>@else<span class="pg-btn pg-btn--disabled">›</span>@endif
        </div>
        @endif
        @endif
    </div>
</section>

<!-- フッター -->
<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="footer__brand">
                <a href="{{ url('/') }}" class="footer__logo"><span>🏠</span><span>ワンステップテックス不動産</span></a>
                <p class="footer__tagline">お客様一人ひとりに最適なご提案</p>
            </div>
            <div class="footer__links">
                <div class="footer__links-group">
                    <h4>メニュー</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">ホーム</a></li>
                        <li><a href="{{ route('properties.index') }}">物件一覧</a></li>
                        <li><a href="{{ url('/') }}#contact">お問い合わせ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__bottom"><p>&copy; {{ date('Y') }} ワンステップテックス不動産.</p></div>
    </div>
</footer>

<style>
.prop-card { display:block; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 8px rgba(43,45,66,.08); border:1px solid var(--border); transition:.25s; }
.prop-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(43,45,66,.14); border-color:transparent; }
.prop-card__img { position:relative; height:200px; overflow:hidden; background:#f0f2f8; }
.prop-card__img img { width:100%; height:100%; object-fit:cover; transition:.3s; }
.prop-card:hover .prop-card__img img { transform:scale(1.04); }
.prop-card__img-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:3rem; background:var(--blue-light); }
.prop-card__badges { position:absolute; top:12px; left:12px; display:flex; gap:6px; }
.prop-badge { padding:3px 10px; border-radius:50px; font-size:.72rem; font-weight:700; }
.prop-badge--teal { background:var(--teal-light); color:#1a7a5a; }
.prop-badge--orange { background:var(--orange-light); color:#c96400; }
.prop-badge--gray { background:#f0f2f8; color:#7b7b9a; }
.prop-badge--type { background:rgba(0,0,0,.5); color:#fff; }
.prop-card__body { padding:20px; }
.prop-card__price { font-size:1.3rem; font-weight:700; color:var(--blue); margin-bottom:6px; }
.prop-card__title { font-size:1rem; font-weight:700; color:var(--dark); margin-bottom:10px; line-height:1.4; }
.prop-card__meta { display:flex; flex-wrap:wrap; gap:10px; font-size:.82rem; color:var(--text-light); margin-bottom:8px; }
.prop-card__address { font-size:.8rem; color:var(--text-light); }
.pg-btn { min-width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:.85rem; font-weight:600; color:#7b7b9a; border:1px solid var(--border); background:#fff; }
.pg-btn--active { background:var(--blue); color:#fff; border-color:var(--blue); }
.pg-btn--disabled { opacity:.4; cursor:default; }
a.pg-btn:hover { border-color:var(--blue); color:var(--blue); }
</style>
@endsection
