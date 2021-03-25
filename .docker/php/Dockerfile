FROM php:8-cli

ARG uid=1000
ARG user="app"

COPY "./*.ini" "/usr/local/etc/php/conf.d/"

RUN apt-get update \
&& apt-get upgrade -y \
&& apt-get install -y \
   wget \
   zip \
   git \
&& pecl install \
   xdebug \
&& docker-php-ext-enable \
   xdebug \
&& wget -O "/usr/local/bin/composer" "https://getcomposer.org/composer-stable.phar" \
&& chmod -R 755 "/usr/local/bin" \
&& useradd --create-home --user-group --uid=$uid $user
