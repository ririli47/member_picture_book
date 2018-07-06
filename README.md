# member_picture_book

## 開発環境構築

### 参考url
https://m2wasabi.hatenablog.com/entry/2017/12/02/laravel-docker-adv
https://github.com/m2wasabi/docker-compose-template-laravel

### 実行コマンド

dockerテンプレートをclone（ありがたや）

```
$ git clone git@github.com:m2wasabi/docker-compose-templates.git memberPictureBook
```

.envファイルを編集

```
PROJECT_NAME=memberPictureBook
```

コンテナをbuild

```
$ cd myproject
$ docker-compose build
```

プロジェクトをclone

```
$ cd app
$ git clone git@github.com:ririli47/member_picture_book.git 
```

laravelの.envを編集

```
DB_HOST=mysql
REDIS_HOST=redis

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_DRIVER=redis
```

コンテナ立ち上げ

```
$ docker-compose up
```

コンテナアクセス

```
./php.sh
```

composer install

```
/app # composer install
/app # php artisan migrate
```
