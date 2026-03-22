@extends('layouts.app')

@section('title', '不動産売却フロー｜ワンステップテックス不動産')

@section('content')

{{-- ========== NAVBAR ========== --}}
<nav id="navbar" class="navbar navbar--dark">
    <div class="container navbar__inner">
        <a href="{{ url('/') }}" class="navbar__logo">
            <img src="{{ asset('ost_icon_20260321.jpg') }}" alt="ロゴ" class="navbar__logo-icon">
            <span class="navbar__logo-text">ワンステップテックス不動産</span>
        </a>
        <button class="navbar__toggle" id="navToggle" aria-label="メニュー">
            <span></span><span></span><span></span>
        </button>
        <ul class="navbar__menu" id="navMenu">
            <li><a href="{{ url('/') }}" class="navbar__link">ホーム</a></li>
            <li><a href="{{ url('/properties') }}" class="navbar__link">物件一覧</a></li>
            <li class="navbar__dropdown is-open" id="navDropdownFlow">
                <a href="#" class="navbar__link navbar__dropdown-toggle navbar__link--active" id="navDropdownFlowToggle">
                    フロー
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ url('/flow') }}" class="navbar__dropdown-link">購入フロー</a></li>
                    <li><a href="{{ url('/selling-flow') }}" class="navbar__dropdown-link navbar__dropdown-link--active">売却フロー</a></li>
                    <li><a href="{{ url('/rental-flow') }}" class="navbar__dropdown-link">貸出フロー</a></li>
                    <li><a href="{{ url('/renting-flow') }}" class="navbar__dropdown-link">賃借フロー</a></li>
                </ul>
            </li>
            <li class="navbar__dropdown" id="navDropdownOther">
                <a href="#" class="navbar__link navbar__dropdown-toggle" id="navDropdownOtherToggle">
                    その他
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ url('/company') }}" class="navbar__dropdown-link">会社情報</a></li>
                    <li><a href="{{ url('/') }}#faq" class="navbar__dropdown-link">よくある質問</a></li>
                    <li><a href="{{ url('/commission') }}" class="navbar__dropdown-link">報酬額</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/') }}#contact" class="navbar__link navbar__link--cta">お問い合わせ</a></li>
        </ul>
    </div>
</nav>

{{-- ========== HERO ========== --}}
<section class="flow-hero flow-hero--sell">
    <div class="flow-hero__bg"></div>
    <div class="container flow-hero__inner">
        <p class="section-label" style="color:#fcd34d;">Selling Flow</p>
        <h1 class="flow-hero__title">不動産売却フロー</h1>
        <p class="flow-hero__desc">
            はじめて不動産を売却される方も安心。<br>
            査定依頼から引渡し完了まで、8つのステップをわかりやすくご説明します。
        </p>
        <div class="flow-hero__steps-count">
            <span class="flow-hero__steps-num">8</span>
            <span class="flow-hero__steps-label">STEPS</span>
        </div>
    </div>
    <div class="flow-hero__wave">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80V40C240 0 480 60 720 40S1200 0 1440 40V80H0Z" fill="#f8f9ff"/>
        </svg>
    </div>
</section>

{{-- ========== OVERVIEW TIMELINE ========== --}}
<section class="flow-overview">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Overview</p>
            <h2 class="section-title">売却までの全体の流れ</h2>
            <p class="section-desc">一般的に売却活動開始から引渡しまで3〜6ヶ月程度かかります</p>
        </div>

        <div class="flow-timeline">
            @php
