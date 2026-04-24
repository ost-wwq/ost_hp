<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Middleware\AdminAuth;

// ルートアクセス → 管理画面ログインへリダイレクト
Route::get('/', fn() => redirect()->route('admin.login'));

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
        Route::patch('properties/{property}/toggle-viewing',  [PropertyController::class, 'toggleViewing'])->name('properties.toggle-viewing');
        Route::patch('properties/{property}/update-viewing',  [PropertyController::class, 'updateViewing'])->name('properties.update-viewing');
        Route::get('properties/{property}/owner',              [PropertyController::class, 'ownerEdit'])->name('properties.owner');
        Route::put('properties/{property}/owner',              [PropertyController::class, 'ownerUpdate'])->name('properties.owner.update');
        Route::get('properties/{property}/consents',           [PropertyController::class, 'consents'])->name('properties.consents');
        Route::get('properties/{property}/consents/{consent}', [PropertyController::class, 'consentShow'])->name('properties.consent-show');
        Route::get('properties/{property}/viewings',           [PropertyController::class, 'viewings'])->name('properties.viewings');
        Route::get('properties/{property}/viewings/{viewing}', [PropertyController::class, 'viewingShow'])->name('properties.viewing-show');

        // オーナー管理
        Route::get('owners',                [OwnerController::class, 'index'])->name('owners.index');
        Route::get('owners/create',         [OwnerController::class, 'create'])->name('owners.create');
        Route::post('owners',               [OwnerController::class, 'store'])->name('owners.store');
        Route::get('owners/{owner}',        [OwnerController::class, 'show'])->name('owners.show');
        Route::get('owners/{owner}/edit',   [OwnerController::class, 'edit'])->name('owners.edit');
        Route::put('owners/{owner}',        [OwnerController::class, 'update'])->name('owners.update');
        Route::delete('owners/{owner}',     [OwnerController::class, 'destroy'])->name('owners.destroy');

        // お知らせ管理
        Route::get('news',               [NewsController::class, 'index'])->name('news.index');
        Route::get('news/create',        [NewsController::class, 'create'])->name('news.create');
        Route::post('news',              [NewsController::class, 'store'])->name('news.store');
        Route::get('news/{news}',        [NewsController::class, 'show'])->name('news.show');
        Route::get('news/{news}/edit',   [NewsController::class, 'edit'])->name('news.edit');
        Route::put('news/{news}',        [NewsController::class, 'update'])->name('news.update');
        Route::delete('news/{news}',     [NewsController::class, 'destroy'])->name('news.destroy');

        // 報告
        Route::get('reports',         [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/create',  [ReportController::class, 'create'])->name('reports.create');
        Route::post('reports',        [ReportController::class, 'store'])->name('reports.store');
        Route::get('reports/{report}',[ReportController::class, 'show'])->name('reports.show');

        // 設定
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        // パスワード変更
        Route::get('password', [AuthController::class, 'showChangePassword'])->name('password.edit');
        Route::put('password', [AuthController::class, 'changePassword'])->name('password.update');

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
