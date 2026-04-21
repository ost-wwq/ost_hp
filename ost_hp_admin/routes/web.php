<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PropertyConfirmController;
use App\Http\Controllers\PropertyConsentController;
use App\Http\Controllers\PropertyRecordsController;
use App\Http\Middleware\AdminAuth;

// ルートアクセス → 管理画面ログインへリダイレクト
Route::get('/', fn() => redirect()->route('admin.login'));

// 物件最新状態確認ページ（認証不要・PIN保護）
Route::get ('confirm/{token}',        [PropertyConfirmController::class, 'show'])->name('property.confirm');
Route::post('confirm/{token}/verify', [PropertyConfirmController::class, 'verify'])->name('property.confirm.verify');

// 内見予約・掲載承諾 確認（メール認証）
Route::get ('confirm/{token}/records',             [PropertyRecordsController::class, 'showEmailForm'])->name('property.records.email');
Route::post('confirm/{token}/records/send-code',   [PropertyRecordsController::class, 'sendCode'])->name('property.records.send-code');
Route::get ('confirm/{token}/records/code',        [PropertyRecordsController::class, 'showCodeForm'])->name('property.records.code');
Route::post('confirm/{token}/records/verify-code', [PropertyRecordsController::class, 'verifyCode'])->name('property.records.verify-code');
Route::get ('confirm/{token}/records/list',        [PropertyRecordsController::class, 'list'])->name('property.records.list');
Route::get ('confirm/{token}/records/viewing/{id}',[PropertyRecordsController::class, 'viewingDetail'])->name('property.records.viewing');
Route::get ('confirm/{token}/records/consent/{id}',[PropertyRecordsController::class, 'consentDetail'])->name('property.records.consent');

// 掲載承諾ページ（認証不要・confirm_token共用）
Route::get ('consent/{token}',          [PropertyConsentController::class, 'show'])->name('property.consent');
Route::post('consent/{token}',          [PropertyConsentController::class, 'store'])->name('property.consent.store');
Route::get ('consent/{token}/complete', [PropertyConsentController::class, 'complete'])->name('property.consent.complete');

// プライバシーポリシー
Route::get('privacy-policy', fn() => view('privacy-policy'))->name('privacy-policy');

// 内見予約ページ（認証不要）
Route::get ('viewing/{token}',          [\App\Http\Controllers\PropertyViewingController::class, 'show'])->name('property.viewing');
Route::post('viewing/{token}',          [\App\Http\Controllers\PropertyViewingController::class, 'store'])->name('property.viewing.store');
Route::get ('viewing/{token}/complete', [\App\Http\Controllers\PropertyViewingController::class, 'complete'])->name('property.viewing.complete');

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
        Route::get('properties/{property}/consents',           [PropertyController::class, 'consents'])->name('properties.consents');
        Route::get('properties/{property}/consents/{consent}', [PropertyController::class, 'consentShow'])->name('properties.consent-show');
        Route::get('properties/{property}/viewings',           [PropertyController::class, 'viewings'])->name('properties.viewings');
        Route::get('properties/{property}/viewings/{viewing}', [PropertyController::class, 'viewingShow'])->name('properties.viewing-show');

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
