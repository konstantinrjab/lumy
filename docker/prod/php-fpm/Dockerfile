FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql

COPY php.ini $PHP_INI_DIR

CMD ["php-fpm"]

EXPOSE 9000

WORKDIR /var/www
