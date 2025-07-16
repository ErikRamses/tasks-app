FROM php:8.2-fpm

COPY php.ini /usr/local/etc/php/

# Install required system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install opcache \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install calendar \
    && docker-php-ext-install exif \
    && docker-php-ext-install gettext \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install shmop \
    && docker-php-ext-install sockets \
    && docker-php-ext-install sysvmsg \
    && docker-php-ext-install sysvsem \
    && docker-php-ext-install sysvshm

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Configure Nginx to serve PHP files
RUN rm /etc/nginx/sites-enabled/default
COPY nginx.conf /etc/nginx/sites-enabled/default

# Add start script / entrypoint
COPY start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Set the working directory
WORKDIR /var/www/html

# Copy the code into the container
COPY . /var/www/html/

ENV COMPOSER_ALLOW_SUPERUSER 1

# Install dependencies
RUN composer install

# Set the permissions for the storage and bootstrap directories
RUN chgrp -R www-data storage bootstrap/cache && \
    chmod -R ug+rwx storage bootstrap/cache

RUN php artisan key:generate

RUN php artisan config:cache

RUN php artisan config:clear

RUN php artisan migrate --force

RUN php artisan db:seed --force

RUN php artisan storage:link

RUN php artisan optimize:clear

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm && --restart=on-failure
