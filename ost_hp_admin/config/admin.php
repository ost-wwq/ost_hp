<?php

return [
    /*
     * 管理画面ログインパスワードのbcryptハッシュ
     * .env の ADMIN_PASSWORD_HASH に設定してください。
     *
     * ハッシュ生成:
     *   php artisan tinker
     *   >>> \Hash::make('your-password')
     */
    'password_hash' => env('ADMIN_PASSWORD_HASH'),
];