$icons = [
  'chat'      => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg>',
  'search'    => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>',
  'edit'      => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>',
  'bank'      => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>',
  'clipboard' => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" /></svg>',
  'check'     => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
  'money'     => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>',
  'home'      => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>',
  'document'  => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>',
  'announce'  => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 1 8.835-2.535m0 0A23.74 23.74 0 0 1 18.795 3c.38 0 .75.02 1.118.06A2.67 2.67 0 0 1 22.5 5.673v8.154c0 1.335-.955 2.51-2.28 2.637a23.676 23.676 0 0 1-1.22.06m0-13.5a23.74 23.74 0 0 0-3.454-.22c-.38 0-.75.02-1.118.06" /></svg>',
  'handshake' => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>',
  'build'     => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" /></svg>',
  'key'       => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 0 1 21.75 8.25Z" /></svg>',
  'shield'    => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>',
  'bulb'      => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" /></svg>',
  'warn'      => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>',
  'pin'       => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>',
  'celebrate' => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" /></svg>',
  'building'  => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>',
  'fire'      => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" /></svg>',
  'chart'     => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>',
  'tools'     => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" /></svg>',
  'house'     => '<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" /></svg>',
];
@endphp
            @php
            $steps = [
                ['num'=>'01','icon'=>'chat','label'=>'査定依頼・ご相談','color'=>'sell-a','duration'=>'随時'],
                ['num'=>'02','icon'=>'search','label'=>'物件査定・価格提案','color'=>'sell-a','duration'=>'1〜3日'],
                ['num'=>'03','icon'=>'document','label'=>'媒介契約締結','color'=>'sell-b','duration'=>'1〜3日'],
                ['num'=>'04','icon'=>'announce','label'=>'売却活動・内覧対応','color'=>'sell-b','duration'=>'1〜3ヶ月'],
                ['num'=>'05','icon'=>'handshake','label'=>'購入申込・条件交渉','color'=>'sell-b','duration'=>'数日'],
                ['num'=>'06','icon'=>'clipboard','label'=>'重要事項説明・売買契約','color'=>'sell-c','duration'=>'1日'],
                ['num'=>'07','icon'=>'build','label'=>'引渡し準備','color'=>'sell-c','duration'=>'1〜2ヶ月'],
                ['num'=>'08','icon'=>'money','label'=>'残金決済・引渡し完了','color'=>'sell-c','duration'=>'1日'],
            ];
            @endphp

            @foreach($steps as $i => $s)
            <div class="flow-timeline__item reveal">
                <div class="flow-timeline__dot flow-timeline__dot--{{ $s['color'] }}">
                    {!! $icons[$s['icon']] !!}
                </div>
                <div class="flow-timeline__content">
                    <span class="flow-timeline__num">STEP {{ $s['num'] }}</span>
                    <div class="flow-timeline__label">{{ $s['label'] }}</div>
                    <span class="flow-timeline__dur">目安: {{ $s['duration'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== STEP DETAILS ========== --}}
<section class="flow-steps">
    <div class="container">

        {{-- STEP 01 --}}
        <div class="step-card reveal" id="step01">
            <div class="step-card__header step-card__header--sell-a">
                <div class="step-card__num">STEP 01</div>
                <div class="step-card__icon">{!! $icons['chat'] !!}</div>
                <h3 class="step-card__title">査定依頼・ご相談</h3>
                <p class="step-card__subtitle">まずはお気軽にご連絡ください</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            売却をご検討中の方は、まず当社へお問い合わせください。
                            「いくらで売れるのか知りたい」「売るべきか迷っている」など、
                            どんな段階のご相談でも無料で対応いたします。
                        </p>
                        <h4 class="step-card__check-title">この段階でお伺いすること</h4>
                        <ul class="step-card__checklist">
                            <li>売却をお考えの理由・背景</li>
                            <li>希望売却時期と価格のイメージ</li>
                            <li>物件の概要（所在地・築年・間取りなど）</li>
                            <li>ローン残債の有無</li>
                            <li>売却後のご予定（住み替えなど）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-a">
                            <div class="step-tip__icon">{!! $icons['bulb'] !!}</div>
                            <div class="step-tip__title">担当者からのアドバイス</div>
                            <p class="step-tip__text">
                                「まだ売ると決めていない」という段階でも大丈夫です。
                                相場を知るだけでも今後の計画が立てやすくなります。査定は無料・無義務です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">30分〜1時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--free">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 02 --}}
        <div class="step-card reveal" id="step02">
            <div class="step-card__header step-card__header--sell-a">
                <div class="step-card__num">STEP 02</div>
                <div class="step-card__icon">{!! $icons['search'] !!}</div>
                <h3 class="step-card__title">物件査定・売却価格の提案</h3>
                <p class="step-card__subtitle">適切な売り出し価格を決めます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            周辺の成約事例・市場動向・物件の状態などを総合的に分析し、
                            査定書をもとに売却希望価格をご提案します。
                            査定方法には「簡易査定」と「訪問査定」があります。
                        </p>
                        <h4 class="step-card__check-title">査定で確認する主なポイント</h4>
                        <ul class="step-card__checklist">
                            <li>周辺の類似物件の成約価格・売出価格</li>
                            <li>最寄り駅からの距離・交通アクセス</li>
                            <li>建物の築年数・構造・設備の状態</li>
                            <li>土地の面積・形状・接道状況</li>
                            <li>日当たり・眺望・騒音などの環境要因</li>
                            <li>リフォーム・修繕の実施履歴</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-a">
                            <div class="step-tip__icon">{!! $icons['pin'] !!}</div>
                            <div class="step-tip__title">査定価格 ≠ 売却価格</div>
                            <p class="step-tip__text">
                                査定価格はあくまで目安です。最終的な売り出し価格はお客様と相談のうえ決定します。
                                高すぎると売れ残り、低すぎると損になるため、適切な設定が重要です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">簡易査定</span>
                                <span class="step-meta__val">当日〜翌日</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">訪問査定</span>
                                <span class="step-meta__val">訪問後2〜3日</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 03 --}}
        <div class="step-card reveal" id="step03">
            <div class="step-card__header step-card__header--sell-b">
                <div class="step-card__num">STEP 03</div>
                <div class="step-card__icon">{!! $icons['document'] !!}</div>
                <h3 class="step-card__title">媒介契約の締結</h3>
                <p class="step-card__subtitle">当社との正式な契約を結びます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            売却を当社に依頼することが決まったら、「媒介契約」を締結します。
                            媒介契約には3種類あり、それぞれ活動範囲や義務が異なります。
                            ご状況に合わせて最適な種類をご提案します。
                        </p>
                        <h4 class="step-card__check-title">媒介契約の種類</h4>
                        <ul class="step-card__checklist">
                            <li><strong>専属専任媒介</strong>：1社のみに依頼。1週間に1回以上の活動報告義務あり</li>
                            <li><strong>専任媒介</strong>：1社のみに依頼。2週間に1回以上の活動報告義務あり（自己発見取引可）</li>
                            <li><strong>一般媒介</strong>：複数社に依頼可能。報告義務なし</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-b">
                            <div class="step-tip__icon">{!! $icons['bulb'] !!}</div>
                            <div class="step-tip__title">どの種類がおすすめ？</div>
                            <p class="step-tip__text">
                                一般的には「専任媒介」がバランス良くおすすめです。
                                不動産会社が積極的に売却活動を行いやすく、報告義務により進捗も確認できます。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">契約有効期間</span>
                                <span class="step-meta__val">最長3ヶ月</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--free">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 04 --}}
        <div class="step-card reveal" id="step04">
            <div class="step-card__header step-card__header--sell-b">
                <div class="step-card__num">STEP 04</div>
                <div class="step-card__icon">{!! $icons['announce'] !!}</div>
                <h3 class="step-card__title">売却活動・内覧対応</h3>
                <p class="step-card__subtitle">買主様との出会いに向けて動きます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            各種不動産ポータルサイトへの掲載・チラシ配布・業者間ネットワーク（レインズ）への登録など、
                            積極的に売却活動を展開します。
                            問い合わせが入ったら内覧（現地見学）のご対応をお願いします。
                        </p>
                        <h4 class="step-card__check-title">内覧を成功させるポイント</h4>
                        <ul class="step-card__checklist">
                            <li>室内を清潔・整理整頓した状態に保つ</li>
                            <li>においの対策（換気・消臭）をしておく</li>
                            <li>照明を明るくして開放感を演出する</li>
                            <li>日当たりの良い時間帯に内覧を設定する</li>
                            <li>ペットは事前に別の場所へ移す</li>
                            <li>近隣情報・生活環境をアピールできるよう準備する</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-b">
                            <div class="step-tip__icon">{!! $icons['warn'] !!}</div>
                            <div class="step-tip__title">価格見直しのタイミング</div>
                            <p class="step-tip__text">
                                3ヶ月程度活動しても問い合わせが少ない場合、売り出し価格の見直しを検討します。
                                担当者と定期的に状況を共有することが大切です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">活動期間</span>
                                <span class="step-meta__val">1〜3ヶ月（目安）</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--free">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 05 --}}
        <div class="step-card reveal" id="step05">
            <div class="step-card__header step-card__header--sell-b">
                <div class="step-card__num">STEP 05</div>
                <div class="step-card__icon">{!! $icons['handshake'] !!}</div>
                <h3 class="step-card__title">購入申込・条件交渉</h3>
                <p class="step-card__subtitle">買主様との条件を詰めます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            買主様から購入申込書（買付証明書）が提出されます。
                            希望購入価格・引渡し時期・条件などが記載されており、
                            当社が間に入り双方の条件が合うよう交渉をサポートします。
                        </p>
                        <h4 class="step-card__check-title">交渉で確認する主な条件</h4>
                        <ul class="step-card__checklist">
                            <li>売却価格（値引き交渉への対応方針）</li>
                            <li>引渡し時期・明渡し条件</li>
                            <li>設備・付帯物の引渡し範囲</li>
                            <li>ローン特約の有無</li>
                            <li>現況渡し or リフォーム後渡しの確認</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-b">
                            <div class="step-tip__icon">{!! $icons['bulb'] !!}</div>
                            <div class="step-tip__title">価格交渉への向き合い方</div>
                            <p class="step-tip__text">
                                値引き交渉は珍しくありません。「どこまで下げられるか」を事前に決めておくと、
                                交渉時に迷わずスムーズに進められます。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要期間</span>
                                <span class="step-meta__val">数日〜1週間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--free">無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 06 --}}
        <div class="step-card reveal" id="step06">
            <div class="step-card__header step-card__header--sell-c">
                <div class="step-card__num">STEP 06</div>
                <div class="step-card__icon">{!! $icons['clipboard'] !!}</div>
                <h3 class="step-card__title">重要事項説明・売買契約の締結</h3>
                <p class="step-card__subtitle">法律上の重要な手続きです</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            条件が合意したら、宅地建物取引士が重要事項説明を行い、
                            売買契約書に売主・買主双方が署名・押印します。
                            買主様から手付金を受け取ります。
                        </p>
                        <h4 class="step-card__check-title">契約時に確認すること</h4>
                        <ul class="step-card__checklist">
                            <li>売却価格・引渡し日の最終確認</li>
                            <li>手付金の受領（通常は売買代金の5〜10%）</li>
                            <li>契約不適合責任の範囲の確認</li>
                            <li>解約条件・違約金の確認</li>
                            <li>付帯設備の引渡し条件（設備表の確認）</li>
                            <li>ローン特約の期日確認</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-c">
                            <div class="step-tip__icon">{!! $icons['warn'] !!}</div>
                            <div class="step-tip__title">契約不適合責任について</div>
                            <p class="step-tip__text">
                                売主は物件の瑕疵（雨漏り・シロアリ被害など）について、
                                一定期間の責任を負う場合があります。
                                既知の瑕疵は必ず事前に開示しましょう。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">2〜3時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">手付金受領</span>
                                <span class="step-meta__val">売買代金の5〜10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 07 --}}
        <div class="step-card reveal" id="step07">
            <div class="step-card__header step-card__header--sell-c">
                <div class="step-card__num">STEP 07</div>
                <div class="step-card__icon">{!! $icons['build'] !!}</div>
                <h3 class="step-card__title">引渡し準備</h3>
                <p class="step-card__subtitle">引越し・ローン完済・抵当権抹消の手続き</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            売買契約締結から残金決済・引渡しまでの間に、
                            引越しや住宅ローンの完済手続き・抵当権抹消登記の準備を進めます。
                            司法書士と連携してスムーズに手続きを進めます。
                        </p>
                        <h4 class="step-card__check-title">引渡しまでにすること</h4>
                        <ul class="step-card__checklist">
                            <li>現在の住まいからの引越し（明渡し）</li>
                            <li>住宅ローンの残債一括返済（繰上返済の手続き）</li>
                            <li>抵当権抹消登記の準備（金融機関・司法書士と連携）</li>
                            <li>設備の動作確認・不具合の修繕</li>
                            <li>鍵・付帯書類の整理（マンションの場合は管理規約など）</li>
                            <li>電気・ガス・水道の解約手続き</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-c">
                            <div class="step-tip__icon">{!! $icons['pin'] !!}</div>
                            <div class="step-tip__title">ローン完済の手順</div>
                            <p class="step-tip__text">
                                残金決済日に買主様からの売却代金で住宅ローンを完済する流れが一般的です。
                                事前に金融機関へ繰上返済の申出を行い、完済に必要な金額を確認しておきましょう。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">準備期間</span>
                                <span class="step-meta__val">1〜2ヶ月</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">登記費用</span>
                                <span class="step-meta__val">抵当権抹消登記費用</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 08 --}}
        <div class="step-card step-card--final reveal" id="step08">
            <div class="step-card__header step-card__header--sell-c">
                <div class="step-card__num">STEP 08</div>
                <div class="step-card__icon">{!! $icons['money'] !!}</div>
                <h3 class="step-card__title">残金決済・引渡し完了</h3>
                <p class="step-card__subtitle">売却代金を受け取り、所有権が移ります</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            金融機関にて残金の決済が行われます。住宅ローンの完済・抵当権抹消・所有権移転登記が
                            同日に行われ、鍵を買主様へお渡しして引渡しが完了します。
                            売却代金から諸費用を差し引いた金額がお手元に残ります。
                        </p>
                        <h4 class="step-card__check-title">決済当日の主な費用（売主負担）</h4>
                        <ul class="step-card__checklist">
                            <li>仲介手数料（当社への報酬）</li>
                            <li>抵当権抹消登記費用（司法書士報酬含む）</li>
                            <li>固定資産税の日割り精算（引渡し日以降分は買主負担）</li>
                            <li>住宅ローン繰上返済手数料（金融機関による）</li>
                            <li>引越し費用（別途）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--sell-c">
                            <div class="step-tip__icon">{!! $icons['celebrate'] !!}</div>
                            <div class="step-tip__title">売却後の確定申告</div>
                            <p class="step-tip__text">
                                売却益が生じた場合は翌年の確定申告が必要です。
                                居住用財産の特別控除（3,000万円控除）などの特例が使える場合がありますので、
                                税理士へのご相談をお勧めします。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">1〜2時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">場所</span>
                                <span class="step-meta__val">金融機関（銀行）</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ========== COST GUIDE ========== --}}
