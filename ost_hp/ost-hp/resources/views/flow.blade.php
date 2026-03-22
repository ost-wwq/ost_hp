@extends('layouts.app')

@section('title', '不動産購入フロー｜ワンステップテックス不動産')

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
            <li class="navbar__dropdown" id="navDropdownFlow">
                <a href="#" class="navbar__link navbar__dropdown-toggle navbar__link--active" id="navDropdownFlowToggle">
                    フロー
                    <svg class="navbar__dropdown-arrow" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li><a href="{{ url('/flow') }}" class="navbar__dropdown-link navbar__dropdown-link--active">購入フロー</a></li>
                    <li><a href="{{ url('/selling-flow') }}" class="navbar__dropdown-link">売却フロー</a></li>
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
<section class="flow-hero">
    <div class="flow-hero__bg"></div>
    <div class="container flow-hero__inner">
        <p class="section-label" style="color:#93c5fd;">Purchase Flow</p>
        <h1 class="flow-hero__title">不動産購入フロー</h1>
        <p class="flow-hero__desc">
            はじめて不動産を購入される方も安心。<br>
            お問い合わせから入居まで、8つのステップをわかりやすくご説明します。
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
            <h2 class="section-title">購入までの全体の流れ</h2>
            <p class="section-desc">一般的に契約から引渡しまで2〜4ヶ月程度かかります</p>
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
                ['num'=>'01','icon'=>'chat','label'=>'ご相談・情報収集','color'=>'step-1','duration'=>'随時'],
                ['num'=>'02','icon'=>'search','label'=>'物件探し・見学','color'=>'step-2','duration'=>'1〜4週間'],
                ['num'=>'03','icon'=>'edit','label'=>'購入申込','color'=>'step-3','duration'=>'1〜3日'],
                ['num'=>'04','icon'=>'bank','label'=>'ローン事前審査','color'=>'step-4','duration'=>'3〜7日'],
                ['num'=>'05','icon'=>'clipboard','label'=>'重要事項説明・売買契約','color'=>'step-5','duration'=>'1日'],
                ['num'=>'06','icon'=>'check','label'=>'ローン本審査','color'=>'step-6','duration'=>'1〜2週間'],
                ['num'=>'07','icon'=>'money','label'=>'残金決済・登記','color'=>'step-7','duration'=>'1日'],
                ['num'=>'08','icon'=>'home','label'=>'引渡し・入居','color'=>'step-8','duration'=>'当日〜'],
            ];
            @endphp

            @foreach($steps as $i => $s)
            <div class="flow-timeline__item reveal">
                <div class="flow-timeline__dot flow-timeline__dot--{{ $s['color'] }}">
                    {!! $icons[$s['icon']] !!}
                </div>
                @if(!$i === count($steps)-1)
                <div class="flow-timeline__line"></div>
                @endif
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
            <div class="step-card__header step-card__header--step-1">
                <div class="step-card__num">STEP 01</div>
                <div class="step-card__icon">{!! $icons['chat'] !!}</div>
                <h3 class="step-card__title">ご相談・情報収集</h3>
                <p class="step-card__subtitle">まずは気軽にご相談ください</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            不動産購入は人生の大きな決断です。まずは現在のご状況やご希望をお聞かせください。
                            予算・エリア・間取りなど、どんな小さな疑問もお気軽にご相談いただけます。
                        </p>
                        <h4 class="step-card__check-title">この段階でご確認いただくこと</h4>
                        <ul class="step-card__checklist">
                            <li>購入目的（居住用・投資用・相続対策など）</li>
                            <li>希望エリアと生活環境の確認</li>
                            <li>おおよその予算感の把握</li>
                            <li>購入時期（いつ頃入居したいか）</li>
                            <li>現在の住まいの状況（賃貸・持ち家など）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--blue">
                            <div class="step-tip__icon">{!! $icons['bulb'] !!}</div>
                            <div class="step-tip__title">担当者からのアドバイス</div>
                            <p class="step-tip__text">
                                「なんとなく気になっている」程度でも大丈夫。
                                まずは情報収集から始めましょう。購入すると決めていなくても、相談は無料です。
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
            <div class="step-card__header step-card__header--step-2">
                <div class="step-card__num">STEP 02</div>
                <div class="step-card__icon">{!! $icons['search'] !!}</div>
                <h3 class="step-card__title">物件探し・現地見学</h3>
                <p class="step-card__subtitle">理想の物件を一緒に探します</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            ご希望条件をもとに物件をご紹介します。
                            当社の豊富なネットワークから、公開前の物件情報をご案内できる場合もあります。
                            気になる物件は積極的に現地へ足を運びましょう。
                        </p>
                        <h4 class="step-card__check-title">現地見学のポイント</h4>
                        <ul class="step-card__checklist">
                            <li>周辺環境（スーパー・学校・病院・駅へのアクセス）</li>
                            <li>日当たり・騒音・眺望の確認</li>
                            <li>建物の外観・共用部分の状態（マンションの場合）</li>
                            <li>間取り・収納スペースの確認</li>
                            <li>リフォームが必要な箇所のチェック</li>
                            <li>管理費・修繕積立金の確認（マンションの場合）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--blue">
                            <div class="step-tip__icon">{!! $icons['bulb'] !!}</div>
                            <div class="step-tip__title">見学時の注意点</div>
                            <p class="step-tip__text">
                                複数の物件を見ることで比較ができます。
                                1回の見学だけでなく、朝・夜・雨の日など異なる条件で見学するのが理想的です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">目安期間</span>
                                <span class="step-meta__val">1〜4週間</span>
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

        {{-- STEP 03 --}}
        <div class="step-card reveal" id="step03">
            <div class="step-card__header step-card__header--step-3">
                <div class="step-card__num">STEP 03</div>
                <div class="step-card__icon">{!! $icons['edit'] !!}</div>
                <h3 class="step-card__title">購入申込（買付証明書の提出）</h3>
                <p class="step-card__subtitle">購入の意思を売主へ伝えます</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            購入したい物件が決まったら「買付証明書（購入申込書）」を提出します。
                            希望購入価格や条件を記載し、売主様との交渉をスタートします。
                            この段階ではまだ法的な拘束力はありません。
                        </p>
                        <h4 class="step-card__check-title">申込時に決めること</h4>
                        <ul class="step-card__checklist">
                            <li>希望購入価格（値交渉が可能な場合あり）</li>
                            <li>手付金の金額（売買代金の5〜10%が目安）</li>
                            <li>契約希望日・引渡し希望日</li>
                            <li>ローン特約の有無</li>
                            <li>設備・備品の引渡し条件</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--orange">
                            <div class="step-tip__icon">{!! $icons['warn'] !!}</div>
                            <div class="step-tip__title">注意事項</div>
                            <p class="step-tip__text">
                                人気物件は複数の買付が競合する場合があります。
                                希望条件を整理した上で、スピーディに対応することが重要です。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">目安期間</span>
                                <span class="step-meta__val">1〜3日</span>
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
            <div class="step-card__header step-card__header--step-4">
                <div class="step-card__num">STEP 04</div>
                <div class="step-card__icon">{!! $icons['bank'] !!}</div>
                <h3 class="step-card__title">住宅ローン事前審査</h3>
                <p class="step-card__subtitle">借入可能額を事前に把握します</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            購入申込と並行して、住宅ローンの事前審査（仮審査）を申し込みます。
                            金融機関が申込者の返済能力を審査し、融資可否と融資予定額を回答します。
                            事前審査は複数の金融機関に申し込むことができます。
                        </p>
                        <h4 class="step-card__check-title">主な必要書類</h4>
                        <ul class="step-card__checklist">
                            <li>本人確認書類（運転免許証・マイナンバーカードなど）</li>
                            <li>収入証明書（源泉徴収票・確定申告書など）</li>
                            <li>物件の販売図面・物件概要書</li>
                            <li>健康保険証</li>
                            <li>他のローン残高証明書（ある場合）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--orange">
                            <div class="step-tip__icon">{!! $icons['bulb'] !!}</div>
                            <div class="step-tip__title">ローン選びのポイント</div>
                            <p class="step-tip__text">
                                金利タイプ（固定・変動・固定期間選択）によって月々の返済額が大きく変わります。
                                当社ではファイナンシャルプランナーへのご紹介も行っております。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">審査期間</span>
                                <span class="step-meta__val">3〜7日</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val step-meta__val--free">原則無料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 05 --}}
        <div class="step-card reveal" id="step05">
            <div class="step-card__header step-card__header--step-5">
                <div class="step-card__num">STEP 05</div>
                <div class="step-card__icon">{!! $icons['clipboard'] !!}</div>
                <h3 class="step-card__title">重要事項説明・売買契約</h3>
                <p class="step-card__subtitle">法律上の重要な手続きです</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            宅地建物取引士が物件に関する重要事項を説明します（重要事項説明）。
                            内容をよく確認・理解した上で売買契約書に署名・押印します。
                            この日に手付金をお支払いいただきます。
                        </p>
                        <h4 class="step-card__check-title">重要事項説明で確認すること</h4>
                        <ul class="step-card__checklist">
                            <li>法令上の制限（用途地域・建ぺい率・容積率など）</li>
                            <li>接道状況・私道負担の有無</li>
                            <li>設備の状態と引渡し条件</li>
                            <li>管理費・修繕積立金の状況（マンションの場合）</li>
                            <li>手付金の額・解約条件・違約金</li>
                            <li>引渡し時期・残金決済方法</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--orange">
                            <div class="step-tip__icon">{!! $icons['warn'] !!}</div>
                            <div class="step-tip__title">手付金について</div>
                            <p class="step-tip__text">
                                手付金は売買代金の一部です。売主都合でキャンセルになった場合は手付金の倍額が返還されます。
                                買主都合でキャンセルした場合は手付金が没収されます。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">所要時間</span>
                                <span class="step-meta__val">2〜3時間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">手付金</span>
                                <span class="step-meta__val">売買代金の5〜10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 06 --}}
        <div class="step-card reveal" id="step06">
            <div class="step-card__header step-card__header--step-6">
                <div class="step-card__num">STEP 06</div>
                <div class="step-card__icon">{!! $icons['check'] !!}</div>
                <h3 class="step-card__title">住宅ローン本審査・申込</h3>
                <p class="step-card__subtitle">正式な融資申込を行います</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            売買契約締結後、住宅ローンの本審査（正式申込）を行います。
                            事前審査より詳細な審査が行われます。
                            審査通過後、金融機関との間でローン契約（金銭消費貸借契約）を締結します。
                        </p>
                        <h4 class="step-card__check-title">本審査の追加書類（例）</h4>
                        <ul class="step-card__checklist">
                            <li>売買契約書のコピー</li>
                            <li>重要事項説明書のコピー</li>
                            <li>登記事項証明書</li>
                            <li>住民票・印鑑証明書</li>
                            <li>収入証明書（最新年度）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--teal">
                            <div class="step-tip__icon">{!! $icons['bulb'] !!}</div>
                            <div class="step-tip__title">ローン特約について</div>
                            <p class="step-tip__text">
                                本審査に通らなかった場合でも、売買契約に「ローン特約」が付いていれば手付金が返還され、
                                無条件で契約を解除できます。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">審査期間</span>
                                <span class="step-meta__val">1〜2週間</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">費用</span>
                                <span class="step-meta__val">ローン事務手数料</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 07 --}}
        <div class="step-card reveal" id="step07">
            <div class="step-card__header step-card__header--step-7">
                <div class="step-card__num">STEP 07</div>
                <div class="step-card__icon">{!! $icons['money'] !!}</div>
                <h3 class="step-card__title">残金決済・所有権移転登記</h3>
                <p class="step-card__subtitle">代金を支払い、所有権が移ります</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            売買代金から手付金を差し引いた残金を売主へお支払いします。
                            同日、司法書士が所有権移転登記・抵当権設定登記を法務局へ申請します。
                            これにより正式にご購入者様の所有物件となります。
                        </p>
                        <h4 class="step-card__check-title">当日の主な費用</h4>
                        <ul class="step-card__checklist">
                            <li>残代金（売買代金 − 手付金）</li>
                            <li>仲介手数料（当社への報酬）</li>
                            <li>登記費用（登録免許税・司法書士報酬）</li>
                            <li>固定資産税の日割り精算</li>
                            <li>火災保険料（加入が必要な場合）</li>
                            <li>管理費等の精算（マンションの場合）</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--teal">
                            <div class="step-tip__icon">{!! $icons['pin'] !!}</div>
                            <div class="step-tip__title">諸費用の目安</div>
                            <p class="step-tip__text">
                                購入時の諸費用は物件価格の約3〜7%が目安です。
                                新築は3〜5%、中古は5〜7%程度とお考えください。
                                事前に資金計画を立てることが大切です。
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

        {{-- STEP 08 --}}
        <div class="step-card step-card--final reveal" id="step08">
            <div class="step-card__header step-card__header--step-8">
                <div class="step-card__num">STEP 08</div>
                <div class="step-card__icon">{!! $icons['home'] !!}</div>
                <h3 class="step-card__title">引渡し・新生活スタート</h3>
                <p class="step-card__subtitle">いよいよ夢のマイホームへ</p>
            </div>
            <div class="step-card__body">
                <div class="step-card__cols">
                    <div class="step-card__main">
                        <p class="step-card__text">
                            残金決済と同日、または別途日程を設定して物件の引渡しが行われます。
                            売主から鍵を受け取り、設備の動作確認を行います。
                            これで晴れてご入居いただけます。おめでとうございます！
                        </p>
                        <h4 class="step-card__check-title">引渡し後にすること</h4>
                        <ul class="step-card__checklist">
                            <li>住所変更手続き（役所・運転免許証・保険など）</li>
                            <li>電気・ガス・水道の契約切り替え</li>
                            <li>インターネット回線の手続き</li>
                            <li>リフォーム・クリーニングの実施（必要に応じて）</li>
                            <li>引越し業者との日程調整</li>
                        </ul>
                    </div>
                    <div class="step-card__side">
                        <div class="step-tip step-tip--teal">
                            <div class="step-tip__icon">{!! $icons['celebrate'] !!}</div>
                            <div class="step-tip__title">購入後もサポート</div>
                            <p class="step-tip__text">
                                引渡し後もリフォームのご相談や設備トラブルなど、
                                何かお困りのことがあればいつでもご連絡ください。
                                末長いお付き合いを大切にしています。
                            </p>
                        </div>
                        <div class="step-meta">
                            <div class="step-meta__item">
                                <span class="step-meta__label">タイミング</span>
                                <span class="step-meta__val">決済日当日〜</span>
                            </div>
                            <div class="step-meta__item">
                                <span class="step-meta__label">担当</span>
                                <span class="step-meta__val">当社スタッフが立会い</span>
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
            <h2 class="section-title">購入時の諸費用ガイド</h2>
            <p class="section-desc">物件価格以外にかかる費用の目安です</p>
        </div>
        <div class="cost-grid">
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['document'] !!}</div>
                <h4 class="cost-card__title">仲介手数料</h4>
                <p class="cost-card__formula">売買代金 × 3% + 6万円 + 消費税</p>
                <p class="cost-card__note">法律で定められた上限額です</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['building'] !!}</div>
                <h4 class="cost-card__title">登記費用</h4>
                <p class="cost-card__formula">物件価格の約0.5〜1.5%</p>
                <p class="cost-card__note">登録免許税＋司法書士報酬</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['bank'] !!}</div>
                <h4 class="cost-card__title">ローン諸費用</h4>
                <p class="cost-card__formula">融資額の約1〜3%</p>
                <p class="cost-card__note">事務手数料・保証料・団信など</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['fire'] !!}</div>
                <h4 class="cost-card__title">火災保険</h4>
                <p class="cost-card__formula">年間 約1〜5万円</p>
                <p class="cost-card__note">補償内容により異なります</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['document'] !!}</div>
                <h4 class="cost-card__title">印紙税</h4>
                <p class="cost-card__formula">売買価格に応じて変動</p>
                <p class="cost-card__note">売買契約書・ローン契約書それぞれに必要</p>
            </div>
            <div class="cost-card reveal">
                <div class="cost-card__icon">{!! $icons['house'] !!}</div>
                <h4 class="cost-card__title">不動産取得税</h4>
                <p class="cost-card__formula">固定資産税評価額 × 3%</p>
                <p class="cost-card__note">取得後3〜6ヶ月後に納税通知が届きます</p>
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
                ['q'=>'自己資金はどのくらい必要ですか？','a'=>'諸費用（物件価格の3〜7%）は現金で用意する必要があります。さらに頭金として物件価格の10〜20%程度を用意できると、毎月の返済額を抑えられます。フルローン（頭金0円）も金融機関によっては可能ですが、審査が厳しくなる場合があります。'],
                ['q'=>'購入にかかる期間はどのくらいですか？','a'=>'物件探しの期間は人によって異なりますが、購入申込から引渡しまでは一般的に2〜4ヶ月程度です。住宅ローン審査や登記手続きに時間がかかるため、余裕を持ったスケジュールをお勧めします。'],
                ['q'=>'住宅ローンはどこで借りれば良いですか？','a'=>'都市銀行・地方銀行・信用金庫・ネット銀行・住宅金融支援機構（フラット35）など多くの選択肢があります。金利・手数料・サービスを比較検討することをお勧めします。当社ではご要望に応じてFPをご紹介することも可能です。'],
                ['q'=>'中古物件と新築物件、どちらが良いですか？','a'=>'新築は最新設備・保証が充実・住宅ローン控除の優遇が大きいメリットがあります。中古は価格が割安・立地の選択肢が広い・実物を見て購入できるメリットがあります。ライフスタイルや予算に合わせてご選択ください。'],
                ['q'=>'購入をキャンセルできますか？','a'=>'売買契約締結前であれば基本的にキャンセル可能です。ただし売買契約締結後は手付金が没収されます。またローン特約がある場合は、本審査に通らなかった時は手付金を返還してもらい解約できます。'],
                ['q'=>'一人でも購入できますか？','a'=>'もちろん可能です。ただし住宅ローンの審査は年収が重要な要素となります。単独では希望額のローンが組みにくい場合は、ペアローンや収入合算などの方法もあります。ご状況に合わせてご相談ください。'],
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
<section class="flow-cta">
    <div class="container">
        <div class="flow-cta__box">
            <p class="section-label" style="color:#93c5fd;">Contact Us</p>
            <h2 class="flow-cta__title">まずは無料でご相談ください</h2>
            <p class="flow-cta__desc">
                購入フローに関するご不明点や、物件探しのご相談など<br>
                お気軽にお問い合わせください。専任スタッフが丁寧にご対応します。
            </p>
            <div class="flow-cta__buttons">
                <a href="{{ url('/') }}#contact" class="btn btn--primary btn--lg">無料相談はこちら</a>
                <a href="{{ url('/properties') }}" class="btn btn--outline-white btn--lg">物件を探す</a>
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
            <a href="{{ url('/') }}#contact" class="footer__link">お問い合わせ</a>
        </div>
        <p class="footer__copy">&copy; {{ date('Y') }} ワンステップテックス不動産. All rights reserved.</p>
    </div>
