# ost_hp

## イメージ作成
docker-compose up -d --build


## dockerに入る
docker exec -it ost-hp /bin/bash -l




## ログ
docker-compose logs -f ost-hp





# lovst　admin　構築
cd /home/c8186019/ost_hp/ost_hp_admin

php composer.phar self-update
php composer.phar install
php composer.phar update


chmod -R 775 storage
chmod -R 775 bootstrap/cache



## .envファイル修正
```
- APP_URL=http://www.house.onesteptechs.com
+ APP_URL=https://www.house.onesteptechs.com

- APP_ENV=local
+ APP_ENV=production
```

```
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache
```


## public_htmlファイル修正
cd /home/c8186019/public_html/houseadmin.onesteptechs.com
cp -R /home/c8186019/ost_hp/ost_hp_admin/public/* .


vim .htaccess
```
RewriteEngine off
#RewriteRule ^(.*)$ /laravel$1 [L,R=301]

<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        #Options -MultiViews -Indexes
        Options -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```


vim index.php
下記の行を追加
$dir = "/home/c8186019/ost_hp/ost_hp_admin/public/";

__DIR__を$dirへ変更　3箇所


ln -s /home/c8186019/ost_hp/ost_hp_admin/css css
ln -s /home/c8186019/ost_hp/ost_hp_admin/error error
ln -s /home/c8186019/ost_hp/ost_hp_admin/js js


# 管理者パスワードの設定手順
## ① ハッシュ値を生成
コンテナ内 or ローカルで以下を実行：

php artisan tinker

>>> \Hash::make('設定したいパスワード')
// => "$2y$12$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"

## ② .env に設定
ost_hp_admin プロジェクトの .env ファイルに追加：

ADMIN_PASSWORD_HASH=$2y$12$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

⚠️ ハッシュ値に $ が含まれるため、ダブルクォートで囲むか、$ をエスケープしてください。

ADMIN_PASSWORD_HASH="$2y$12$xxxxxxxxxxxxxxxxxxxx..."

## ③ キャッシュをクリア
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

## ④ ログイン
項目	内容
URL	/ost_hp_admin/login
パスワード	① で設定したパスワード
仕組みのポイント
パスワードは データベースに保存されない（環境変数で管理）
単一パスワード認証（IDなし）
config('admin.password_hash') と Hash::check() で照合



