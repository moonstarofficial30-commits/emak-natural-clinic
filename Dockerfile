FROM serversideup/php:8.4-fpm-nginx

WORKDIR /var/www/html

USER root

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chown -R www-data:www-data storage bootstrap/cache

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV PHP_OPCACHE_ENABLE=1

USER www-data