<section class="flow-cost">
    <div class="container">
        <div class="section-header">
            <p class="section-label">Cost Guide</p>
            <h2 class="section-title">売却時にかかる主な費用</h2>
            <p class="section-desc">売却代金から差し引かれる諸費用の目安です</p>
        </div>
        <div class="cost-grid">
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['document'] !!}</div>
                <h4 class="cost-card__title">仲介手数料</h4>
                <p class="cost-card__formula">売買代金 × 3% + 6万円 + 消費税</p>
                <p class="cost-card__note">法律で定められた上限額。成約時のみ発生</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['building'] !!}</div>
                <h4 class="cost-card__title">抵当権抹消登記費用</h4>
                <p class="cost-card__formula">約1〜3万円</p>
                <p class="cost-card__note">登録免許税＋司法書士報酬。ローン完済時に必要</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['document'] !!}</div>
                <h4 class="cost-card__title">印紙税</h4>
                <p class="cost-card__formula">売買価格に応じて変動</p>
                <p class="cost-card__note">売買契約書に貼付。1,000万超で1万円など</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['bank'] !!}</div>
                <h4 class="cost-card__title">ローン繰上返済手数料</h4>
                <p class="cost-card__formula">0〜数万円</p>
                <p class="cost-card__note">金融機関・ローンの種類によって異なる</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['chart'] !!}</div>
                <h4 class="cost-card__title">譲渡所得税</h4>
                <p class="cost-card__formula">売却益 × 税率（15〜30%）</p>
                <p class="cost-card__note">売却益が生じた場合。各種特例の適用で軽減可能</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['tools'] !!}</div>
                <h4 class="cost-card__title">ハウスクリーニング費用</h4>
                <p class="cost-card__formula">約3〜10万円</p>
                <p class="cost-card__note">任意だが内覧前に実施で成約率アップ</p>
            </div>
        </div>
    </div>
