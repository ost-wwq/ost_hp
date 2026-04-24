@extends('admin.layouts.app')

@section('title', 'パスワード変更')

@section('content')

<div style="max-width:480px;">
    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card__header">
                <div class="card__title">🔐 管理者パスワード変更</div>
            </div>
            <div class="card__body" style="display:flex;flex-direction:column;gap:20px;">

                <div>
                    <label class="form-label">現在のパスワード <span style="color:#f17c20;">*</span></label>
                    <input type="password" name="current_password" class="form-input" autocomplete="current-password" required>
                    @error('current_password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="form-label">新しいパスワード <span style="color:#f17c20;">*</span></label>
                    <input type="password" name="new_password" class="form-input" autocomplete="new-password" required>
                    <div style="font-size:.78rem;color:#7b7b9a;margin-top:4px;">8文字以上で設定してください</div>
                    @error('new_password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="form-label">新しいパスワード（確認） <span style="color:#f17c20;">*</span></label>
                    <input type="password" name="new_password_confirmation" class="form-input" autocomplete="new-password" required>
                </div>

            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;margin-top:20px;">
            <button type="submit" class="btn btn--primary">💾 パスワードを変更する</button>
        </div>
    </form>
</div>

<style>
.form-label { display:block; font-size:.82rem; font-weight:700; color:#2b2d42; margin-bottom:6px; }
.form-input { width:100%; padding:10px 14px; border:1.5px solid #e4e6f0; border-radius:8px; font-size:.9rem; font-family:inherit; outline:none; transition:.2s; background:#fff; }
.form-input:focus { border-color:#2f7cff; box-shadow:0 0 0 3px rgba(47,124,255,.1); }
.form-error { font-size:.8rem; color:#b91c1c; margin-top:4px; }
</style>

@endsection
