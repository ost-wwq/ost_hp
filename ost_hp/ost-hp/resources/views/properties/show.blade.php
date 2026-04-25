@extends('layouts.app')

@section('title', $property->title . ' | ワンステップテックス不動産')

@section('content')

<nav id="navbar" class="navbar scrolled">
    <div class="container navbar__inner">
        <a href="{{ url('/') }}" class="navbar__logo" style="color:var(--dark);">
            <span class="navbar__logo-icon">🏠</span>
            <span class="navbar__logo-text">ワンステップテックス不動産</span>
        </a>
        <ul class="navbar__menu" style="display:flex;">
            <li><a href="{{ url('/') }}" class="navbar__link" style="color:var(--text);">ホーム</a></li>
            <li><a href="{{ route('properties.index') }}" class="navbar__link" style="color:var(--text);">物件一覧</a></li>
            <li><a href="{{ url('/') }}#contact" class="navbar__link navbar__link--cta" style="background:var(--blue);color:#fff !important;">お問い合わせ</a></li>
        </ul>
    </div>
</nav>

<div style="padding-top:72px;"></div>

<!-- パンくず -->
<div style="background:#fff;border-bottom:1px solid var(--border);padding:12px 0;">
    <div class="container">
        <nav style="font-size:.82rem;color:var(--text-light);display:flex;gap:8px;align-items:center;">
            <a href="{{ url('/') }}" style="color:var(--blue);">ホーム</a>
            <span>›</span>
            <a href="{{ route('properties.index') }}" style="color:var(--blue);">物件一覧</a>
            <span>›</span>
            <span>{{ $property->title }}</span>
        </nav>
    </div>
</div>

