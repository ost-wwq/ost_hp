@extends('admin.layouts.app')

@section('title', $property->title)

@section('content')

@php $sc = $property->statusColor(); @endphp

{{-- ヘッダー --}}
<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <a href="{{ route('admin.properties.index') }}" class="btn btn--ghost btn--sm">← 一覧に戻る</a>
    <div style="flex:1;min-width:0;">
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <h1 style="font-size:1.2rem;font-weight:700;margin:0;">{{ $property->title }}</h1>
            <span style="
                display:inline-block;padding:3px 12px;border-radius:50px;font-size:.75rem;font-weight:700;
                background:{{ $sc==='teal'?'#e4f7f2':($sc==='orange'?'#fef0e4':'#f0f2f8') }};
                color:{{ $sc==='teal'?'#1a7a5a':($sc==='orange'?'#c96400':'#7b7b9a') }};">
                {{ $property->statusLabel() }}
            </span>
            @if($property->published)
                <span style="display:inline-block;padding:3px 12px;border-radius:50px;font-size:.75rem;font-weight:700;background:#e4f0ff;color:#2f7cff;">公開中</span>
            @else
                <span style="display:inline-block;padding:3px 12px;border-radius:50px;font-size:.75rem;font-weight:700;background:#f0f2f8;color:#7b7b9a;">非公開</span>
            @endif
        </div>
    </div>
    <div style="display:flex;gap:8px;flex-shrink:0;flex-wrap:wrap;">
        <a href="{{ route('admin.properties.consents', $property) }}" class="btn btn--ghost btn--sm">
            物件広告掲載許可申請一覧確認
            @php $consentCount = $property->consents()->count(); @endphp
            @if($consentCount > 0)
                <span style="display:inline-block;margin-left:4px;padding:1px 7px;border-radius:50px;font-size:.7rem;font-weight:700;background:#2f7cff;color:#fff;">{{ $consentCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.properties.viewings', $property) }}" class="btn btn--ghost btn--sm">
            内見予約申し込み一覧確認
            @php $viewingCount = $property->viewingReservations()->count(); @endphp
            @if($viewingCount > 0)
                <span style="display:inline-block;margin-left:4px;padding:1px 7px;border-radius:50px;font-size:.7rem;font-weight:700;background:#2f7cff;color:#fff;">{{ $viewingCount }}</span>
            @endif
        </a>
        <form method="POST" action="{{ route('admin.properties.toggle-publish', $property) }}" style="display:inline;">
            @csrf @method('PATCH')
            <button class="btn btn--sm {{ $property->published ? 'btn--ghost' : 'btn--primary' }}">
                {{ $property->published ? '非公開にする' : '公開する' }}
            </button>
        </form>
        <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn--primary btn--sm">編集</a>
        <form method="POST" action="{{ route('admin.properties.destroy', $property) }}"
              onsubmit="return confirm('「{{ $property->title }}」を削除しますか？この操作は元に戻せません。')">
            @csrf @method('DELETE')
            <button class="btn btn--danger btn--sm">削除</button>
        </form>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 280px;gap:20px;align-items:start;">

    {{-- 左カラム --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- メイン画像 / PDF --}}
        @if($property->main_image_data)
        <div class="card">
            <div class="card__header"><div class="card__title">メイン画像 / PDF</div></div>
            <div class="card__body" style="padding:0;">
                @if($property->main_image_mime === 'application/pdf')
                    <div style="padding:8px 12px;border-bottom:1px solid #e4e6f0;display:flex;justify-content:flex-end;">
                        <a href="{{ route('admin.properties.main-image', $property) }}" target="_blank"
                           style="font-size:.8rem;color:#2f7cff;">↗ 新しいタブで開く</a>
                    </div>
                    <embed src="{{ route('admin.properties.main-image', $property) }}" type="application/pdf"
                           style="width:100%;height:85vh;min-height:800px;border:none;border-radius:0 0 12px 12px;display:block;">
                @else
                    <img src="{{ route('admin.properties.main-image', $property) }}" alt="{{ $property->title }}"
                         style="width:100%;display:block;border-radius:0 0 12px 12px;">
                @endif
            </div>
        </div>
        @endif

        {{-- 追加画像 --}}
        @if($property->images && count($property->images) > 0)
        <div class="card">
            <div class="card__header"><div class="card__title">追加画像</div></div>
            <div class="card__body">
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;">
                    @foreach($property->images as $key)
                    <img src="{{ route('admin.properties.image', [$property, $key]) }}" alt=""
                         style="width:100%;height:110px;object-fit:cover;border-radius:8px;border:1px solid #e4e6f0;">
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- 物件説明 --}}
        @if($property->description)
        <div class="card">
            <div class="card__header"><div class="card__title">物件説明</div></div>
            <div class="card__body">
                <p style="white-space:pre-wrap;word-break:break-word;line-height:1.8;font-size:.9rem;">{{ $property->description }}</p>
            </div>
        </div>
        @endif

        {{-- 物件情報 --}}
        <div class="card">
            <div class="card__header"><div class="card__title">物件情報</div></div>
            <div class="card__body" style="padding:0;">
                <dl style="margin:0;">
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">種別</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->typeLabel() }}</dd>
                    </div>
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">価格</dt>
                        <dd style="padding:12px 16px;font-size:1rem;font-weight:700;color:#2f7cff;">{{ $property->priceFormatted() }}</dd>
                    </div>
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">所在地</dt>
                        <dd style="padding:12px 16px;font-size:.85rem;word-break:break-all;">{{ $property->address }}</dd>
                    </div>
                    @if($property->area)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">面積</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->area }} ㎡</dd>
                    </div>
                    @endif
                    @if($property->rooms)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">間取り</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->rooms }}</dd>
                    </div>
                    @endif
                    @if($property->age !== null)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">築年数</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->age }} 年</dd>
                    </div>
                    @endif
                    <div style="display:grid;grid-template-columns:90px 1fr;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">ステータス</dt>
                        <dd style="padding:12px 16px;">
                            <span style="
                                display:inline-block;padding:3px 10px;border-radius:50px;font-size:.75rem;font-weight:700;
                                background:{{ $sc==='teal'?'#e4f7f2':($sc==='orange'?'#fef0e4':'#f0f2f8') }};
                                color:{{ $sc==='teal'?'#1a7a5a':($sc==='orange'?'#c96400':'#7b7b9a') }};">
                                {{ $property->statusLabel() }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- オーナー情報 --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">オーナー情報</div>
                <div style="display:flex;gap:8px;">
                    @if($property->owner)
                    <a href="{{ route('admin.reports.create', ['sent_to' => $property->owner->email, 'property_id' => $property->id]) }}"
                       class="btn btn--primary btn--sm">報告</a>
                    @endif
                    <a href="{{ route('admin.properties.owner', $property) }}" class="btn btn--ghost btn--sm">設定</a>
                </div>
            </div>
            <div class="card__body" style="padding:0;">
                @if($property->owner)
                <dl style="margin:0;">
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">氏名</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;font-weight:600;">
                            <a href="{{ route('admin.owners.show', $property->owner) }}" style="color:#2f7cff;">{{ $property->owner->name }}</a>
                        </dd>
                    </div>
                    @if($property->owner->kana)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">フリガナ</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->owner->kana }}</dd>
                    </div>
                    @endif
                    @if($property->owner->phone)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">電話番号</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->owner->phone }}</dd>
                    </div>
                    @endif
                    @if($property->owner->email)
                    <div style="display:grid;grid-template-columns:90px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">メール</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;word-break:break-all;">{{ $property->owner->email }}</dd>
                    </div>
                    @endif
                    @if($property->owner->address)
                    <div style="display:grid;grid-template-columns:90px 1fr;">
                        <dt style="padding:12px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">住所</dt>
                        <dd style="padding:12px 16px;font-size:.9rem;">{{ $property->owner->address }}</dd>
                    </div>
                    @endif
                </dl>
                @else
                <div style="padding:24px;font-size:.88rem;color:#9090b0;">
                    未設定 — <a href="{{ route('admin.properties.owner', $property) }}" style="color:#2f7cff;">オーナーを設定する</a>
                </div>
                @endif
            </div>
        </div>

        {{-- 最新状態確認 / 内見予約設定 横並び --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">

        {{-- 最新状態確認URL --}}
        <div class="card">
            <div class="card__header"><div class="card__title">最新状態確認</div></div>
            <div class="card__body" style="display:flex;flex-direction:column;gap:16px;">

                @if($property->confirm_token)
                    @php $confirmUrl = config('app.public_site_url', 'http://localhost:8013') . '/confirm/' . $property->confirm_token; @endphp

                    {{-- 無効にする --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <div>
                            <div style="font-size:.82rem;font-weight:600;color:#1a7a5a;">有効</div>
                            <div style="font-size:.72rem;color:#7b7b9a;margin-top:1px;">確認番号：{{ $property->confirm_pin }}</div>
                        </div>
                        <form method="POST" action="{{ route('admin.properties.toggle-confirm', $property) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn--ghost btn--sm"
                                    onclick="return confirm('確認URLを無効にしますか？')">無効にする</button>
                        </form>
                    </div>

                    {{-- URL --}}
                    <div>
                        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">確認URL</div>
                        <div style="display:flex;align-items:center;gap:6px;">
                            <input type="text" value="{{ $confirmUrl }}" readonly id="confirm-url-input"
                                   style="flex:1;font-size:.7rem;padding:6px 8px;border:1px solid #e4e6f0;border-radius:6px;background:#f8f9ff;color:#334155;min-width:0;">
                            <button type="button" onclick="copyConfirmUrl()"
                                    style="flex-shrink:0;padding:6px 10px;font-size:.72rem;background:#f0f2f8;border:1px solid #e4e6f0;border-radius:6px;cursor:pointer;">コピー</button>
                        </div>
                        <a href="{{ $confirmUrl }}" target="_blank"
                           style="display:inline-block;margin-top:5px;font-size:.75rem;color:#2f7cff;">↗ 確認ページを開く</a>
                    </div>

                    {{-- QRコード --}}
                    <div>
                        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:8px;">QRコード</div>
                        <div style="border:1px solid #e4e6f0;border-radius:8px;overflow:hidden;display:flex;justify-content:center;align-items:center;background:#fff;padding:12px;">
                            <div id="qr-container"></div>
                        </div>
                        <button type="button" onclick="downloadQr()"
                                style="margin-top:8px;width:100%;padding:7px;font-size:.78rem;background:#f0f2f8;border:1px solid #e4e6f0;border-radius:6px;cursor:pointer;">
                            ↓ QRコードをダウンロード
                        </button>
                    </div>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                    <script>
                        var qr = new QRCode(document.getElementById('qr-container'), {
                            text: '{{ $confirmUrl }}',
                            width: 200,
                            height: 200,
                            colorDark: '#000000',
                            colorLight: '#ffffff',
                            correctLevel: QRCode.CorrectLevel.H
                        });

                        function copyConfirmUrl() {
                            var input = document.getElementById('confirm-url-input');
                            input.select();
                            document.execCommand('copy');
                            alert('URLをコピーしました');
                        }

                        function downloadQr() {
                            var canvas = document.querySelector('#qr-container canvas');
                            if (canvas) {
                                var a = document.createElement('a');
                                a.download = '確認QR_{{ $property->id }}.png';
                                a.href = canvas.toDataURL('image/png');
                                a.click();
                            }
                        }
                    </script>

                @else
                    {{-- 有効にする（PIN入力フォーム） --}}
                    <div style="font-size:.82rem;color:#7b7b9a;margin-bottom:4px;">確認不可（URLが無効です）</div>
                    <form method="POST" action="{{ route('admin.properties.toggle-confirm', $property) }}"
                          style="display:flex;flex-direction:column;gap:10px;">
                        @csrf @method('PATCH')
                        <div>
                            <label style="font-size:.78rem;font-weight:600;display:block;margin-bottom:6px;">4桁の確認番号を設定</label>
                            <input type="text" name="confirm_pin" inputmode="numeric" maxlength="4"
                                   pattern="\d{4}" placeholder="0000" required
                                   style="width:100%;padding:8px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:1.1rem;font-weight:700;letter-spacing:.3em;text-align:center;">
                            @error('confirm_pin')
                                <div style="font-size:.75rem;color:#dc2626;margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn--primary btn--sm">有効にする</button>
                    </form>
                @endif

            </div>
        </div>

        {{-- 内見予約設定 --}}
        <div class="card">
            <div class="card__header"><div class="card__title">内見予約設定</div></div>
            <div class="card__body" style="display:flex;flex-direction:column;gap:16px;">

                @if($property->viewing_enabled)
                    @php $viewingUrl = config('app.public_site_url', 'http://localhost:8013') . '/viewing/' . $property->viewing_token; @endphp

                    {{-- 有効状態 --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <div style="font-size:.82rem;font-weight:600;color:#1a7a5a;">有効</div>
                        <form method="POST" action="{{ route('admin.properties.toggle-viewing', $property) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn--ghost btn--sm"
                                    onclick="return confirm('内見予約設定を無効にしますか？')">無効にする</button>
                        </form>
                    </div>

                    {{-- 設定値編集フォーム --}}
                    <form method="POST" action="{{ route('admin.properties.update-viewing', $property) }}"
                          enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:12px;">
                        @csrf @method('PATCH')

                        <div>
                            <label style="font-size:.75rem;font-weight:600;color:#7b7b9a;display:block;margin-bottom:4px;">キーボックス番号</label>
                            <input type="text" name="viewing_keybbox_number"
                                   value="{{ old('viewing_keybbox_number', $property->viewing_keybbox_number) }}"
                                   placeholder="例：1234"
                                   style="width:100%;padding:7px 10px;border:1px solid #e4e6f0;border-radius:6px;font-size:.85rem;box-sizing:border-box;">
                        </div>

                        <div>
                            <label style="font-size:.75rem;font-weight:600;color:#7b7b9a;display:block;margin-bottom:4px;">キーボックス画像</label>
                            @if($property->viewing_keybbox_image_data)
                                <div style="margin-bottom:6px;">
                                    <img src="{{ route('admin.properties.keybbox-image', $property) }}" alt=""
                                         id="update-keybbox-preview"
                                         style="width:100%;max-height:140px;object-fit:cover;border-radius:6px;border:1px solid #e4e6f0;">
                                    <label style="display:flex;align-items:center;gap:5px;margin-top:5px;font-size:.75rem;color:#7b7b9a;cursor:pointer;">
                                        <input type="checkbox" name="delete_viewing_keybbox_image" value="1"> 画像を削除
                                    </label>
                                </div>
                            @else
                                <img id="update-keybbox-preview"
                                     style="display:none;width:100%;max-height:140px;object-fit:cover;border-radius:6px;border:1px solid #e4e6f0;margin-bottom:6px;">
                            @endif
                            <input type="file" name="viewing_keybbox_image" accept="image/*"
                                   style="font-size:.78rem;width:100%;"
                                   onchange="previewImage(this, 'update-keybbox-preview')">
                        </div>

                        <div>
                            <label style="font-size:.75rem;font-weight:600;color:#7b7b9a;display:block;margin-bottom:4px;">説明文</label>
                            <textarea name="viewing_keybbox_description" rows="3"
                                      placeholder="内見時の注意事項など"
                                      style="width:100%;padding:7px 10px;border:1px solid #e4e6f0;border-radius:6px;font-size:.82rem;resize:vertical;box-sizing:border-box;">{{ old('viewing_keybbox_description', $property->viewing_keybbox_description) }}</textarea>
                        </div>

                        @if($errors->hasAny(['viewing_keybbox_number', 'viewing_keybbox_description', 'viewing_keybbox_image']))
                            <div style="font-size:.75rem;color:#dc2626;">入力内容を確認してください。</div>
                        @endif

                        <button type="submit" class="btn btn--primary btn--sm">設定を保存</button>
                    </form>

                    {{-- 自動生成された内見予約URL＋QRコード --}}
                    <div>
                        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:4px;">内見予約リンク（自動生成）</div>
                        <div style="display:flex;align-items:center;gap:6px;">
                            <input type="text" value="{{ $viewingUrl }}" readonly id="viewing-url-input"
                                   style="flex:1;font-size:.7rem;padding:6px 8px;border:1px solid #e4e6f0;border-radius:6px;background:#f8f9ff;color:#334155;min-width:0;">
                            <button type="button" onclick="copyViewingUrl()"
                                    style="flex-shrink:0;padding:6px 10px;font-size:.72rem;background:#f0f2f8;border:1px solid #e4e6f0;border-radius:6px;cursor:pointer;">コピー</button>
                        </div>
                        <a href="{{ $viewingUrl }}" target="_blank"
                           style="display:inline-block;margin-top:5px;font-size:.75rem;color:#2f7cff;">↗ 予約ページを開く</a>
                    </div>

                    <div>
                        <div style="font-size:.72rem;color:#7b7b9a;margin-bottom:8px;">QRコード</div>
                        <div style="border:1px solid #e4e6f0;border-radius:8px;overflow:hidden;display:flex;justify-content:center;align-items:center;background:#fff;padding:12px;">
                            <div id="viewing-qr-container"></div>
                        </div>
                        <button type="button" onclick="downloadViewingQr()"
                                style="margin-top:8px;width:100%;padding:7px;font-size:.78rem;background:#f0f2f8;border:1px solid #e4e6f0;border-radius:6px;cursor:pointer;">
                            ↓ QRコードをダウンロード
                        </button>
                    </div>

                    @if(!$property->confirm_token)
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                    @endif
                    <script>
                        (function() {
                            var viewingQr = new QRCode(document.getElementById('viewing-qr-container'), {
                                text: '{{ addslashes($viewingUrl) }}',
                                width: 200,
                                height: 200,
                                colorDark: '#000000',
                                colorLight: '#ffffff',
                                correctLevel: QRCode.CorrectLevel.H
                            });

                            window.copyViewingUrl = function() {
                                var input = document.getElementById('viewing-url-input');
                                input.select();
                                document.execCommand('copy');
                                alert('URLをコピーしました');
                            };

                            window.downloadViewingQr = function() {
                                var canvas = document.querySelector('#viewing-qr-container canvas');
                                if (canvas) {
                                    var a = document.createElement('a');
                                    a.download = '内見予約QR_{{ $property->id }}.png';
                                    a.href = canvas.toDataURL('image/png');
                                    a.click();
                                }
                            };
                        })();
                    </script>

                @else

                    {{-- 無効状態 --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <div style="font-size:.82rem;color:#7b7b9a;">内見予約未設定</div>
                        <button type="button" class="btn btn--primary btn--sm"
                                onclick="document.getElementById('viewing-enable-dialog').showModal()">有効にする</button>
                    </div>

                @endif

            </div>
        </div>

        </div>{{-- /横並びグリッド --}}

    </div>

    {{-- 右カラム --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- 公開設定 --}}
        <div class="card">
            <div class="card__header"><div class="card__title">公開設定</div></div>
            <div class="card__body">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <span style="font-size:.9rem;">{{ $property->published ? '公開中' : '非公開' }}</span>
                    <form method="POST" action="{{ route('admin.properties.toggle-publish', $property) }}">
                        @csrf @method('PATCH')
                        <button class="btn btn--sm {{ $property->published ? 'btn--ghost' : 'btn--primary' }}">
                            {{ $property->published ? '非公開にする' : '公開する' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- 登録情報 --}}
        <div class="card">
            <div class="card__header"><div class="card__title">登録情報</div></div>
            <div class="card__body" style="padding:0;">
                <dl style="margin:0;">
                    <div style="display:grid;grid-template-columns:80px 1fr;border-bottom:1px solid #f0f2f8;">
                        <dt style="padding:10px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">登録日</dt>
                        <dd style="padding:10px 16px;font-size:.82rem;">{{ $property->created_at->format('Y/m/d H:i') }}</dd>
                    </div>
                    <div style="display:grid;grid-template-columns:80px 1fr;">
                        <dt style="padding:10px 16px;font-size:.78rem;font-weight:700;color:#7b7b9a;background:#fafbfd;">更新日</dt>
                        <dd style="padding:10px 16px;font-size:.82rem;">{{ $property->updated_at->format('Y/m/d H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

    </div>

</div>

{{-- 内見予約 有効化ダイアログ --}}
@if(!$property->viewing_enabled)
<style>
    #viewing-enable-dialog {
        border: none;
        border-radius: 14px;
        padding: 0;
        width: 420px;
        max-width: 95vw;
        box-shadow: 0 8px 40px rgba(0,0,0,.22);
        background: #fff;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0;
    }
    #viewing-enable-dialog::backdrop {
        background: rgba(0,0,0,.45);
    }
</style>
<dialog id="viewing-enable-dialog">
    <form method="POST" action="{{ route('admin.properties.toggle-viewing', $property) }}"
          enctype="multipart/form-data">
        @csrf @method('PATCH')

        <div style="padding:20px 24px 16px;border-bottom:1px solid #f0f2f8;display:flex;align-items:center;justify-content:space-between;">
            <span style="font-size:1rem;font-weight:700;">内見予約設定</span>
            <button type="button" onclick="document.getElementById('viewing-enable-dialog').close()"
                    style="background:none;border:none;font-size:1.3rem;cursor:pointer;color:#7b7b9a;line-height:1;">×</button>
        </div>

        <div style="padding:20px 24px;display:flex;flex-direction:column;gap:16px;">

            <div>
                <label style="font-size:.8rem;font-weight:600;display:block;margin-bottom:5px;">キーボックス番号</label>
                <input type="text" name="viewing_keybbox_number"
                       value="{{ old('viewing_keybbox_number') }}"
                       placeholder="例：1234"
                       style="width:100%;padding:8px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.9rem;box-sizing:border-box;">
            </div>

            <div>
                <label style="font-size:.8rem;font-weight:600;display:block;margin-bottom:5px;">キーボックス画像</label>
                <img id="dialog-keybbox-preview"
                     style="display:none;width:100%;max-height:160px;object-fit:cover;border-radius:8px;border:1px solid #e4e6f0;margin-bottom:6px;">
                <input type="file" name="viewing_keybbox_image" accept="image/*"
                       style="font-size:.85rem;width:100%;"
                       onchange="previewImage(this, 'dialog-keybbox-preview')">
            </div>

            <div>
                <label style="font-size:.8rem;font-weight:600;display:block;margin-bottom:5px;">説明文</label>
                <textarea name="viewing_keybbox_description" rows="3"
                          placeholder="内見時の注意事項など"
                          style="width:100%;padding:8px 12px;border:1px solid #e4e6f0;border-radius:8px;font-size:.85rem;resize:vertical;box-sizing:border-box;">{{ old('viewing_keybbox_description') }}</textarea>
            </div>

            @if($errors->hasAny(['viewing_keybbox_number', 'viewing_keybbox_description', 'viewing_keybbox_image']))
                <div style="font-size:.78rem;color:#dc2626;">入力内容を確認してください。</div>
            @endif

        </div>

        <div style="padding:12px 24px 20px;display:flex;justify-content:flex-end;gap:10px;">
            <button type="button" onclick="document.getElementById('viewing-enable-dialog').close()"
                    class="btn btn--ghost btn--sm">キャンセル</button>
            <button type="submit" class="btn btn--primary btn--sm">有効にする</button>
        </div>
    </form>
</dialog>

<script>
    @if($errors->hasAny(['viewing_keybbox_number', 'viewing_keybbox_description', 'viewing_keybbox_image']))
        document.getElementById('viewing-enable-dialog').showModal();
    @endif
</script>
@endif

<script>
    function previewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>

@endsection
