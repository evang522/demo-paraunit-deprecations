FROM php:8.2.12-fpm

# fish
RUN FISH_VERSION="3.5.1" \
    && apt-get update \
    && apt-get install -y cmake libncurses5-dev \
    && curl -OSLs "https://github.com/fish-shell/fish-shell/releases/download/$FISH_VERSION/fish-$FISH_VERSION.tar.xz" \
    && tar -xJf "fish-$FISH_VERSION.tar.xz" \
    && cd "fish-$FISH_VERSION" \
    && mkdir build \
    && cd build \
    && cmake .. \
    && make \
    && make install \
    && cd / \
    && rm -rf "fish-$FISH_VERSION" "fish-$FISH_VERSION.tar.xz" \
    && fish -c true


RUN apt-get update \
    && apt-get install -y git libzip-dev zlib1g-dev unzip libxslt-dev

# core extensions
RUN docker-php-ext-enable opcache
RUN docker-php-ext-install bcmath \
    && docker-php-ext-install zip \
    && docker-php-ext-install xsl \
    && docker-php-ext-install pcntl


# gd
RUN apt-get update \
    && apt-get install -y --no-install-recommends libfreetype6-dev libjpeg-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# intl
RUN apt-get update \
    && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl --enable-intl \
    && docker-php-ext-install intl

# imagick
RUN apt-get update \
    && apt-get install -y --no-install-recommends libmagickwand-dev imagemagick
RUN pecl install imagick \
    && docker-php-ext-enable imagick
RUN sed -i '/disable ghostscript format types/,+6d' /etc/ImageMagick-6/policy.xml

# ghostscript
RUN apt-get update \
    && apt-get install -y ghostscript

# pdo_pgsql
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql


# composer
ENV COMPOSER_HOME /var/www/composer
RUN mkdir $COMPOSER_HOME
COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer


RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data $COMPOSER_HOME

WORKDIR /app
