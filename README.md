# お問い合わせフォーム

## 環境構築

### Dockerビルド

1. git clone https://github.com/masahiro1234-us/Confirmation-test.git
2. docker-compose up -d --build

### Laravel環境構築

1. docker compose exec php bash
2. composer install
3. .env.example から .env を作成し、環境変数を設定
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術

- PHP 8.0
- Laravel 10.x
- MySQL 8.0

## ER図

![ER図](src/public/images/er-diagram.png)

## URL

- 開発環境: http://localhost/
- phpMyAdmin: http://localhost:8080/