</section>

{{-- ========== FAQ ========== --}}
<section class="flow-faq">
    <div class="container">
        <div class="section-header">
            <p class="section-label">FAQ</p>
            <h2 class="section-title">よくあるご質問</h2>
        </div>
        <div class="faq-list">
            @php
            $faqs = [
                ['q'=>'売却にかかる期間はどのくらいですか？','a'=>'物件の状態や市場環境によりますが、売却活動開始から成約まで平均3〜6ヶ月程度が目安です。人気エリアや適切な価格設定の物件は1〜2ヶ月で成約することもあります。成約後の残金決済・引渡しまでさらに1〜2ヶ月かかります。'],
                ['q'=>'査定だけでも依頼できますか？','a'=>'もちろんです。「まず相場を知りたい」という段階でのお問い合わせも大歓迎です。査定は無料・売却義務なしですので、お気軽にご依頼ください。'],
                ['q'=>'住宅ローンが残っていても売れますか？','a'=>'はい、売却可能です。残金決済時の売却代金でローンを一括返済するケースが一般的です。ただし売却価格がローン残債を下回る「オーバーローン」の場合は、別途ご相談が必要です。'],
                ['q'=>'売却するタイミングはいつが良いですか？','a'=>'一般的に不動産市場が活況になる春（2〜4月）や秋（9〜11月）は問い合わせが増える時期です。ただし市場全体の動向や金利環境にも左右されるため、気になった時点でまずご相談ください。'],
                ['q'=>'売却益に税金はかかりますか？','a'=>'売却価格が取得費＋諸費用を上回った場合（譲渡益）は課税対象となります。ただし居住用財産の場合は3,000万円の特別控除など軽減特例が使える場合があります。税理士へのご相談をお勧めします。'],
                ['q'=>'売却と住み替えを同時に進められますか？','a'=>'はい、可能です。「先に売ってから購入」する方法と「先に購入してから売却」する方法があり、それぞれメリット・デメリットがあります。資金計画や希望時期に合わせて最適な進め方をご提案します。'],
            ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div class="faq-item reveal">
                <button class="faq-item__q" aria-expanded="false">
                    <span class="faq-item__q-icon">Q</span>
                    <span>{{ $faq['q'] }}</span>
                    <svg class="faq-item__arrow" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="faq-item__a">
                    <span class="faq-item__a-icon">A</span>
                    <p>{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== CTA ========== --}}
