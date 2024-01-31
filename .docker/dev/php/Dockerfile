FROM php:8.2.12-fpm


RUN apt-get update \
    && apt-get install -y git libzip-dev zlib1g-dev unzip libxslt-dev

# core extensions
RUN docker-php-ext-enable opcache
RUN docker-php-ext-install bcmath \
    && docker-php-ext-install zip \
    && docker-php-ext-install xsl \
    && docker-php-ext-install pcntl


# composer
ENV COMPOSER_HOME /var/www/composer
RUN mkdir $COMPOSER_HOME
COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer


RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data $COMPOSER_HOME

WORKDIR /app
