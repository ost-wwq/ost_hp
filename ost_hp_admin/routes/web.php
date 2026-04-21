<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PropertyConfirmController;
use App\Http\Middleware\AdminAuth;

// ルートアクセス → 管理画面ログインへリダイレクト
Route::get('/', fn() => redirect()->route('admin.login'));

// 物件最新状態確認ページ（認証不要・PIN保護）
Route::get ('confirm/{token}',        [PropertyConfirmController::class, 'show'])->name('property.confirm');
Route::post('confirm/{token}/verify', [PropertyConfirmController::class, 'verify'])->name('property.confirm.verify');

// ログイン
Route::prefix('ost_hp_admin')->name('admin.')->group(function () {
    Route::get('login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    Route::middleware(AdminAuth::class)->group(function () {

        // ダッシュボード
        Route::get('/', fn() => redirect()->route('admin.contacts.index'))->name('dashboard');

        // 物件管理
        Route::get('properties',                    [PropertyController::class, 'index'])->name('properties.index');
        Route::get('properties/create',             [PropertyController::class, 'create'])->name('properties.create');
        Route::post('properties',                   [PropertyController::class, 'store'])->name('properties.store');
        Route::get('properties/{property}',         [PropertyController::class, 'show'])->name('properties.show');
        Route::get('properties/{property}/edit',    [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('properties/{property}',         [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('properties/{property}',      [PropertyController::class, 'destroy'])->name('properties.destroy');
        Route::patch('properties/{property}/toggle-publish',  [PropertyController::class, 'togglePublish'])->name('properties.toggle-publish');
        Route::patch('properties/{property}/toggle-confirm',  [PropertyController::class, 'toggleConfirm'])->name('properties.toggle-confirm');

        // お知らせ管理
        Route::get('news',               [NewsController::class, 'index'])->name('news.index');
        Route::get('news/create',        [NewsController::class, 'create'])->name('news.create');
        Route::post('news',              [NewsController::class, 'store'])->name('news.store');
        Route::get('news/{news}',        [NewsController::class, 'show'])->name('news.show');
        Route::get('news/{news}/edit',   [NewsController::class, 'edit'])->name('news.edit');
        Route::put('news/{news}',        [NewsController::class, 'update'])->name('news.update');
        Route::delete('news/{news}',     [NewsController::class, 'destroy'])->name('news.destroy');

        // 設定
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        // お問い合わせ管理
        Route::get('contacts',                      [ContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{contact}',            [ContactController::class, 'show'])->name('contacts.show');
        Route::post('contacts/{contact}/reply',     [ContactController::class, 'reply'])->name('contacts.reply');
        Route::delete('contacts/{contact}',         [ContactController::class, 'destroy'])->name('contacts.destroy');
        Route::delete('contacts',                   [ContactController::class, 'bulkDestroy'])->name('contacts.bulk-destroy');
        Route::patch('contacts/{contact}/read',     [ContactController::class, 'markRead'])->name('contacts.mark-read');
        Route::patch('contacts/{contact}/unread',   [ContactController::class, 'markUnread'])->name('contacts.mark-unread');
    });
});