<section class="flow-cta flow-cta--sell">
    <div class="container">
        <div class="flow-cta__box">
            <p class="section-label" style="color:#fcd34d;">Contact Us</p>
            <h2 class="flow-cta__title">まずは無料査定をご依頼ください</h2>
            <p class="flow-cta__desc">
                売却のご相談・査定依頼はいつでも無料です。<br>
                専任スタッフが丁寧にご対応し、最適な売却プランをご提案します。
            </p>
            <div class="flow-cta__buttons">
                <a href="{{ url('/') }}#contact" class="btn btn--primary btn--lg">無料査定を依頼する</a>
                <a href="{{ url('/flow') }}" class="btn btn--outline-white btn--lg">購入フローを見る</a>
            </div>
        </div>
    </div>
</section>

{{-- ========== FOOTER ========== --}}
<footer class="footer">
    <div class="container footer__inner">
        <div class="footer__brand">
            <img src="{{ asset('ost_icon_20260321.jpg') }}" alt="ロゴ" class="footer__logo-icon">
            <span class="footer__logo-text">ワンステップテックス不動産</span>
        </div>
        <div class="footer__links">
            <a href="{{ url('/') }}" class="footer__link">ホーム</a>
            <a href="{{ url('/properties') }}" class="footer__link">物件一覧</a>
            <a href="{{ url('/flow') }}" class="footer__link">購入フロー</a>
            <a href="{{ url('/selling-flow') }}" class="footer__link">売却フロー</a>
            <a href="{{ url('/') }}#contact" class="footer__link">お問い合わせ</a>
        </div>
        <p class="footer__copy">&copy; {{ date('Y') }} ワンステップテックス不動産. All rights reserved.</p>
    </div>
</footer>