</footer>

{{-- ========== PAGE CSS ========== --}}
<style>
/* ---- NAVBAR overrides for inner pages ---- */
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
.flow-hero__bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 20% 50%, rgba(78,186,154,.15) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(241,124,32,.1) 0%, transparent 50%);
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
.flow-overview {
    background: var(--bg-light);
    padding: 80px 0;
}
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
/* 各アイテムから次のアイテムへ横線（ドット中心→次のドット中心） */
.flow-timeline__item:not(:nth-child(4n))::after {
    content: '';
    position: absolute;
    top: 35px; /* ドット(72px)の中心 */
    left: 50%;
    right: -50%;
    height: 3px;
    z-index: 0;
}
/* 行1: STEP1→2, 2→3, 3→4 */
.flow-timeline__item:nth-child(1)::after,
.flow-timeline__item:nth-child(2)::after { background: var(--blue); }
.flow-timeline__item:nth-child(3)::after  { background: linear-gradient(90deg, var(--blue), var(--orange)); }
/* 行2: STEP5→6, 6→7, 7→8 */
.flow-timeline__item:nth-child(5)::after,
.flow-timeline__item:nth-child(6)::after { background: var(--orange); }
.flow-timeline__item:nth-child(7)::after  { background: linear-gradient(90deg, var(--orange), var(--teal)); }
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
.flow-timeline__dot--step-1 { background: #60a5fa; }
.flow-timeline__dot--step-2 { background: #3b82f6; }
.flow-timeline__dot--step-3 { background: #2563eb; }
.flow-timeline__dot--step-4 { background: #1d4ed8; }
.flow-timeline__dot--step-5 { background: #1e40af; }
.flow-timeline__dot--step-6 { background: #1e3a8a; }
.flow-timeline__dot--step-7 { background: #1a3070; }
.flow-timeline__dot--step-8 { background: #172554; }
.flow-timeline__num {
    font-size: .7rem; font-weight: 700; letter-spacing: .08em;
    color: var(--blue); margin-bottom: 4px; display: block;
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
.step-card--final { border: 2px solid var(--teal); }
.step-card__header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 24px 32px;
    color: var(--white);
}
.step-card__header--step-1 { background: linear-gradient(135deg, #3b82f6, #93c5fd); }
.step-card__header--step-2 { background: linear-gradient(135deg, #2563eb, #60a5fa); }
.step-card__header--step-3 { background: linear-gradient(135deg, #1d4ed8, #3b82f6); }
.step-card__header--step-4 { background: linear-gradient(135deg, #1e40af, #2563eb); }
.step-card__header--step-5 { background: linear-gradient(135deg, #1e3a8a, #1d4ed8); }
.step-card__header--step-6 { background: linear-gradient(135deg, #1a3070, #1e3a8a); }
.step-card__header--step-7 { background: linear-gradient(135deg, #172554, #1a3070); }
.step-card__header--step-8 { background: linear-gradient(135deg, #0f172a, #172554); }
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
    color: var(--blue); font-weight: 700; font-size: .85rem;
}

/* ---- STEP TIP ---- */
.step-tip {
    border-radius: var(--radius-md);
    padding: 20px;
    margin-bottom: 20px;
}
.step-tip--blue { background: var(--blue-light); }
.step-tip--orange { background: var(--orange-light); }
.step-tip--teal { background: var(--teal-light); }
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
.cost-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
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
.cost-card__formula { font-size: .9rem; font-weight: 700; color: var(--blue); margin-bottom: 6px; }
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
.faq-item.is-open { border-color: var(--blue); }
.faq-item__q {
    width: 100%;
    display: flex; align-items: center; gap: 14px;
    padding: 18px 20px;
    text-align: left;
    font-size: .95rem; font-weight: 700; color: var(--dark);
    background: var(--white);
    transition: background var(--transition);
}
.faq-item.is-open .faq-item__q { background: var(--blue-light); color: var(--blue); }
.faq-item__q-icon {
    flex-shrink: 0; width: 28px; height: 28px;
    background: var(--blue); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700;
}
.faq-item.is-open .faq-item__q-icon { background: var(--blue-dark); }
.faq-item__arrow {
    width: 20px; height: 20px; margin-left: auto; flex-shrink: 0;
    color: var(--text-light);
    transition: transform var(--transition);
}
.faq-item.is-open .faq-item__arrow { transform: rotate(180deg); color: var(--blue); }
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
    background: var(--orange); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700; margin-top: 2px;
}

/* ---- CTA ---- */
.flow-cta { background: linear-gradient(135deg, #0f2460 0%, #1a4cbd 60%, #2f7cff 100%); padding: 80px 0; }
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

/* ---- REVEAL ANIMATION ---- */
.reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }
.reveal.visible { opacity: 1; transform: none; }

/* ---- RESPONSIVE ---- */
@media (max-width: 900px) {
    .flow-timeline { grid-template-columns: repeat(2, 1fr); gap: 24px; }
    /* 2列時: 偶数番目が行末なので線を非表示、奇数番目は次へ線を引く */
    .flow-timeline__item:not(:nth-child(4n))::after { display: none; }
    .flow-timeline__item:nth-child(odd):not(:last-child)::after { display: block; }
    .step-card__cols { grid-template-columns: 1fr; }
    .step-card__subtitle { display: none; }
    .cost-grid { grid-template-columns: repeat(2, 1fr); }
    .step-card__header { flex-wrap: wrap; }
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

</script>

@endsection
