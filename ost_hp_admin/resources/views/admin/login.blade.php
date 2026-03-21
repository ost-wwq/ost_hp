@extends('admin.layouts.app')

@section('login')

@section('content')
<div class="login-wrap">
    <div class="login-card">
        <div class="login-card__logo">
            <div class="login-card__logo-icon">🏠</div>
            <div class="login-card__logo-title">ワンステップテックス不動産</div>
            <div class="login-card__logo-sub">管理画面ログイン</div>
        </div>

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="password">パスワード</label>
                <input type="password" id="password" name="password" class="form-input"
                       placeholder="管理者パスワードを入力" autofocus autocomplete="current-password">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn--primary btn--full">ログイン</button>
        </form>
    </div>
</div>
@endsection
