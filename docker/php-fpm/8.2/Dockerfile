FROM --platform=linux/arm64/v8 alpine:latest

LABEL maintainer="Taylor Otwell"

ARG WWWGROUP
ARG NODE_VERSION=18
ARG POSTGRES_VERSION=16

WORKDIR /var/www/html

# Установка временной зоны
ENV TZ=UTC
RUN apk add --no-cache tzdata && \
    cp /usr/share/zoneinfo/$TZ /etc/localtime && \
    echo $TZ > /etc/timezone && \
    apk del tzdata

# Установка необходимых пакетов
RUN apk --no-cache add \
    gnu-libiconv \
    gnupg \
    curl \
    ca-certificates \
    zip \
    unzip \
    git \
    supervisor \
    sqlite-libs \
    libcap \
    libpng-dev \
    python2 \
    php8 \
    php8-dev \
    php8-pdo_pgsql \
    php8-pdo_sqlite \
    php8-gd \
    php8-curl \
    php8-openssl \
    php8-imap \
    php8-pdo_mysql \
    php8-mbstring \
    php8-xml \
    php8-phar \
    php8-intl \
    php8-bcmath \
    php8-dom \
    php8-xmlreader \
    php8-ctype \
    php8-session \
    php8-soap \
    php8-zip \
    php8-iconv \
    php8-simplexml \
    php8-xmlwriter \
    php8-tokenizer \
    php8-pecl-redis \
    php8-pecl-memcached \
    nodejs \
    yarn \
    postgresql-client

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Конфигурация пользователя
RUN addgroup -g $WWWGROUP sail && \
    adduser -D -h /home/sail -s /bin/sh -G sail -u 1337 sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php8/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000

ENTRYPOINT ["start-container"]