<section style="padding:48px 0;background:var(--bg-light);">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 360px;gap:40px;align-items:start;">

            <!-- 左: 画像 + 詳細 -->
            <div>
                <!-- メイン画像 -->
                <div style="border-radius:16px;overflow:hidden;background:#f0f2f8;margin-bottom:16px;aspect-ratio:16/9;">
                    @if($property->main_image_data)
                        <img src="{{ route('properties.main-image', $property) }}" alt="{{ $property->title }}"
                             style="width:100%;height:100%;object-fit:cover;" id="mainImg">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:4rem;background:var(--blue-light);">🏠</div>
                    @endif
                </div>

                <!-- サムネイル -->
                @php
                    $thumbUrls = [];
                    if ($property->main_image_data) $thumbUrls[] = route('properties.main-image', $property);
                    foreach ($property->images ?? [] as $key) {
                        $thumbUrls[] = route('properties.image', [$property, $key]);
                    }
                @endphp
                @if(count($thumbUrls) > 1)
                <div style="display:flex;gap:8px;margin-bottom:28px;overflow-x:auto;">
                    @foreach($thumbUrls as $i => $imgUrl)
                    <img src="{{ $imgUrl }}" alt=""
                         onclick="document.getElementById('mainImg').src=this.src"
                         style="width:80px;height:64px;object-fit:cover;border-radius:8px;border:2px solid {{ $i===0 ? 'var(--blue)' : 'var(--border)' }};cursor:pointer;flex-shrink:0;transition:.2s;"
                         onmouseover="this.style.borderColor='var(--blue)'" onmouseout="">
                    @endforeach
                </div>
                @endif

                <!-- 物件詳細 -->
                <div style="background:#fff;border-radius:16px;border:1px solid var(--border);overflow:hidden;">
                    <div style="padding:20px 24px;border-bottom:1px solid var(--border);">
                        <h2 style="font-size:1.1rem;font-weight:700;">物件詳細</h2>
                    </div>
                    <dl style="display:grid;grid-template-columns:140px 1fr;">
                        @php
                        $specs = [
                            '種別'   => $property->typeLabel(),
                            '所在地' => $property->address,
                            '価格'   => $property->priceFormatted(),
                            '間取り' => $property->rooms,
                            '面積'   => $property->area ? number_format($property->area,1).'㎡' : null,
                            '築年数' => $property->age !== null ? $property->age.'年' : null,
                            'ステータス' => $property->statusLabel(),
                        ];
                        @endphp
                        @foreach($specs as $label => $value)
                        @if($value)
                        <div style="display:contents;">
                            <dt style="padding:14px 16px;border-bottom:1px solid #f0f2f8;font-size:.78rem;font-weight:700;color:var(--text-light);text-transform:uppercase;letter-spacing:.05em;background:#f8f9ff;">{{ $label }}</dt>
                            <dd style="padding:14px 16px;border-bottom:1px solid #f0f2f8;font-size:.93rem;font-weight:{{ $label==='価格'?'700':'400' }};color:{{ $label==='価格'?'var(--blue)':'var(--dark)' }};">{{ $value }}</dd>
                        </div>
                        @endif
                        @endforeach
                    </dl>
                </div>

                <!-- 物件説明 -->
                @if($property->description)
                <div style="background:#fff;border-radius:16px;border:1px solid var(--border);padding:24px;margin-top:20px;">
                    <h3 style="font-size:1rem;font-weight:700;margin-bottom:16px;">物件説明</h3>
                    <p style="font-size:.93rem;color:var(--text);line-height:1.85;white-space:pre-wrap;">{{ $property->description }}</p>
                </div>
                @endif
            </div>

            <!-- 右: サイドバー -->
            <div style="position:sticky;top:88px;display:flex;flex-direction:column;gap:20px;">

                <div style="background:#fff;border-radius:16px;border:1px solid var(--border);padding:24px;">
                    @php $sc = $property->statusColor(); @endphp
                    <span style="display:inline-block;padding:4px 12px;border-radius:50px;font-size:.75rem;font-weight:700;margin-bottom:12px;
                        background:{{ $sc==='teal'?'var(--teal-light)':($sc==='orange'?'var(--orange-light)':'#f0f2f8') }};
                        color:{{ $sc==='teal'?'#1a7a5a':($sc==='orange'?'#c96400':'#7b7b9a') }};">
                        {{ $property->statusLabel() }}
                    </span>
                    <h1 style="font-size:1.15rem;font-weight:700;margin-bottom:8px;line-height:1.4;">{{ $property->title }}</h1>
                    <div style="font-size:.85rem;color:var(--text-light);margin-bottom:16px;">📍 {{ $property->address }}</div>
                    <div style="font-size:1.8rem;font-weight:700;color:var(--blue);margin-bottom:4px;">{{ $property->priceFormatted() }}</div>
                    @if($property->rooms || $property->area)
                    <div style="font-size:.85rem;color:var(--text-light);margin-bottom:20px;display:flex;gap:12px;">
                        @if($property->rooms)<span>🚪 {{ $property->rooms }}</span>@endif
                        @if($property->area)<span>📐 {{ number_format($property->area,1) }}㎡</span>@endif
                    </div>
                    @endif
                    <a href="{{ url('/') }}#contact" class="btn btn--primary" style="width:100%;justify-content:center;margin-bottom:10px;">この物件を問い合わせる</a>
                    <a href="tel:03-XXXX-XXXX" class="btn btn--outline" style="border:2px solid var(--blue);color:var(--blue);width:100%;justify-content:center;">📞 電話で問い合わせる</a>
                </div>

                <div style="background:var(--blue-light);border-radius:16px;padding:20px;border:1px solid rgba(47,124,255,.15);">
                    <div style="font-size:.85rem;font-weight:700;color:var(--blue);margin-bottom:8px;">🕐 営業時間</div>
                    <div style="font-size:.88rem;color:var(--text);">平日 9:00〜18:00<br>土日祝もご相談可能</div>
                </div>
            </div>
        </div>

        <!-- 関連物件 -->
        @if($related->isNotEmpty())
        <div style="margin-top:60px;">
            <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:28px;">同じ種別の物件</h2>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
                @foreach($related as $p)
                <a href="{{ route('properties.show', $p) }}" class="prop-card">
                    <div class="prop-card__img" style="height:160px;">
                        @if($p->main_image_data)<img src="{{ route('properties.main-image', $p) }}" alt="{{ $p->title }}">
                        @else<div class="prop-card__img-placeholder">🏠</div>@endif
                        <div class="prop-card__badges">
                            <span class="prop-badge prop-badge--{{ $p->statusColor() }}">{{ $p->statusLabel() }}</span>
                        </div>
                    </div>
                    <div class="prop-card__body">
                        <div class="prop-card__price">{{ $p->priceFormatted() }}</div>
                        <h3 class="prop-card__title">{{ $p->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

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
.prop-card:hover { transform:translateY(-4px); box-shadow:0 10px 30px rgba(43,45,66,.12); }
.prop-card__img { position:relative; overflow:hidden; background:#f0f2f8; }
.prop-card__img img { width:100%; height:100%; object-fit:cover; }
.prop-card__img-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:2rem; background:var(--blue-light); }
.prop-card__badges { position:absolute; top:8px; left:8px; display:flex; gap:4px; }
.prop-badge { padding:2px 8px; border-radius:50px; font-size:.7rem; font-weight:700; }
.prop-badge--teal { background:var(--teal-light); color:#1a7a5a; }
.prop-badge--orange { background:var(--orange-light); color:#c96400; }
.prop-badge--gray { background:#f0f2f8; color:#7b7b9a; }
.prop-card__body { padding:16px; }
.prop-card__price { font-size:1.1rem; font-weight:700; color:var(--blue); margin-bottom:4px; }
.prop-card__title { font-size:.9rem; font-weight:700; color:var(--dark); line-height:1.4; }
@media(max-width:768px){ section div[style*="grid-template-columns:1fr 360px"] { grid-template-columns:1fr !important; } }
</style>
@endsection
