FROM php:7.4-cli-alpine

WORKDIR /opt/mongodb-php-gui

# Enable MongoDB PHP ext.
RUN apk add --no-cache --virtual .build-deps autoconf build-base curl-dev openssl-dev \
 && pecl install mongodb-1.8.2 && docker-php-ext-enable mongodb \
 && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
 && apk del --no-cache .build-deps

COPY . /opt/mongodb-php-gui/
RUN composer install

# Start PHP built-in server.
EXPOSE 5000
CMD ["php", "-S", "0.0.0.0:5000"]
