FROM php:8.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
    #Composerが依存ライブラリを展開するために必要
    && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
    # Laravelが MySQL に接続するための必須拡張
    && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    #Composer を入れてる（Laravelの命）↑２行
    && composer self-update

WORKDIR /var/www
#コンテナ内の 作業ディレクトリの基準点.Nginxのroot /var/www/public; と一致