FROM php:7.4-fpm-alpine

# Webサーバー用のコンテナ
# local, dev, stg, prd 環境の構築で利用する

ARG APP_ENV
RUN apk update && apk upgrade
RUN apk upgrade --update --no-cache
RUN apk add --no-cache \
    nginx \
    icu-dev \
    composer \
    oniguruma-dev \
    autoconf automake libtool nasm \
    pcre-dev g++ gcc make sudo \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    openrc supervisor rsyslog \
    nodejs npm \
    shadow \
    tzdata \
    git \
    libxml2-dev \
    oniguruma-dev
RUN export TZ=Asia/Tokyo
RUN git clone -b 5.3.1 --depth 1 https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis
RUN docker-php-ext-install intl exif zip iconv sockets mysqli pdo_mysql mbstring soap opcache redis fileinfo pcntl && docker-php-ext-enable opcache
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd
RUN pecl install apcu && docker-php-ext-enable apcu

ARG INSTALL_XDEBUG=false
# Xdebug をインストールして有効化
RUN if [ "${INSTALL_XDEBUG}" = "true" ]; then \
 pecl install xdebug && docker-php-ext-enable xdebug \
; fi

# useradd
RUN groupadd -g 1000 www && \
    useradd -s /bin/bash -u 1000 -N -g www -K MAIL_DIR=/dev/null -d /var/www www


WORKDIR /var/www
ADD . /var/www
WORKDIR /var/www

ADD ./docker/nginx/conf.d/ /etc/nginx/conf.d/
ADD ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

ADD ./docker/php/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
ADD ./docker/php/php.ini /usr/local/etc/php/php.ini
ADD ./docker/supervisor/supervisord.conf /etc/supervisord.conf
ADD ./docker/supervisor/supervisor.d/ /etc/supervisor.d/

RUN mkdir /run/php-fpm7.4
RUN mkdir /run/nginx

#RUN chown www:www -R /run/php-fpm7.4 && \
#    chown www:www -R /var/tmp/nginx && \
#    chown www:www -R /var/lib/nginx && \
#    chown www:www -R /var/www && \
#    ln -sf /dev/stdout /var/log/messages

# ARG ENABLE_MAILHOG=false
# mailhog をインストールして有効化
# RUN if [ "${ENABLE_MAILHOG}" = "true" ]; then \
#     curl -sSL https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 -o mhsendmail \
#     && chmod +x mhsendmail \
#     && mv mhsendmail /usr/local/bin/mhsendmail \
#     && echo "[mail function]" > /usr/local/etc/php/conf.d/mailhog.ini \
#     && echo 'sendmail_path = "/usr/local/bin/mhsendmail --smtp-addr=mailhog:1025"' >> /usr/local/etc/php/conf.d/mailhog.ini \
# ; else apk add msmtp && cp /var/www/docker/msmtp/msmtprc /etc/msmtprc && ln -sf /usr/bin/msmtp /usr/sbin/sendmail; \
# fi


RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# ARG ENABLE_DUSK=false
# RUN if [ "${ENABLE_DUSK}" = "true" ]; then \
#     apk add chromium chromium-chromedriver ttf-freefont; \
# fi

#RUN sh /var/www/docker/setup.sh

CMD ["/usr/bin/supervisord"]

# composerをマルチステージビルドでインストール
COPY --from=composer /usr/bin/composer /usr/bin/composer