{{-- ========== PAGE CSS ========== --}}
<style>
/* ---- NAVBAR (共通) ---- */
.navbar--dark { background: var(--dark); }
.navbar--dark .navbar__logo { color: var(--white); }
.navbar--dark .navbar__link { color: rgba(255,255,255,.85); }
.navbar--dark .navbar__link:hover { color: var(--white); background: rgba(255,255,255,.1); }
.navbar--dark .navbar__link--active { color: var(--white); background: rgba(255,255,255,.15); font-weight: 700; }
.navbar--dark .navbar__link--cta { background: var(--blue); color: var(--white) !important; }
.navbar--dark .navbar__link--cta:hover { background: var(--blue-dark) !important; }
.navbar--dark .navbar__toggle span { background: var(--white); }
/* Dropdown */
.navbar__dropdown { position: relative; }
.navbar__dropdown-toggle { display: flex !important; align-items: center; gap: 4px; cursor: pointer; }
.navbar__dropdown-arrow { width: 14px; height: 14px; transition: transform .2s; flex-shrink: 0; }
.navbar__dropdown.is-open .navbar__dropdown-arrow { transform: rotate(180deg); }
.navbar__dropdown-menu { display: none; position: absolute; top: calc(100% + 10px); left: 50%; transform: translateX(-50%); background: var(--white); border-radius: 12px; box-shadow: 0 8px 28px rgba(0,0,0,.13); min-width: 140px; padding: 8px; z-index: 200; }
.navbar__dropdown.is-open .navbar__dropdown-menu { display: block; }
.navbar__dropdown-link { display: block; padding: 8px 14px; font-size: .88rem; font-weight: 500; color: var(--text); border-radius: 8px; transition: .2s; white-space: nowrap; }
.navbar__dropdown-link:hover { color: var(--blue); background: var(--blue-light); }
.navbar__dropdown-link--active { color: var(--blue); font-weight: 700; }

/* ---- HERO ---- */
.flow-hero {
    position: relative;
    background: linear-gradient(135deg, #0f2460 0%, #1a4cbd 50%, #2f7cff 100%);
    padding: 140px 0 60px;
    overflow: hidden;
    text-align: center;
}
.flow-hero--sell {
    background: linear-gradient(135deg, #7c2d05 0%, #c2450a 50%, #f17c20 100%);
}
.flow-hero__bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 20% 50%, rgba(78,186,154,.12) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(255,255,255,.06) 0%, transparent 50%);
}
.flow-hero__inner { position: relative; z-index: 1; }
.flow-hero__title {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 700;
    color: var(--white);
    margin-bottom: 20px;
    line-height: 1.2;
}
.flow-hero__desc {
    font-size: 1.05rem;
    color: rgba(255,255,255,.85);
    line-height: 1.8;
    margin-bottom: 36px;
}
.flow-hero__steps-count {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 16px;
    padding: 16px 32px;
    backdrop-filter: blur(8px);
}
.flow-hero__steps-num { font-size: 3rem; font-weight: 700; color: var(--white); line-height: 1; }
.flow-hero__steps-label { font-size: .75rem; font-weight: 700; color: rgba(255,255,255,.7); letter-spacing: .15em; }
.flow-hero__wave { position: relative; margin-bottom: -2px; line-height: 0; }
.flow-hero__wave svg { width: 100%; height: 80px; display: block; }

