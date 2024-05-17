ARG version=cli
FROM php:$version

ARG xdebug
ARG pcov

WORKDIR /var/www
COPY . .

RUN apt-get update
RUN apt-get install -y zip unzip

RUN test -z "$xdebug" || (pecl install -f xdebug && docker-php-ext-enable xdebug)
RUN test -z "$pcov" || (pecl install -f pcov && docker-php-ext-enable pcov)

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
