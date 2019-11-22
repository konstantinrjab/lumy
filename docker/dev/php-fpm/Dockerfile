FROM konstantinrjab/lumy:prod

RUN pecl install xdebug-2.8.0 \
    && docker-php-ext-enable xdebug

COPY php.ini $PHP_INI_DIR
