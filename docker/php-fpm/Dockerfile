FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

RUN apt-get update \
        && apt-get install -y \
        && apt-get -y --no-install-recommends install \
            php8.2-mysql \
            php8.2-redis \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        zip unzip \
        git && \
        docker-php-ext-install pdo_mysql && \
        docker-php-ext-install bcmath && \
        docker-php-ext-install gd && \
        docker-php-ext-install zip && \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \



COPY ./docker/php-fpm/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin
