<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - 内見予約</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', sans-serif;
            background: #f0f2f8;
            color: #2b2d42;
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 32px 16px;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0,0,0,.08);
            width: 100%;
            max-width: 480px;
        }
        .card__header { padding: 20px 24px; border-bottom: 1px solid #f0f2f8; }
        .card__body { padding: 24px; display: flex; flex-direction: column; gap: 18px; }
        .field label { display:block; font-size:.8rem; font-weight:700; color:#334155; margin-bottom:6px; }
        .field label .req { color:#e53e3e; margin-left:4px; font-size:.72rem; }
        .field input[type=text],
        .field input[type=tel],
        .field input[type=email] {
            width:100%; padding:10px 14px; border:1px solid #e4e6f0; border-radius:8px;
            font-size:.95rem; font-family:inherit; outline:none; transition:border-color .15s;
        }
        .field input:focus { border-color:#2f7cff; }
        .field .error { font-size:.75rem; color:#e53e3e; margin-top:4px; }
        .file-label {
            display:flex; align-items:center; gap:8px; padding:10px 14px;
            border:1px dashed #c8cce0; border-radius:8px; cursor:pointer;
            font-size:.85rem; color:#7b7b9a; transition:border-color .15s;
        }
        .file-label:hover { border-color:#2f7cff; color:#2f7cff; }
        .file-preview {
            display:none; width:100%; max-height:160px; object-fit:cover;
            border-radius:8px; border:1px solid #e4e6f0; margin-top:8px;
        }
        .privacy-row {
            display:flex; align-items:flex-start; gap:10px;
            padding:14px 16px; background:#f8f9ff; border-radius:8px;
        }
        .privacy-row input[type=checkbox] { margin-top:2px; flex-shrink:0; width:16px; height:16px; cursor:pointer; }
        .privacy-row label { font-size:.82rem; color:#334155; line-height:1.6; cursor:pointer; }
        .privacy-row a { color:#2f7cff; text-decoration:underline; }
        .btn-submit {
            width:100%; padding:14px; border:none; border-radius:10px;
            background:#2f7cff; color:#fff; font-size:.95rem; font-weight:700;
            font-family:inherit; cursor:pointer; letter-spacing:.03em;
            transition:background .15s;
        }
        .btn-submit:hover { background:#1a6ae8; }
        .note { padding:12px 16px; background:#f8f9ff; border-radius:8px; font-size:.78rem; color:#7b7b9a; line-height:1.7; }
    </style>
</head>
<body>
<div class="card">
    <div class="card__header">
        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">内見予約</div>
        <div style="font-size:1.1rem;font-weight:700;">{{ $property->title }}</div>
    </div>
    <div class="card__body">

        <div class="note">
            内見をご希望の方は、以下のフォームにご入力ください。<br>
            ご入力後にキーボックス情報をご案内いたします。
        </div>

        <form method="POST" action="{{ route('property.viewing.store', $property->viewing_token) }}"
              enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:16px;">
            @csrf

            <div class="field">
                <label>お名前<span class="req">必須</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="山田 太郎" autocomplete="name">
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>電話番号<span class="req">必須</span></label>
                <input type="tel" name="phone" value="{{ old('phone') }}"
                       placeholder="090-0000-0000" autocomplete="tel">
                @error('phone')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>メールアドレス<span class="req">必須</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="example@email.com" autocomplete="email">
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>予約日時<span class="req">必須</span></label>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <div>
                        <input type="date" name="reserved_date" value="{{ old('reserved_date') }}"
                               min="{{ date('Y-m-d') }}"
                               style="width:100%;padding:10px 14px;border:1px solid #e4e6f0;border-radius:8px;font-size:.95rem;font-family:inherit;outline:none;">
                        @error('reserved_date')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <select name="reserved_time"
                                style="width:100%;padding:10px 14px;border:1px solid #e4e6f0;border-radius:8px;font-size:.95rem;font-family:inherit;outline:none;background:#fff;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237b7b9a' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;">
                            <option value="">時間を選択</option>
                            @php
                                for ($h = 9; $h <= 19; $h++) {
                                    $times[] = sprintf('%02d:00', $h);
                                    if ($h < 19) $times[] = sprintf('%02d:30', $h);
                                }
                            @endphp
                            @foreach($times as $t)
                                <option value="{{ $t }}" {{ old('reserved_time') === $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                        @error('reserved_time')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label>名刺<span style="font-size:.72rem;color:#7b7b9a;margin-left:4px;">任意・JPG / PNG / PDF</span></label>
                <input type="file" name="business_card" id="business-card-input"
                       accept="image/*,application/pdf" style="display:none;"
                       onchange="onCardSelected(this)">
                <label for="business-card-input" class="file-label" id="file-label-text">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span id="file-label-name">ファイルを選択</span>
                </label>
                <img id="card-preview" class="file-preview" alt="名刺プレビュー">
                @error('business_card')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="privacy-row">
                <input type="checkbox" name="privacy" id="privacy" value="1"
                       {{ old('privacy') ? 'checked' : '' }}>
                <label for="privacy">
                    <a href="{{ route('privacy-policy') }}" target="_blank">プライバシーポリシー</a>に同意する
                </label>
            </div>
            @error('privacy')<div style="font-size:.75rem;color:#e53e3e;margin-top:-10px;">{{ $message }}</div>@enderror

            <button type="submit" class="btn-submit">内見予約を申し込む</button>
        </form>

    </div>
</div>

<script>
    function onCardSelected(input) {
        var label = document.getElementById('file-label-name');
        var preview = document.getElementById('card-preview');
        if (input.files && input.files[0]) {
            var file = input.files[0];
            label.textContent = file.name;
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        } else {
            label.textContent = 'ファイルを選択';
            preview.style.display = 'none';
        }
    }
</script>
</body>
</html>
