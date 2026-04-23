<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '管理画面') | ワンステップテックス不動産</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { font-size: 15px; }
        body {
            font-family: 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', sans-serif;
            background: #f0f2f8;
            color: #2b2d42;
            min-height: 100vh;
            display: flex;
        }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        button { cursor: pointer; font-family: inherit; }

        /* Sidebar */
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: #1e2235;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
        }
        .sidebar__brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }
        .sidebar__brand-title {
            font-size: .8rem;
            font-weight: 700;
            color: rgba(255,255,255,.5);
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .sidebar__brand-name {
            font-size: .95rem;
            font-weight: 700;
            color: #fff;
            margin-top: 4px;
        }
        .sidebar__nav { padding: 16px 12px; flex: 1; }
        .sidebar__nav-label {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255,255,255,.3);
            padding: 0 8px;
            margin-bottom: 8px;
            margin-top: 16px;
        }
        .sidebar__nav-label:first-child { margin-top: 0; }
        .sidebar__nav-item a, .sidebar__nav-item button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: .88rem;
            font-weight: 500;
            color: rgba(255,255,255,.6);
            background: none;
            border: none;
            text-align: left;
            transition: background .2s, color .2s;
        }
        .sidebar__nav-item a:hover,
        .sidebar__nav-item button:hover { background: rgba(255,255,255,.08); color: #fff; }
        .sidebar__nav-item a.active { background: #2f7cff; color: #fff; }
        .sidebar__nav-item .badge {
            margin-left: auto;
            background: #f17c20;
            color: #fff;
            font-size: .7rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 50px;
            min-width: 20px;
            text-align: center;
        }
        .sidebar__footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.07);
        }

        /* Main */
        .main {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e4e6f0;
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar__title { font-size: 1rem; font-weight: 700; color: #2b2d42; }
        .topbar__user { font-size: .82rem; color: #7b7b9a; }
        .content { padding: 32px; flex: 1; }

        /* Cards */
        .card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e4e6f0;
            overflow: hidden;
        }
        .card__header {
            padding: 20px 24px;
            border-bottom: 1px solid #e4e6f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .card__title { font-size: 1rem; font-weight: 700; }
        .card__body { padding: 24px; }

        /* Stats */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e4e6f0;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-card__icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .stat-card__icon--blue { background: #e8f0fe; }
        .stat-card__icon--orange { background: #fef0e4; }
        .stat-card__icon--teal { background: #e4f7f2; }
        .stat-card__num { font-size: 1.7rem; font-weight: 700; line-height: 1; }
        .stat-card__label { font-size: .8rem; color: #7b7b9a; margin-top: 4px; }

        /* Table */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th {
            padding: 12px 16px;
            text-align: left;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: #7b7b9a;
            background: #f8f9ff;
            border-bottom: 1px solid #e4e6f0;
            white-space: nowrap;
        }
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f2f8;
            font-size: .88rem;
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8f9ff; }
        tr.unread td { background: #f0f5ff; }
        tr.unread:hover td { background: #e8f0fe; }

        /* Badges */
        .badge-unread {
            display: inline-flex; align-items: center; gap: 4px;
            background: #fef0e4; color: #c96400;
            font-size: .72rem; font-weight: 700;
            padding: 2px 8px; border-radius: 50px;
        }
        .badge-read {
            display: inline-flex; align-items: center;
            background: #f0f2f8; color: #7b7b9a;
            font-size: .72rem; font-weight: 600;
            padding: 2px 8px; border-radius: 50px;
        }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: none; transition: .2s; }
        .btn--primary { background: #2f7cff; color: #fff; }
        .btn--primary:hover { background: #1a5fd9; }
        .btn--danger { background: #fee2e2; color: #b91c1c; }
        .btn--danger:hover { background: #fecaca; }
        .btn--ghost { background: transparent; color: #7b7b9a; border: 1px solid #e4e6f0; }
        .btn--ghost:hover { background: #f0f2f8; color: #2b2d42; }
        .btn--sm { padding: 5px 12px; font-size: .78rem; }

        /* Filter tabs */
        .filter-tabs { display: flex; gap: 4px; }
        .filter-tab {
            padding: 7px 16px; border-radius: 8px; font-size: .82rem; font-weight: 600;
            color: #7b7b9a; border: 1px solid transparent; text-decoration: none;
            transition: .15s;
        }
        .filter-tab:hover { background: #f0f2f8; color: #2b2d42; }
        .filter-tab.active { background: #2f7cff; color: #fff; border-color: #2f7cff; }

        /* Pagination */
        .pagination { display: flex; gap: 4px; justify-content: center; margin-top: 24px; }
        .pagination a, .pagination span {
            min-width: 36px; height: 36px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; font-weight: 600; color: #7b7b9a;
            border: 1px solid #e4e6f0; background: #fff;
        }
        .pagination a:hover { border-color: #2f7cff; color: #2f7cff; }
        .pagination span[aria-current] { background: #2f7cff; color: #fff; border-color: #2f7cff; }

        /* Alert */
        .alert {
            padding: 12px 16px; border-radius: 8px; font-size: .88rem; font-weight: 500;
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .alert--success { background: #e4f7f2; color: #2a7a5a; border: 1px solid #4eba9a; }
        .alert--error { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }

        /* Detail */
        .detail-grid { display: grid; grid-template-columns: 200px 1fr; gap: 0; }
        .detail-row { display: contents; }
        .detail-row dt, .detail-row dd {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f2f8;
            font-size: .9rem;
        }
        .detail-row dt { font-weight: 700; color: #7b7b9a; font-size: .8rem; text-transform: uppercase; letter-spacing: .05em; }
        .detail-row dd { white-space: pre-wrap; word-break: break-word; }

        /* Checkbox */
        input[type="checkbox"] { width: 16px; height: 16px; cursor: pointer; accent-color: #2f7cff; }

        /* Empty state */
        .empty-state { text-align: center; padding: 60px 24px; color: #7b7b9a; }
        .empty-state__icon { font-size: 2.5rem; margin-bottom: 12px; }
        .empty-state__text { font-size: .95rem; }

        /* Login */
        .login-wrap {
            min-height: 100vh; width: 100%; display: flex;
            align-items: center; justify-content: center;
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
        }
        .login-card { background: #fff; border-radius: 16px; padding: 40px; width: 380px; box-shadow: 0 20px 60px rgba(0,0,0,.2); }
        .login-card__logo { text-align: center; margin-bottom: 28px; }
        .login-card__logo-icon { font-size: 2rem; }
        .login-card__logo-title { font-size: 1rem; font-weight: 700; color: #2b2d42; margin-top: 8px; }
        .login-card__logo-sub { font-size: .8rem; color: #7b7b9a; margin-top: 2px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: .82rem; font-weight: 700; color: #2b2d42; margin-bottom: 6px; }
        .form-input {
            width: 100%; padding: 11px 14px; border: 1.5px solid #e4e6f0;
            border-radius: 8px; font-size: .9rem; font-family: inherit;
            outline: none; transition: .2s;
        }
        .form-input:focus { border-color: #2f7cff; box-shadow: 0 0 0 3px rgba(47,124,255,.1); }
        .form-error { font-size: .8rem; color: #b91c1c; margin-top: 4px; }
        .btn--full { width: 100%; justify-content: center; padding: 12px; font-size: .95rem; }
    </style>
</head>
<body>

@hasSection('login')
    @yield('content')
@else
<aside class="sidebar">
    <div class="sidebar__brand">
        <div class="sidebar__brand-title">Admin Panel</div>
        <div class="sidebar__brand-name">🏠 OST不動産</div>
    </div>
    <nav class="sidebar__nav">
        <div class="sidebar__nav-label">管理メニュー</div>
        <div class="sidebar__nav-item">
            <a href="{{ route('admin.properties.index') }}"
               class="{{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
                <span>🏠</span>
                <span>物件管理</span>
            </a>
        </div>
        <div class="sidebar__nav-item">
            <a href="{{ route('admin.contacts.index') }}"
               class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <span>📨</span>
                <span>お問い合わせ</span>
                @php $unread = \App\Models\Contact::whereNull('read_at')->count(); @endphp
                @if($unread > 0)
                    <span class="badge">{{ $unread }}</span>
                @endif
            </a>
        </div>
        <div class="sidebar__nav-item">
            <a href="{{ route('admin.news.index') }}"
               class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <span>📰</span>
                <span>お知らせ</span>
            </a>
        </div>
        <div class="sidebar__nav-label">サイト</div>
        <div class="sidebar__nav-item">
            <a href="{{ config('app.public_site_url', 'http://localhost:8013') }}" target="_blank">
                <span>🌐</span>
                <span>サイトを開く</span>
            </a>
        </div>
        <div class="sidebar__nav-item">
            <a href="{{ config('app.public_site_url', 'http://localhost:8013') }}/broker" target="_blank">
                <span>🔑</span>
                <span>業者確認ページ</span>
            </a>
        </div>
        <div class="sidebar__nav-label">設定</div>
        <div class="sidebar__nav-item">
            <a href="{{ route('admin.settings.index') }}"
               class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <span>⚙️</span>
                <span>サイト設定</span>
            </a>
        </div>
    </nav>
    <div class="sidebar__footer">
        <div class="sidebar__nav-item">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">
                    <span>🚪</span>
                    <span>ログアウト</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar__title">@yield('title', '管理画面')</div>
        <div class="topbar__user">管理者ログイン中</div>
    </header>
    <div class="content">
        @if(session('success'))
            <div class="alert alert--success">✅ {{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</div>
@endif

</body>
</html>
