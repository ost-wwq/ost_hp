@extends('admin.layouts.app')

@section('title', 'サイト設定')

@section('content')

<div style="max-width:720px;">

    {{-- 業者確認ページ設定 --}}
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <div class="card" style="margin-bottom:24px;">
            <div class="card__header">
                <div>
                    <div class="card__title">🔑 業者向け確認ページ設定</div>
                    <div style="font-size:.82rem;color:#7b7b9a;margin-top:4px;">
                        業者さんが物件のご紹介可能状況を確認するためのページです
                    </div>
                </div>
            </div>
            <div class="card__body" style="display:flex;flex-direction:column;gap:20px;">

                {{-- 公開URL --}}
                <div style="background:#f8f9ff;border:1px solid #e4e6f0;border-radius:10px;padding:16px;">
                    <div style="font-size:.78rem;font-weight:700;color:#7b7b9a;letter-spacing:.05em;text-transform:uppercase;margin-bottom:8px;">確認ページURL</div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <code style="font-size:.9rem;font-weight:700;color:#2f7cff;word-break:break-all;">{{ $brokerUrl }}</code>
                        <button type="button" onclick="copyUrl()" style="flex-shrink:0;padding:6px 14px;border-radius:6px;border:1px solid #e4e6f0;background:#fff;font-size:.78rem;font-weight:600;color:#7b7b9a;cursor:pointer;" id="copyBtn">
                            コピー
                        </button>
                    </div>
                    <div style="font-size:.78rem;color:#7b7b9a;margin-top:8px;">このURLを業者さんにお伝えください</div>
                </div>

                {{-- 有効/無効 --}}
                <div>
                    <label style="display:flex;align-items:center;gap:12px;cursor:pointer;padding:14px;background:#f8f9ff;border-radius:10px;border:1.5px solid #e4e6f0;">
                        <input type="checkbox" name="broker_enabled" value="1"
                               {{ $settings['broker_enabled'] === '1' ? 'checked' : '' }}
                               style="width:18px;height:18px;accent-color:#2f7cff;flex-shrink:0;">
                        <div>
                            <div style="font-weight:700;font-size:.9rem;">確認ページを有効にする</div>
                            <div style="font-size:.78rem;color:#7b7b9a;margin-top:2px;">無効にするとPINを入力してもアクセスできなくなります</div>
                        </div>
                    </label>
                </div>

                {{-- PIN --}}
                <div>
                    <label style="display:block;font-size:.82rem;font-weight:700;color:#2b2d42;margin-bottom:8px;">
                        4桁PIN <span style="color:#f17c20;">*</span>
                    </label>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <input type="text" name="broker_pin"
                               value="{{ $settings['broker_pin'] }}"
                               maxlength="4" pattern="\d{4}"
                               class="form-input"
                               style="width:120px;font-size:1.4rem;font-weight:700;letter-spacing:.3em;text-align:center;"
                               id="pinInput"
                               inputmode="numeric"
                               required>
                        <button type="button" onclick="genPin()" style="padding:10px 16px;border-radius:8px;border:1px solid #e4e6f0;background:#fff;font-size:.82rem;font-weight:600;color:#7b7b9a;cursor:pointer;">
                            🎲 ランダム生成
                        </button>
                    </div>
                    @error('broker_pin')
                        <div style="color:#b91c1c;font-size:.8rem;margin-top:4px;">{{ $message }}</div>
                    @enderror
                    <div style="font-size:.78rem;color:#7b7b9a;margin-top:6px;">0〜9の数字4桁で設定してください</div>
                </div>

                {{-- タイトル --}}
                <div>
                    <label style="display:block;font-size:.82rem;font-weight:700;color:#2b2d42;margin-bottom:8px;">
                        ページタイトル <span style="color:#f17c20;">*</span>
                    </label>
                    <input type="text" name="broker_title"
                           value="{{ $settings['broker_title'] }}"
                           class="form-input"
                           placeholder="物件ご紹介可能確認"
                           required>
                </div>

                {{-- 注意書き --}}
                <div>
                    <label style="display:block;font-size:.82rem;font-weight:700;color:#2b2d42;margin-bottom:8px;">
                        業者向け案内文（任意）
                    </label>
                    <textarea name="broker_note" class="form-input" rows="3"
                              placeholder="例：ご不明な点はお電話にてお問い合わせください。">{{ $settings['broker_note'] }}</textarea>
                    <div style="font-size:.78rem;color:#7b7b9a;margin-top:4px;">確認ページの冒頭に表示される案内文です</div>
                </div>

            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;">
            <button type="submit" class="btn btn--primary">💾 設定を保存する</button>
        </div>
    </form>

    {{-- プレビュー --}}
    <div class="card" style="margin-top:24px;">
        <div class="card__header">
            <div class="card__title">📱 確認ページのプレビュー</div>
        </div>
        <div class="card__body" style="text-align:center;">
            <a href="{{ $brokerUrl }}" target="_blank" class="btn btn--ghost">
                🌐 確認ページを別タブで開く
            </a>
        </div>
    </div>

</div>

<style>
.form-input { width:100%; padding:10px 14px; border:1.5px solid #e4e6f0; border-radius:8px; font-size:.9rem; font-family:inherit; outline:none; transition:.2s; background:#fff; }
.form-input:focus { border-color:#2f7cff; box-shadow:0 0 0 3px rgba(47,124,255,.1); }
textarea.form-input { resize:vertical; }
</style>

<script>
function copyUrl() {
    var url = '{{ $brokerUrl }}';
    navigator.clipboard.writeText(url).then(function() {
        var btn = document.getElementById('copyBtn');
        btn.textContent = '✅ コピーしました';
        setTimeout(function() { btn.textContent = 'コピー'; }, 2000);
    });
}
function genPin() {
    var pin = String(Math.floor(Math.random() * 10000)).padStart(4, '0');
    document.getElementById('pinInput').value = pin;
}
</script>

@endsection
