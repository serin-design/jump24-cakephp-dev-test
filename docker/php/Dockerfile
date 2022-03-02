FROM php:7.4-fpm-alpine
MAINTAINER Mikey Russell

RUN set -xe \
    && apk add --update \
        icu \
        ca-certificates \
        wget \
    && apk add --no-cache --virtual .php-deps \
        make \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        zlib-dev \
        icu-dev \
        g++ \
    && update-ca-certificates \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl mysqli pdo pdo_mysql pdo_sqlite \
    && docker-php-ext-enable intl mysqli pdo pdo_mysql pdo_sqlite \
    && { find /usr/local/lib -type f -print0 | xargs -0r strip --strip-all -p 2>/dev/null || true; } \
    && apk del .build-deps \
    && rm -rf /tmp/* /usr/local/lib/php/doc/* /var/cache/apk/*
