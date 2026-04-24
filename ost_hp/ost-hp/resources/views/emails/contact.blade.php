<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: 'Hiragino Kaku Gothic ProN', 'メイリオ', sans-serif; background: #f8f9ff; margin: 0; padding: 24px; color: #2b2d42; }
  .wrap { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.08); }
  .head { background: linear-gradient(135deg, #1a4cbd 0%, #2f7cff 100%); padding: 32px 40px; }
  .head h1 { color: #fff; font-size: 20px; margin: 0; }
  .head p { color: rgba(255,255,255,.8); font-size: 13px; margin: 6px 0 0; }
  .body { padding: 32px 40px; }
  .row { margin-bottom: 20px; border-bottom: 1px solid #e8e8f0; padding-bottom: 20px; }
  .row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
  .label { font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: #7b7b9a; margin-bottom: 6px; }
  .value { font-size: 15px; color: #2b2d42; line-height: 1.7; white-space: pre-wrap; word-break: break-word; }
  .foot { background: #f8f9ff; padding: 20px 40px; text-align: center; font-size: 12px; color: #aaa; border-top: 1px solid #e8e8f0; }
</style>
</head>
<body>
<div class="wrap">
  <div class="head">
    <h1>🏠 お問い合わせが届きました</h1>
    <p>ワンステップテックス不動産 ホームページより</p>
  </div>
  <div class="body">
    <div class="row">
      <div class="label">お名前</div>
      <div class="value">{{ $data['name'] }}</div>
    </div>
    <div class="row">
      <div class="label">メールアドレス</div>
      <div class="value"><a href="mailto:{{ $data['email'] }}" style="color:#2f7cff;">{{ $data['email'] }}</a></div>
    </div>
    @if(!empty($data['subject']))
    <div class="row">
      <div class="label">件名</div>
      <div class="value">{{ $data['subject'] }}</div>
    </div>
    @endif
    <div class="row">
      <div class="label">お問い合わせ内容</div>
      <div class="value">{{ $data['message'] }}</div>
    </div>
  </div>
  <div class="foot">
    <div style="text-align:left;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid #e4e6f0;font-size:.82rem;color:#4a4a6a;line-height:2;">
        ────────────────────────────────────<br>
        株式会社ワンステップテックス<br>
        埼玉知事(1)第25759号<br>
        TEL：090-8506-0043<br>
        FAX：048-458-0527<br>
        E-mail：<a href="mailto:info@house.onesteptechs.com" style="color:#1a4cbd;">info@house.onesteptechs.com</a><br>
        WebPage：<a href="https://www.house.onesteptechs.com" style="color:#1a4cbd;">https://www.house.onesteptechs.com</a><br>
        ────────────────────────────────────
    </div>
    &copy; {{ date('Y') }} ワンステップテックス不動産 — このメールはホームページのお問い合わせフォームから自動送信されました。
  </div>
</div>
</body>
</html>
