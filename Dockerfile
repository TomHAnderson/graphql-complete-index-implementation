# Build PHP/Apache image
FROM php:8.3-apache

# Suppress warnings from apt about lack of Dialog
ENV DEBIAN_FRONTEND noninteractive

LABEL author="stayker.com" \
      org.label-schema.docker.dockerfile="/Dockerfile" \
      org.label-schema.name="PHP using Apache" \
      org.label-schema.url="https://apiskeletons.com/" \
      org.label-schema.vcs-url="https://github.com/api-skeletons/laravel-doctrine-orm-graphql"

# Command line utilities
RUN apt-get update
RUN apt-get install --yes apt-utils
RUN apt-get install --yes git
RUN apt-get install --yes wget
RUN apt-get install --yes curl
RUN apt-get install --yes vim
RUN apt-get install --yes zip
RUN apt-get install --yes unzip
RUN apt-get install --yes lftp
RUN apt-get install --yes zlib1g-dev
RUN apt-get install --yes libpng-dev
RUN apt-get install --yes libzip-dev
RUN apt-get install --yes libxml2-dev
RUN apt-get install --yes default-mysql-client
RUN apt-get install --yes procps
RUN apt-get install --yes redis
RUN apt-get install --yes nodejs
RUN apt-get install --yes npm

# Environment
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"
 
# PHP
RUN docker-php-ext-install pdo_mysql mysqli gd zip xml soap opcache
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN pecl install redis
RUN docker-php-ext-enable redis
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY .docker/php.ini /usr/local/etc/php/php.ini
COPY .docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Apache
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
COPY .docker/apache2.conf /etc/apache2/apache2.conf
COPY .docker/ports.conf /etc/apache2/ports.conf
COPY .docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /bin/composer

# Node and Magidoc
RUN npm install -g pnpm
RUN SHELL=/bin/bash pnpm setup
RUN SHELL=/bin/bash PNPM_HOME=/usr/bin pnpm add --global @magidoc/cli@latest

# Copy app files
WORKDIR /var/www
ADD . /var/www
RUN rm -rf vendor
RUN composer install --no-dev

# File permissions
RUN touch /var/www/storage/logs/laravel.log && \
  rm /var/www/storage/logs/laravel.log && \
  touch /var/www/storage/logs/laravel.log
RUN chgrp -R www-data storage bootstrap/cache
RUN chmod -R ug+rwx storage bootstrap/cache
RUN chgrp -R www-data database/database.sqlite
RUN chmod -R ug+rwx database/database.sqlite

# Expose port
EXPOSE 8080
