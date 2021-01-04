FROM php:7.3-apache

ENV DEBIAN_FRONTEND=noninteractive

RUN apt update && \
    apt install -y \
        wget \
        vim \
        curl \
        git \
        zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Install node, npm
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs netcat libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev libzip-dev nodejs \
    && apt-get clean

# Install php module
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# Enable rewrite mode
RUN a2enmod rewrite && \
    a2enmod headers

# Chown for apache
RUN mkdir -p /var/www/html/storage && \
    chown -R www-data:www-data /var/www/html/storage

# Add entrypoint
COPY docker-entrypoint /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint
ENTRYPOINT ["docker-entrypoint"]

WORKDIR /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
