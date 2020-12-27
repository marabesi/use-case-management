FROM php:7.3-fpm
RUN apt-get update && apt-get install -y \
    git \
    wget \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-install -j$(nproc) zip
RUN pecl install xdebug-2.5.5 \
    && docker-php-ext-enable xdebug
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
RUN wget https://getcomposer.org/download/1.10.19/composer.phar && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"