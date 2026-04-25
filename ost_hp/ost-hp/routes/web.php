<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InboundMailController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\PropertyConfirmController;
use App\Http\Controllers\PropertyConsentController;
use App\Http\Controllers\PropertyRecordsController;
use App\Http\Controllers\PropertyViewingController;
use App\Models\Property;

// ホームページ
Route::get('/', function () {
    $featuredProperties = Property::published()
        ->where('status', 'available')
        ->latest()
        ->limit(6)
        ->get();
    return view('welcome', compact('featuredProperties'));
});

// 会社情報・アクセス
Route::get('/company', fn() => view('company'))->name('company');

// 不動産購入フロー
Route::get('/flow', fn() => view('flow'))->name('flow');

// 不動産売却フロー
Route::get('/selling-flow', fn() => view('selling-flow'))->name('selling-flow');

// 不動産貸出フロー
Route::get('/rental-flow', fn() => view('rental-flow'))->name('rental-flow');

// 不動産賃借フロー
Route::get('/renting-flow', fn() => view('renting-flow'))->name('renting-flow');

// 報酬額
Route::get('/commission', fn() => view('commission'))->name('commission');

// 物件一覧・詳細（公開）
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/properties/{property}/main-image', [PropertyController::class, 'mainImage'])->name('properties.main-image');
Route::get('/properties/{property}/images/{key}', [PropertyController::class, 'propertyImage'])->name('properties.image');
Route::get('/properties/{property}/keybbox-image', [PropertyController::class, 'keybboxImage'])->name('properties.keybbox-image');

// お問い合わせフォーム送信
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// 返信メール受信 Webhook（SendGrid / Mailgun など）
Route::post('/webhook/inbound-mail', [InboundMailController::class, 'handle'])
    ->name('webhook.inbound-mail')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// プライバシーポリシー
Route::get('privacy-policy', fn() => view('privacy-policy'))->name('privacy-policy');

// 物件最新状態確認ページ（認証不要・PIN保護）
Route::get ('confirm/{token}',        [PropertyConfirmController::class, 'show'])->name('property.confirm');
Route::post('confirm/{token}/verify', [PropertyConfirmController::class, 'verify'])->name('property.confirm.verify');

// 内見予約・広告掲載許可申請 確認（メール認証）
Route::get ('confirm/{token}/records',             [PropertyRecordsController::class, 'showEmailForm'])->name('property.records.email');
Route::post('confirm/{token}/records/send-code',   [PropertyRecordsController::class, 'sendCode'])->name('property.records.send-code');
Route::get ('confirm/{token}/records/code',        [PropertyRecordsController::class, 'showCodeForm'])->name('property.records.code');
Route::post('confirm/{token}/records/verify-code', [PropertyRecordsController::class, 'verifyCode'])->name('property.records.verify-code');
Route::get ('confirm/{token}/records/list',        [PropertyRecordsController::class, 'list'])->name('property.records.list');
Route::get ('confirm/{token}/records/viewing/{id}',[PropertyRecordsController::class, 'viewingDetail'])->name('property.records.viewing');
Route::get ('confirm/{token}/records/consent/{id}',[PropertyRecordsController::class, 'consentDetail'])->name('property.records.consent');

// 広告掲載許可申請ページ（認証不要・confirm_token共用）
Route::get ('consent/{token}',          [PropertyConsentController::class, 'show'])->name('property.consent');
Route::post('consent/{token}',          [PropertyConsentController::class, 'store'])->name('property.consent.store');
Route::get ('consent/{token}/complete', [PropertyConsentController::class, 'complete'])->name('property.consent.complete');

// 内見予約ページ（confirm PINセッション必須）
Route::get ('viewing/{token}',          [PropertyViewingController::class, 'show'])->name('property.viewing');
Route::post('viewing/{token}',          [PropertyViewingController::class, 'store'])->name('property.viewing.store');
Route::get ('viewing/{token}/complete', [PropertyViewingController::class, 'complete'])->name('property.viewing.complete');

// 業者向け確認ページ
Route::prefix('broker')->name('broker.')->group(function () {
    Route::get('/', [BrokerController::class, 'showPin'])->name('pin');
    Route::post('/', [BrokerController::class, 'verifyPin'])->name('verify');
    Route::get('/properties', [BrokerController::class, 'properties'])->name('properties');
    Route::post('/logout', [BrokerController::class, 'logout'])->name('logout');
    Route::get('/properties/{property}/consent', [BrokerController::class, 'showConsent'])->name('consent.show');
    Route::post('/properties/{property}/consent', [BrokerController::class, 'storeConsent'])->name('consent.store');
    Route::get('/properties/{property}/consent/complete', [BrokerController::class, 'consentComplete'])->name('consent.complete');
});
