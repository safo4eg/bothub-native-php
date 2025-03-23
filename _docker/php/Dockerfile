FROM php:8.3.0-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    bash \
    curl \
    zip \
    unzip \
    tzdata \
    libzip-dev \
    libssl-dev \
    libxml2-dev \
    libonig-dev \
    && apt-get clean

RUN docker-php-ext-install \
    pdo_mysql \
    bcmath \
    intl \
    opcache \
    mbstring \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www \
    && useradd -u 1000 -g www -s /bin/bash -m www

# Копируем содержимое текущего каталога в рабочую директорию
COPY . /var/www
COPY --chown=www:www . /var/www

USER www

CMD ["php-fpm"]