/* ---- OVERVIEW TIMELINE ---- */
.flow-overview { background: var(--bg-light); padding: 80px 0; }
.flow-timeline {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
}
.flow-timeline__item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1;
    padding: 0 8px;
}
/* 各アイテムから次のアイテムへ横線 */
.flow-timeline__item:not(:nth-child(4n))::after {
    content: '';
    position: absolute;
    top: 35px;
    left: 50%;
    right: -50%;
    height: 3px;
    z-index: 0;
}
/* 行1: STEP1→2, 2→3, 3→4 */
.flow-timeline__item:nth-child(1)::after,
.flow-timeline__item:nth-child(2)::after { background: #f17c20; opacity: .7; }
.flow-timeline__item:nth-child(3)::after  { background: linear-gradient(90deg, #f17c20, #c2450a); opacity: .7; }
/* 行2: STEP5→6, 6→7, 7→8 */
.flow-timeline__item:nth-child(5)::after,
.flow-timeline__item:nth-child(6)::after { background: #c2450a; opacity: .7; }
.flow-timeline__item:nth-child(7)::after  { background: linear-gradient(90deg, #c2450a, #7c2d05); opacity: .7; }

.flow-timeline__dot {
    width: 56px; height: 56px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 16px;
    border: 4px solid var(--white);
    box-shadow: var(--shadow-md);
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}
.flow-timeline__dot .svg-icon { width: 1.4rem; height: 1.4rem; stroke: #ffffff; }
.flow-timeline__dot--sell-a { background: #f17c20; }
.flow-timeline__dot--sell-b { background: #c2450a; }
.flow-timeline__dot--sell-c { background: #7c2d05; }
.flow-timeline__num {
    font-size: .7rem; font-weight: 700; letter-spacing: .08em;
    color: var(--orange); margin-bottom: 4px; display: block;
}
.flow-timeline__label { font-size: .88rem; font-weight: 700; color: var(--dark); line-height: 1.35; margin-bottom: 6px; }
.flow-timeline__dur { font-size: .72rem; color: var(--text-light); }

/* ---- STEP CARDS ---- */
.flow-steps { padding: 80px 0; background: var(--white); }
.step-card {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    margin-bottom: 40px;
    border: 1px solid var(--border);
    transition: transform var(--transition), box-shadow var(--transition);
}
.step-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
.step-card--final { border: 2px solid #7c2d05; }
.step-card__header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 24px 32px;
    color: var(--white);
}
.step-card__header--sell-a { background: linear-gradient(135deg, #c2450a, #f17c20); }
.step-card__header--sell-b { background: linear-gradient(135deg, #9a3008, #c2450a); }
.step-card__header--sell-c { background: linear-gradient(135deg, #5c1e02, #7c2d05); }
.step-card__num { font-size: .72rem; font-weight: 700; letter-spacing: .12em; opacity: .85; min-width: 60px; }
.step-card__icon { width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; }
.step-card__icon .svg-icon { width: 2rem; height: 2rem; stroke: currentColor; }
.step-card__title { font-size: 1.3rem; font-weight: 700; margin: 0; }
.step-card__subtitle { font-size: .82rem; opacity: .85; margin: 4px 0 0; margin-left: auto; white-space: nowrap; }
.step-card__body { padding: 32px; }
.step-card__cols { display: grid; grid-template-columns: 1fr 320px; gap: 32px; }
.step-card__text { font-size: .95rem; color: var(--text); line-height: 1.8; margin-bottom: 20px; }
.step-card__check-title { font-size: .88rem; font-weight: 700; color: var(--dark); margin-bottom: 12px; }
.step-card__checklist { display: flex; flex-direction: column; gap: 8px; }
.step-card__checklist li {
    font-size: .875rem; color: var(--text);
    padding: 8px 12px 8px 32px;
    background: var(--bg-light);
    border-radius: var(--radius-sm);
    position: relative;
}
.step-card__checklist li::before {
    content: '✓';
    position: absolute; left: 10px; top: 8px;
    color: var(--orange); font-weight: 700; font-size: .85rem;
}

/* ---- STEP TIP ---- */
.step-tip { border-radius: var(--radius-md); padding: 20px; margin-bottom: 20px; }
.step-tip--sell-a { background: #fff4ec; }
.step-tip--sell-b { background: #fef0e4; }
.step-tip--sell-c { background: #fef0e4; }
.step-tip__icon { width: 1.75rem; height: 1.75rem; margin-bottom: 8px; display: flex; align-items: center; justify-content: center; }
.step-tip__icon .svg-icon { width: 1.4rem; height: 1.4rem; stroke: currentColor; }
.step-tip__title { font-size: .85rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
.step-tip__text { font-size: .82rem; color: var(--text); line-height: 1.7; }

/* ---- STEP META ---- */
.step-meta { display: flex; flex-direction: column; gap: 8px; }
.step-meta__item {
    display: flex; justify-content: space-between; align-items: center;
    padding: 10px 14px;
    background: var(--bg-light);
    border-radius: var(--radius-sm);
    font-size: .82rem;
}
.step-meta__label { color: var(--text-light); font-weight: 500; }
.step-meta__val { font-weight: 700; color: var(--dark); }
.step-meta__val--free { color: var(--teal); }

/* ---- COST GUIDE ---- */
.flow-cost { background: var(--bg-light); padding: 80px 0; }
.cost-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.cost-card {
    background: var(--white);
    border-radius: var(--radius-md);
    padding: 28px 24px;
    text-align: center;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
    transition: transform var(--transition), box-shadow var(--transition);
}
.cost-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.cost-card__icon { width: 3rem; height: 3rem; margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; background: var(--blue-light); border-radius: 50%; }
.cost-card__icon .svg-icon { width: 1.6rem; height: 1.6rem; stroke: var(--blue); }
.cost-card__title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; }
.cost-card__formula { font-size: .9rem; font-weight: 700; color: var(--orange); margin-bottom: 6px; }
.cost-card__note { font-size: .78rem; color: var(--text-light); }

/* ---- FAQ ---- */
.flow-faq { background: var(--white); padding: 80px 0; }
.faq-list { max-width: 760px; margin: 0 auto; display: flex; flex-direction: column; gap: 12px; }
.faq-item {
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    transition: border-color var(--transition);
}
.faq-item.is-open { border-color: var(--orange); }
.faq-item__q {
    width: 100%;
    display: flex; align-items: center; gap: 14px;
    padding: 18px 20px;
    text-align: left;
    font-size: .95rem; font-weight: 700; color: var(--dark);
    background: var(--white);
    transition: background var(--transition);
}
.faq-item.is-open .faq-item__q { background: var(--orange-light); color: var(--orange); }
.faq-item__q-icon {
    flex-shrink: 0; width: 28px; height: 28px;
    background: var(--orange); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700;
}
.faq-item.is-open .faq-item__q-icon { background: #c2450a; }
.faq-item__arrow {
    width: 20px; height: 20px; margin-left: auto; flex-shrink: 0;
    color: var(--text-light);
    transition: transform var(--transition);
}
.faq-item.is-open .faq-item__arrow { transform: rotate(180deg); color: var(--orange); }
.faq-item__a {
    display: none;
    padding: 20px;
    font-size: .9rem; color: var(--text); line-height: 1.8;
    background: var(--bg-light);
    gap: 14px;
    align-items: flex-start;
}
.faq-item.is-open .faq-item__a { display: flex; }
.faq-item__a-icon {
    flex-shrink: 0; width: 28px; height: 28px;
    background: var(--blue); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700; margin-top: 2px;
}

/* ---- CTA ---- */
.flow-cta { background: linear-gradient(135deg, #0f2460 0%, #1a4cbd 60%, #2f7cff 100%); padding: 80px 0; }
.flow-cta--sell { background: linear-gradient(135deg, #7c2d05 0%, #c2450a 60%, #f17c20 100%); }
.flow-cta__box { text-align: center; }
.flow-cta__title { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; color: var(--white); margin-bottom: 16px; }
.flow-cta__desc { font-size: 1rem; color: rgba(255,255,255,.85); line-height: 1.8; margin-bottom: 36px; }
.flow-cta__buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.btn--lg { padding: 16px 40px; font-size: 1rem; }
.btn--outline-white {
    background: transparent; color: var(--white);
    border: 2px solid rgba(255,255,255,.6); border-radius: 50px;
    padding: 16px 40px; font-size: 1rem; font-weight: 700;
    display: inline-flex; align-items: center; justify-content: center;
    transition: var(--transition);
}
.btn--outline-white:hover { background: rgba(255,255,255,.12); border-color: var(--white); }

/* ---- FOOTER ---- */
.footer { background: var(--dark); padding: 40px 0; }
.footer__inner { display: flex; flex-direction: column; align-items: center; gap: 20px; }
.footer__brand { display: flex; align-items: center; gap: 10px; color: var(--white); font-weight: 700; }
.footer__logo-icon { width: 32px; height: 32px; object-fit: contain; border-radius: 5px; display: block; }
.footer__links { display: flex; gap: 24px; flex-wrap: wrap; justify-content: center; }
.footer__link { font-size: .85rem; color: rgba(255,255,255,.6); transition: color var(--transition); }
.footer__link:hover { color: var(--white); }
.footer__copy { font-size: .75rem; color: rgba(255,255,255,.4); }

/* ---- REVEAL ---- */
.reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }
.reveal.visible { opacity: 1; transform: none; }

/* ---- RESPONSIVE ---- */
@media (max-width: 900px) {
    .flow-timeline { grid-template-columns: repeat(2, 1fr); gap: 24px; }
    .flow-timeline__item:not(:nth-child(4n))::after { display: none; }
    .flow-timeline__item:nth-child(odd):not(:last-child)::after { display: block; }
    .step-card__cols { grid-template-columns: 1fr; }
    .step-card__subtitle { display: none; }
    .cost-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .flow-hero { padding: 120px 0 40px; }
    .flow-timeline { grid-template-columns: 1fr 1fr; }
    .cost-grid { grid-template-columns: 1fr; }
    .step-card__body { padding: 20px; }
    .step-card__header { padding: 18px 20px; gap: 12px; }
    .navbar__menu { display: none; flex-direction: column; position: absolute; top: 72px; left: 0; right: 0; background: var(--dark); padding: 16px; gap: 4px; }
    .navbar__menu.open { display: flex; }
    .navbar__toggle { display: flex; }
}
</style>

{{-- ========== PAGE JS ========== --}}
<script>
// Scroll reveal
const revealEls = document.querySelectorAll('.reveal');
const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); } });
}, { threshold: 0.12 });
revealEls.forEach(el => revealObs.observe(el));

// FAQ accordion
document.querySelectorAll('.faq-item__q').forEach(btn => {
    btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('is-open');
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('is-open'));
        if (!isOpen) item.classList.add('is-open');
    });
});

// Mobile navbar
const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');
if (navToggle) navToggle.addEventListener('click', () => navMenu.classList.toggle('open'));

// Dropdowns (複数対応)
document.querySelectorAll('.navbar__dropdown').forEach(dd => {
    const toggle = dd.querySelector('.navbar__dropdown-toggle');
    if (toggle) {
        toggle.addEventListener('click', e => {
            e.preventDefault();
            const wasOpen = dd.classList.contains('is-open');
            document.querySelectorAll('.navbar__dropdown').forEach(d => d.classList.remove('is-open'));
            if (!wasOpen) dd.classList.add('is-open');
        });
    }
});
document.addEventListener('click', e => {
    if (!e.target.closest('.navbar__dropdown')) {
        document.querySelectorAll('.navbar__dropdown').forEach(d => d.classList.remove('is-open'));
    }
});
</script>

@endsection
