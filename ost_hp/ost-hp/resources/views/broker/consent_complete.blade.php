<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>広告掲載許可申請完了 | ワンステップテックス不動産</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --blue: #2f7cff; --border: #e8e8f0; --bg: #f0f2f8; --dark: #2b2d42; }
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background: var(--bg);
            color: var(--dark);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
        .header {
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
        }
        .header__inner {
            max-width: 720px;
            margin: 0 auto;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
        }
        .header__brand-logo { font-size: 1.3rem; }
        .header__brand-name { font-size: .9rem; font-weight: 700; }

        .complete-wrap {
            max-width: 520px;
            margin: 60px auto;
            padding: 0 24px;
            text-align: center;
        }
        .complete-icon { font-size: 4rem; margin-bottom: 20px; }
        .complete-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 10px; }
        .complete-text { font-size: .9rem; color: #6060a0; line-height: 1.7; margin-bottom: 32px; }

        .prop-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 32px;
            text-align: left;
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 8px 20px;
            font-size: .9rem;
        }
        .prop-card__label { color: #9090b0; font-size: .82rem; }
        .prop-card__value { font-weight: 600; }
        .prop-card__value--price { color: var(--blue); font-weight: 700; font-size: 1rem; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 13px 36px;
            font-size: .95rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(47,124,255,.35);
            transition: opacity .2s;
        }
        .btn-back:hover { opacity: .9; }
    </style>
</head>
<body>

<div class="header">
    <div class="header__inner">
        <span class="header__brand-logo">🏠</span>
        <span class="header__brand-name">ワンステップテックス不動産</span>
    </div>
</div>

<div class="complete-wrap">
    <div class="complete-icon">✅</div>
    <h1 class="complete-title">広告掲載許可申請が完了しました</h1>
    <p class="complete-text">
        以下の物件の広告掲載許可申請を受け付けました。<br>
        内容を確認後、担当者よりご連絡いたします。
    </p>

    <div class="prop-card">
        <span class="prop-card__label">物件種類</span>
        <span class="prop-card__value">{{ $property->typeLabel() }}</span>
        <span class="prop-card__label">物件名称</span>
        <span class="prop-card__value">{{ $property->title }}</span>
        <span class="prop-card__label">価格</span>
        <span class="prop-card__value prop-card__value--price">{{ $property->priceFormatted() }}</span>
    </div>

    <a href="{{ route('broker.properties') }}" class="btn-back">
        ← 最新状態確認画面に戻る
    </a>
</div>

</body>
</html>
